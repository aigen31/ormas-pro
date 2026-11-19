<?php

add_action('phpmailer_init', 'ormas_phpmailer_init');
function ormas_phpmailer_init($phpmailer)
{
  $phpmailer->IsSMTP();
  $phpmailer->Host       = SMTP_HOST;
  $phpmailer->Username   = SMTP_USERNAME;
  $phpmailer->Password   = SMTP_PASSWORD;
  $phpmailer->SMTPAuth   = SMTP_AUTH;
  $phpmailer->SMTPSecure = SMTP_SECURE;
  $phpmailer->Port       = SMTP_PORT;
  $phpmailer->isHTML(true);

  // Почтовый сервер (mail.ormas.pro) отдаёт самоподписанный сертификат
  // CN=isp30.adminvps.net, поэтому проверку имени/цепочки отключаем.
  // Когда на сервере появится валидный сертификат для mail.ormas.pro —
  // этот блок нужно удалить.
  $phpmailer->SMTPOptions = [
    'ssl' => [
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true,
    ],
  ];
}

add_filter('wp_mail_from', fn() => SMTP_USERNAME);
add_filter('wp_mail_from_name', fn() => SMTP_FROM_NAME);

add_action('admin_post_nopriv_custom_form_submit', 'ormas_handle_custom_form');
add_action('admin_post_custom_form_submit', 'ormas_handle_custom_form');

function ormas_reject_custom_form()
{
  status_header(422);
  echo wp_json_encode(false);
  exit;
}

function ormas_is_valid_form_name($value)
{
  if (!is_string($value)) {
    return false;
  }

  $value = trim(wp_unslash($value));
  $placeholders = ['Имя', 'Фамилия', 'Name', 'Firstname', 'Lastname', 'First name', 'Last name'];
  $length = function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);

  return $length >= 2
    && $length <= 80
    && !in_array($value, $placeholders, true);
}

function ormas_is_valid_form_email($value)
{
  if (!is_string($value)) {
    return false;
  }

  $value = trim(wp_unslash($value));

  // Internationalized addresses are not supported by wp_mail reliably.
  return $value !== ''
    && !preg_match('/[^\x20-\x7E]/', $value)
    && is_email($value) === $value;
}

function ormas_is_valid_form_phone($value)
{
  if (!is_string($value)) {
    return false;
  }

  $value = trim(wp_unslash($value));
  $phone = preg_replace('/[\s\-().]/', '', $value);

  // The country selector sends E.164 numbers. A leading + makes the country
  // code mandatory even when the endpoint is called without the website UI.
  return (bool) preg_match('/^\+[1-9][0-9]{7,14}$/', $phone);
}

