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
}

add_filter('wp_mail_from', fn() => SMTP_USERNAME);
add_filter('wp_mail_from_name', fn() => SMTP_FROM_NAME);

add_action('admin_post_nopriv_custom_form_submit', 'ormas_handle_custom_form');
add_action('admin_post_custom_form_submit', 'ormas_handle_custom_form');

function ormas_handle_custom_form()
{
  if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'custom_form')) {
    wp_die('Неверный nonce');
  }

  $fields = [
    'Страница' => sanitize_text_field($_POST['title'] ?? ''),
    'Форма' => sanitize_text_field($_POST['type'] ?? ''),
    'Имя' => sanitize_text_field($_POST['firstname'] ?? ''),
    'Фамилия' => sanitize_text_field($_POST['lastname'] ?? ''),
    'Email' => sanitize_email($_POST['email'] ?? ''),
    'Email' => sanitize_email($_POST['email_to'] ?? ''),
    'Телефон' => sanitize_text_field($_POST['phone'] ?? ''),
    'Сообщение' => sanitize_textarea_field($_POST['text'] ?? ''),
    'Заявка на получение материала' => sanitize_textarea_field($_POST['material'] ?? ''),
  ];

  $subject = 'Заявка со страницы "' . sanitize_text_field($_POST['title']) . '"';
  $headers[] = 'Content-Type: text/html; charset=UTF-8';
  $body = '';
  foreach ($fields as $field => $value) {
    if (!empty($value)) {
      $body .= $field . ': ' . $value . '<br>';
    }
  }
  $mail = wp_mail(SMTP_TO_EMAIL, $subject, $body, $headers);

  if ($_POST['ismaterial'] === 'true') {
    $post_id = absint($_POST['post_id']);
    $attachments = [];
    if ($_POST['single_mode'] === 'true') {
      $materials = carbon_get_post_meta(get_option('page_for_posts'), 'material_file_list');
      if (!empty($materials)) {
        foreach ($materials as $file) {
          $file = get_attached_file($file['material_file']);
          $attachments[] = $file;
        }
      }
    } else {
      $materials = carbon_get_post_meta($post_id, 'materials_list');
      if (!empty($materials)) {
        foreach ($materials as $material) {
          foreach ($material['material_file_list'] as $file) {
            $file = get_attached_file($file['material_file']);
            $attachments[] = $file;
          }
        }
      }
    }
    if (!empty($attachments)) {
      wp_mail(
        sanitize_email($_POST['email_to']),
        sanitize_text_field($_POST['materials__mail-title']),
        wp_kses_post($_POST['materials__text-mail']),
        $headers,
        $attachments
      );
    }
  }

  echo json_encode($mail);
  exit;
}