function ormas_handle_custom_form()
{
  if ('POST' !== ($_SERVER['REQUEST_METHOD'] ?? '')) {
    status_header(405);
    header('Allow: POST');
    exit;
  }

  // Nonce — это CSRF-токен, а не авторизация: endpoint публичный, nonce
  // выдаётся в HTML формы и снимается анонимно. Держим его только как CSRF.
  $nonce = (isset($_POST['_wpnonce']) && is_string($_POST['_wpnonce'])) ? $_POST['_wpnonce'] : '';
  if (!wp_verify_nonce($nonce, 'custom_form')) {
    wp_die('Неверный nonce', 'Forbidden', ['response' => 403]);
  }

  // Анти-флуд: не более 5 отправок с одного IP за 15 минут.
  if (!ormas_form_rate_limit_hit('form', 5, 15 * MINUTE_IN_SECONDS)) {
    status_header(429);
    header('Retry-After: 900');
    echo wp_json_encode(false);
    exit;
  }

  // SmartCaptcha: проверка на сервере. Включается заданием SMARTCAPTCHA_SERVER_KEY
  // (ysc2_...) в wp-config.php; без ключа форма работает под защитой рейт-лимита.
  $captcha_token = (isset($_POST['smart_token']) && is_string($_POST['smart_token'])) ? $_POST['smart_token'] : '';
  if (ormas_verify_smartcaptcha($captcha_token) === false) {
    ormas_reject_custom_form();
  }

  if (!isset($_POST['type'], $_POST['title']) || !is_string($_POST['type']) || !is_string($_POST['title'])) {
    ormas_reject_custom_form();
  }

  $form_type = sanitize_text_field(wp_unslash($_POST['type']));
  $is_material = ($_POST['ismaterial'] ?? '') === 'true';
  $required_fields = $is_material
    ? ['email_to']
    : ['firstname', 'email'];

  if (in_array($form_type, ['Консультация', 'Запись на консультацию'], true)) {
    $required_fields[] = 'phone';
  } elseif (in_array($form_type, ['Запись на услугу', 'Запись на экскурсию'], true)) {
    $required_fields = array_merge($required_fields, ['lastname', 'phone']);
  } elseif ($form_type === 'Вопрос') {
    $required_fields[] = 'text';
  }

  foreach (array_unique($required_fields) as $required_field) {
    if (!isset($_POST[$required_field]) || !is_string($_POST[$required_field]) || trim($_POST[$required_field]) === '') {
      ormas_reject_custom_form();
    }
  }

  foreach (['firstname', 'lastname'] as $name_field) {
    if (isset($_POST[$name_field]) && !ormas_is_valid_form_name($_POST[$name_field])) {
      ormas_reject_custom_form();
    }
  }

  foreach (['email', 'email_to'] as $email_field) {
    if (isset($_POST[$email_field]) && !ormas_is_valid_form_email($_POST[$email_field])) {
      ormas_reject_custom_form();
    }
  }

  if (isset($_POST['phone']) && !ormas_is_valid_form_phone($_POST['phone'])) {
    ormas_reject_custom_form();
  }

  $fields = [
    'Страница' => sanitize_text_field($_POST['title'] ?? ''),
    'Форма' => sanitize_text_field($_POST['type'] ?? ''),
    'Имя' => sanitize_text_field($_POST['firstname'] ?? ''),
    'Фамилия' => sanitize_text_field($_POST['lastname'] ?? ''),
    'Email' => sanitize_email($_POST['email'] ?? ''),
    'Email To' => sanitize_email($_POST['email_to'] ?? ''),
    'Телефон' => sanitize_text_field($_POST['phone'] ?? ''),
    'Сообщение' => sanitize_textarea_field($_POST['text'] ?? ''),
    'Заявка на получение материала' => sanitize_textarea_field($_POST['material'] ?? ''),
  ];

  $subject = 'Заявка со страницы "' . sanitize_text_field($_POST['title']) . '"';
  $headers = ['Content-Type: text/html; charset=UTF-8'];
  $body = '';
  foreach ($fields as $field => $value) {
    if (!empty($value)) {
      $body .= $field . ': ' . $value . '<br>';
    }
  }
  $mail = wp_mail(SMTP_TO_EMAIL, $subject, $body, $headers);
  if (!$mail) {
    // Не делать вид, что заявка принята, если письмо не ушло.
    error_log('[ormas] wp_mail failed for form "' . sanitize_text_field($_POST['type'] ?? '') . '"');
    status_header(502);
  }

  // Handler for materials sendment
  if (($_POST['ismaterial'] ?? '') === 'true') {
    // post_id и index приходят из запроса — валидируем, а не доверяем им.
    $post_id = absint($_POST['post_id'] ?? 0);
    $single_mode = (($_POST['single_mode'] ?? '') === 'true');
    $attachments = [];

    if ($single_mode) {
      $source_id = (int) get_option('page_for_posts');
      $materials = carbon_get_post_meta($source_id, 'material_file_list');
      if (!is_array($materials)) {
        ormas_reject_custom_form();
      }
      foreach ($materials as $file) {
        if (!is_array($file) || empty($file['material_file'])) continue;
        $path = get_attached_file((int) $file['material_file']);
        if ($path && is_readable($path)) $attachments[] = $path;
      }
    } else {
      $post = $post_id ? get_post($post_id) : null;
      if (!$post || 'publish' !== $post->post_status) {
        ormas_reject_custom_form();
      }
      $materials = carbon_get_post_meta($post_id, 'materials_list');
      $index = isset($_POST['index']) ? (int) $_POST['index'] : -1;
      if (!is_array($materials) || !isset($materials[$index]['material_file_list']) || !is_array($materials[$index]['material_file_list'])) {
        ormas_reject_custom_form();
      }
      foreach ($materials[$index]['material_file_list'] as $file) {
        if (!is_array($file) || empty($file['material_file'])) continue;
        $path = get_attached_file((int) $file['material_file']);
        if ($path && is_readable($path)) $attachments[] = $path;
      }
    }

    if (!empty($attachments)) {
      // Тема и тело письма берутся из метаданных материала (админка),
      // а не из запроса: иначе сайт превращается в фишинговый релей.
      $source_id = $single_mode ? (int) get_option('page_for_posts') : $post_id;
      $mail_title = (string) carbon_get_post_meta($source_id, 'material_mail_title');
      $mail_text = (string) carbon_get_post_meta($source_id, 'material_mail_text');
      $mail_body = '' !== $mail_text
        ? wp_kses_post($mail_text)
        : nl2br(esc_html((string) ($_POST['materials__text-mail'] ?? '')));
      wp_mail(
        sanitize_email($_POST['email_to']),
        '' !== $mail_title ? $mail_title : sanitize_text_field($_POST['materials__mail-title'] ?? ''),
        $mail_body,
        $headers,
        $attachments
      );

      echo json_encode($mail);

      exit;
    }
  }

  echo json_encode($mail);
  exit;
}

/**
 * IP клиента для рейт-лимита и проверки капчи.
 */
function ormas_form_client_ip()
{
  $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
  return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '0.0.0.0';
}

/**
 * Счётчик отправок по IP на транзиентах. false — лимит исчерпан.
 */
function ormas_form_rate_limit_hit($bucket, $limit, $window)
{
  $key = 'ormas_rl_' . $bucket . '_' . md5(ormas_form_client_ip());
  $count = (int) get_transient($key);
  if ($count >= $limit) {
    return false;
  }
  set_transient($key, $count + 1, $window);
  return true;
}

/**
 * true  — капча не настроена (fail-open, защита рейт-лимитом) или токен валиден;
 * false — капча настроена, но токен не прошёл проверку.
 */
function ormas_verify_smartcaptcha($token)
{
  if (!defined('SMARTCAPTCHA_SERVER_KEY') || !SMARTCAPTCHA_SERVER_KEY) {
    return true;
  }
  if (!is_string($token) || '' === $token) {
    return false;
  }

  $response = wp_remote_post('https://smartcaptcha.yandexcloud.net/validate', [
    'timeout' => 5,
    'body'    => [
      'secret' => SMARTCAPTCHA_SERVER_KEY,
      'token'  => $token,
      'ip'     => ormas_form_client_ip(),
    ],
  ]);

  if (is_wp_error($response)) {
    return false;
  }

  $body = json_decode(wp_remote_retrieve_body($response), true);
  return is_array($body) && isset($body['status']) && 'ok' === $body['status'];
}
