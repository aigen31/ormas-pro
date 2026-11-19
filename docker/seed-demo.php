<?php
/**
 * Idempotent demo content seeder for the local ormas.pro environment.
 *
 * Run with:
 *   docker compose run --rm -T wp-cli eval-file \
 *     /var/www/html/wp-content/themes/ormas-pro/docker/seed-demo.php
 */

if (! defined('ABSPATH')) {
    fwrite(STDERR, "This script must be run through WP-CLI.\n");
    exit(1);
}

if (! function_exists('carbon_set_post_meta') || ! function_exists('carbon_set_theme_option')) {
    WP_CLI::error('Carbon Fields is not loaded. Activate the ormas-pro theme first.');
}

/* -------------------------------------------------------------------------
 * Helpers
 * ---------------------------------------------------------------------- */

function ormas_demo_media_store(): array
{
    $store = get_option('ormas_demo_media', []);
    return is_array($store) ? $store : [];
}

function ormas_demo_media_save(string $key, int $id): void
{
    $store = ormas_demo_media_store();
    $store[$key] = $id;
    update_option('ormas_demo_media', $store, false);
}

function ormas_demo_image(string $key, int $width = 1200, int $height = 800): int
{
    $store = ormas_demo_media_store();
    if (! empty($store[$key])) {
        $existing = (int) $store[$key];
        if ($existing && get_post($existing) && wp_get_attachment_url($existing)) {
            return $existing;
        }
    }

    $palettes = [
        [46, 26, 176],
        [255, 111, 97],
        [24, 160, 160],
        [244, 162, 97],
        [106, 76, 147],
        [39, 125, 161],
        [231, 111, 81],
        [42, 157, 143],
    ];
    $palette = $palettes[abs(crc32($key)) % count($palettes)];

    $image = imagecreatetruecolor($width, $height);
    imageantialias($image, true);

    $background = imagecolorallocate($image, $palette[0], $palette[1], $palette[2]);
    imagefilledrectangle($image, 0, 0, $width, $height, $background);

    $white = imagecolorallocate($image, 255, 255, 255);
    $soft = imagecolorallocatealpha($image, 255, 255, 255, 100);
    $dark = imagecolorallocatealpha($image, 0, 0, 0, 95);

    imagefilledellipse($image, (int) ($width * 0.78), (int) ($height * 0.22), (int) ($width * 0.55), (int) ($height * 0.55), $soft);
    imagefilledellipse($image, (int) ($width * 0.18), (int) ($height * 0.82), (int) ($width * 0.38), (int) ($height * 0.38), $dark);

    for ($i = 0; $i < 6; $i++) {
        $y = (int) ($height * (0.18 + $i * 0.13));
        imageline($image, 0, $y, $width, $y - (int) ($height * 0.08), $soft);
    }

    $font = '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf';
    $label = strtoupper(str_replace('-', ' ', $key));
    if (file_exists($font)) {
        imagettftext($image, (int) max(18, $height * 0.09), 0, (int) ($width * 0.08), (int) ($height * 0.42), $white, $font, 'ORMAS');
        imagettftext($image, (int) max(12, $height * 0.035), 0, (int) ($width * 0.08), (int) ($height * 0.52), $white, $font, $label);
        imagettftext($image, (int) max(10, $height * 0.024), 0, (int) ($width * 0.08), (int) ($height * 0.90), $white, $font, 'DEMO CONTENT');
    } else {
        imagestring($image, 5, (int) ($width * 0.08), (int) ($height * 0.40), 'ORMAS', $white);
        imagestring($image, 4, (int) ($width * 0.08), (int) ($height * 0.48), $label, $white);
    }

    ob_start();
    imagepng($image);
    $data = ob_get_clean();
    imagedestroy($image);

    $upload = wp_upload_bits('ormas-demo-' . sanitize_title($key) . '.png', null, $data);
    if (! empty($upload['error'])) {
        WP_CLI::warning('Could not upload demo image ' . $key . ': ' . $upload['error']);
        return 0;
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';

    $attachment_id = wp_insert_attachment([
        'post_mime_type' => 'image/png',
        'post_title'     => 'ORMAS demo — ' . $key,
        'post_content'   => '',
        'post_status'    => 'inherit',
    ], $upload['file']);

    if (is_wp_error($attachment_id) || ! $attachment_id) {
        WP_CLI::warning('Could not create attachment for ' . $key);
        return 0;
    }

    wp_update_attachment_metadata($attachment_id, wp_generate_attachment_metadata($attachment_id, $upload['file']));
    update_post_meta($attachment_id, '_wp_attachment_image_alt', 'Тестовое изображение ORMAS: ' . $key);
    ormas_demo_media_save($key, (int) $attachment_id);

    return (int) $attachment_id;
}

function ormas_demo_file(string $key, string $title, string $content): int
{
    $store = ormas_demo_media_store();
    if (! empty($store['file-' . $key])) {
        $existing = (int) $store['file-' . $key];
        if ($existing && get_post($existing)) {
            return $existing;
        }
    }

    $upload = wp_upload_bits('ormas-demo-' . sanitize_title($key) . '.txt', null, $content);
    if (! empty($upload['error'])) {
        WP_CLI::warning('Could not upload demo file ' . $key . ': ' . $upload['error']);
        return 0;
    }

    $attachment_id = wp_insert_attachment([
        'post_mime_type' => 'text/plain',
        'post_title'     => $title,
        'post_content'   => '',
        'post_status'    => 'inherit',
    ], $upload['file']);

    if (is_wp_error($attachment_id) || ! $attachment_id) {
        WP_CLI::warning('Could not create file attachment ' . $key);
        return 0;
    }

    ormas_demo_media_save('file-' . $key, (int) $attachment_id);
    return (int) $attachment_id;
}

function ormas_demo_upsert(string $type, string $slug, string $title, string $content = '', array $extra = []): int
{
    $existing = get_posts([
        'name'             => $slug,
        'post_type'        => $type,
        'post_status'      => 'any',
        'posts_per_page'   => 1,
        'suppress_filters' => true,
    ]);

    $data = array_merge([
        'post_type'    => $type,
        'post_name'    => $slug,
        'post_title'   => $title,
        'post_content' => $content,
        'post_status'  => 'publish',
    ], $extra);

    if (! empty($existing)) {
        $data['ID'] = $existing[0]->ID;
        $id = wp_update_post(wp_slash($data), true);
    } else {
        $id = wp_insert_post(wp_slash($data), true);
    }

    if (is_wp_error($id)) {
        WP_CLI::warning('Could not save ' . $type . '/' . $slug . ': ' . $id->get_error_message());
        return 0;
    }

    return (int) $id;
}

function ormas_demo_set_post(int $post_id, array $fields): void
{
    foreach ($fields as $name => $value) {
        try {
            carbon_set_post_meta($post_id, $name, $value);
        } catch (Throwable $e) {
            WP_CLI::warning('Field ' . $name . ' on post ' . $post_id . ': ' . $e->getMessage());
        }
    }
}

function ormas_demo_set_options(array $fields): void
{
    foreach ($fields as $name => $value) {
        try {
            carbon_set_theme_option($name, $value);
        } catch (Throwable $e) {
            WP_CLI::warning('Theme option ' . $name . ': ' . $e->getMessage());
        }
    }
}

/* -------------------------------------------------------------------------
 * Media
 * ---------------------------------------------------------------------- */

WP_CLI::log('Creating demo images...');

$hero_keys = ['neuro', 'speech', 'psych', 'bos', 'corr', 'diag', 'launch', 'services'];
$content_keys = [];
for ($i = 1; $i <= 12; $i++) {
    $content_keys[] = 'content-' . $i;
}
$team_keys = [];
for ($i = 1; $i <= 6; $i++) {
    $team_keys[] = 'team-' . $i;
}
$avatar_keys = [];
for ($i = 1; $i <= 6; $i++) {
    $avatar_keys[] = 'avatar-' . $i;
}
$service_keys = [];
for ($i = 1; $i <= 6; $i++) {
    $service_keys[] = 'service-' . $i;
}
$blog_keys = ['blog-1', 'blog-2', 'blog-3'];
$cert_keys = ['cert-1', 'cert-2', 'cert-3', 'cert-4'];

$images = [];
foreach ($hero_keys as $key) {
    $images['hero-' . $key] = ormas_demo_image('hero-' . $key, 1600, 1000);
}
foreach ($content_keys as $key) {
    $images[$key] = ormas_demo_image($key, 1000, 700);
}
foreach ($team_keys as $key) {
    $images[$key] = ormas_demo_image($key, 800, 1000);
}
foreach ($avatar_keys as $key) {
    $images[$key] = ormas_demo_image($key, 500, 500);
}
foreach ($service_keys as $key) {
    $images[$key] = ormas_demo_image($key, 800, 800);
}
foreach ($blog_keys as $key) {
    $images[$key] = ormas_demo_image($key, 1200, 700);
}
foreach ($cert_keys as $key) {
    $images[$key] = ormas_demo_image($key, 800, 1100);
}

$file_one = ormas_demo_file('school-guide', 'Гайд «Адаптация к школе»', "ORMAS demo material\n\nГайд для родителей первоклассников.\n");
$file_two = ormas_demo_file('speech-cards', 'Карточки для развития речи', "ORMAS demo material\n\nНабор упражнений для развития речи.\n");
$file_three = ormas_demo_file('attention-games', 'Игры на внимание', "ORMAS demo material\n\nПодборка игр на внимание и концентрацию.\n");
$file_four = ormas_demo_file('parent-checklist', 'Чек-лист для родителей', "ORMAS demo material\n\nЧек-лист подготовки к консультации.\n");

/* -------------------------------------------------------------------------
 * Site settings, pages and home/blog assignment
 * ---------------------------------------------------------------------- */

WP_CLI::log('Creating pages and configuring the front page...');

$home_id = ormas_demo_upsert('page', 'home', 'Главная', '<p>Добро пожаловать в центр детской нейропсихологии ORMAS.</p>');
$blog_id = ormas_demo_upsert('page', 'blog', 'Блог', '');
$contacts_id = ormas_demo_upsert('page', 'contacts', 'Контакты', '<p>Свяжитесь с нами удобным способом.</p>');
$reviews_id = ormas_demo_upsert('page', 'reviews', 'Отзывы', '');
$materials_id = ormas_demo_upsert('page', 'materialy', 'Материалы', '');
$agreement_id = ormas_demo_upsert('page', 'agreement', 'Пользовательское соглашение', '<h2>Согласие на обработку персональных данных</h2>
<p>Настоящий документ является тестовым текстом для локальной среды разработки. Он описывает порядок обработки персональных данных, цели обработки, сроки хранения и права субъекта персональных данных.</p>
<h3>1. Общие положения</h3>
<p>Оператор обрабатывает персональные данные пользователей сайта исключительно для обработки заявок и обратной связи. Данные не передаются третьим лицам, за исключением случаев, предусмотренных законодательством.</p>
<h3>2. Состав данных</h3>
<p>Обрабатываются имя, адрес электронной почты, номер телефона и текст сообщения, который пользователь добровольно указывает в форме.</p>
<h3>3. Права пользователя</h3>
<p>Пользователь вправе запросить уточнение, блокирование или удаление своих персональных данных, направив обращение на электронную почту оператора.</p>
<h3>4. Контакты</h3>
<p>По вопросам обработки персональных данных: info@ormas.local.</p>');

// The theme's home.php is the main landing page: it renders all homepage
// sections, the FAQ and the latest posts. page_for_posts still points to the
// "Блог" page because several homepage sections read their data from it.
update_option('show_on_front', 'posts');
update_option('page_on_front', $home_id);
update_option('page_for_posts', $blog_id);

wp_update_post(['ID' => $home_id, 'post_title' => 'Главная']);
wp_update_post(['ID' => $blog_id, 'post_title' => 'Блог']);

/* -------------------------------------------------------------------------
 * Theme options
 * ---------------------------------------------------------------------- */

WP_CLI::log('Filling theme options...');

ormas_demo_set_options([
    'options_email'                 => 'info@ormas.local',
    'options_number'                => '+7 (926) 669-95-46',
    'options_whatsapp'              => '+7 (926) 669-95-46',
    'options_vk'                    => 'https://vk.com/ormaspro',
    'options_dzen'                  => 'https://dzen.ru/ormaspro',
    'options_youtube'               => 'https://youtube.com/@ormaspro',
    'twitter_link'                  => 'https://x.com/ormaspro',
    'options_telegram'              => 'https://t.me/ormaspro',
    'options_work_hours'            => 'Ежедневно с 10:00 до 20:00',
    'options_address'               => 'Москва, Мичуринский проспект, д. 19, корп. 1',
    'options_map_description'       => '5 минут пешком от метро «Ломоносовский проспект». Вход со стороны двора, на первом этаже. Для автомобилей есть бесплатная парковка.',
    'options_map_script'            => '<iframe src="https://yandex.ru/map-widget/v1/?ll=37.504948%2C55.697934&z=16" width="100%" height="420" frameborder="0" allowfullscreen="true"></iframe>',
    'ip_info'                       => 'ИП Каверина Анастасия Романовна',
    'inn_info'                      => '772665158877',
    'ogrnip_info'                   => '320774600123456',
    'agreement_user'               => '/agreement/',
    'offer_agreement'              => '/agreement/',
    'center_rules'                 => '/agreement/',
    'all_services'                 => '/service/our-services/',
    'options_bank_account'         => '40802810900001234567',
    'options_bank_name'            => 'АО «Тинькофф Банк»',
    'options_correspondent_account' => '30101810145250000974',
    'options_bik'                  => '044525974',
]);

/* -------------------------------------------------------------------------
 * Directions and specialists
 * ---------------------------------------------------------------------- */

WP_CLI::log('Creating specialist directions and team...');

$directions = [
    'neuropsychology'       => 'Нейропсихология',
    'speech'                => 'Логопедия и дефектология',
    'psychological-support' => 'Психологическая поддержка',
    'bos-therapy'           => 'БОС-терапия',
    'neurocorrection'       => 'Нейрокоррекция',
    'diagnostics'           => 'Нейропсихологическая диагностика',
];

$direction_ids = [];
foreach ($directions as $slug => $name) {
    $term = term_exists($slug, 'direction');
    if ($term) {
        $term_id = (int) $term['term_id'];
        wp_update_term($term_id, 'direction', ['name' => $name, 'slug' => $slug]);
    } else {
        $created = wp_insert_term($name, 'direction', ['slug' => $slug]);
        $term_id = is_wp_error($created) ? 0 : (int) $created['term_id'];
    }
    $direction_ids[$slug] = $term_id;
}

$team_data = [
    [
        'slug'        => 'anna-smirnova',
        'title'       => 'Анна Смирнова',
        'position'    => 'Клинический психолог, нейропсихолог',
        'education'   => 'МГУ им. М. В. Ломоносова, факультет психологии',
        'description' => 'Работает с детьми дошкольного и младшего школьного возраста. Проводит нейропсихологическую диагностику, развивающие и коррекционные занятия.',
        'direction'   => 'neuropsychology',
    ],
    [
        'slug'        => 'maria-petrova',
        'title'       => 'Мария Петрова',
        'position'    => 'Логопед-дефектолог',
        'education'   => 'МПГУ, дефектологический факультет',
        'description' => 'Занимается запуском речи, коррекцией звукопроизношения и развитием связной речи у детей от 2 лет.',
        'direction'   => 'speech',
    ],
    [
        'slug'        => 'elena-kuznetsova',
        'title'       => 'Елена Кузнецова',
        'position'    => 'Детский и семейный психолог',
        'education'   => 'РГГУ, Институт психологии им. Л. С. Выготского',
        'description' => 'Помогает детям и подросткам справляться с тревогой, адаптацией, конфликтами и эмоциональными трудностями.',
        'direction'   => 'psychological-support',
    ],
    [
        'slug'        => 'dmitry-sokolov',
        'title'       => 'Дмитрий Соколов',
        'position'    => 'БОС-терапевт',
        'education'   => 'РНИМУ им. Н. И. Пирогова, повышение квалификации по БОС-терапии',
        'description' => 'Проводит сеансы БОС-терапии, помогает формировать навыки саморегуляции и концентрации внимания.',
        'direction'   => 'bos-therapy',
    ],
    [
        'slug'        => 'olga-morozova',
        'title'       => 'Ольга Морозова',
        'position'    => 'Нейропсихолог, специалист по нейрокоррекции',
        'education'   => 'СПбГУ, клиническая психология',
        'description' => 'Ведёт групповые и индивидуальные программы нейрокоррекции, работает с трудностями обучения и внимания.',
        'direction'   => 'neurocorrection',
    ],
    [
        'slug'        => 'irina-volkova',
        'title'       => 'Ирина Волкова',
        'position'    => 'Нейропсихолог-диагност',
        'education'   => 'МГППУ, факультет психологии образования',
        'description' => 'Проводит комплексную нейропсихологическую диагностику и составляет индивидуальные рекомендации для семьи и школы.',
        'direction'   => 'diagnostics',
    ],
];

$team_ids = [];
$team_review_rows = [
    ['rating' => '5', 'title' => 'Очень внимательный специалист', 'content' => '<p>Спасибо за подробную консультацию и понятные рекомендации.</p>'],
    ['rating' => '5', 'title' => 'Ребёнку комфортно', 'content' => '<p>Занятия проходят в спокойной атмосфере, ребёнок идёт с удовольствием.</p>'],
    ['rating' => '4', 'title' => 'Полезная диагностика', 'content' => '<p>Получили развёрнутое заключение и план занятий.</p>'],
];

foreach ($team_data as $index => $person) {
    $photo = $images['team-' . ($index + 1)];
    $team_id = ormas_demo_upsert('team', $person['slug'], $person['title'], '<p>' . $person['description'] . '</p>');
    if (! $team_id) {
        continue;
    }
    $team_ids[$person['slug']] = $team_id;

    if (! empty($direction_ids[$person['direction']])) {
        wp_set_object_terms($team_id, [$direction_ids[$person['direction']]], 'direction', false);
    }

    $reviews = [];
    foreach ($team_review_rows as $row_index => $row) {
        $reviews[] = [
            'specialist_reviews_rating'  => $row['rating'],
            'specialist_reviews_title'   => $row['title'],
            'specialist_reviews_content' => $row['content'],
        ];
    }

    ormas_demo_set_post($team_id, [
        'specialist_photo'                => $photo,
        'specialist_position'             => $person['position'],
        'specialist_education'            => $person['education'],
        'certificates_specialist'         => [$images['cert-1'], $images['cert-2']],
        'specialist_description'          => $person['description'],
        'specialist_certificates'         => [$images['cert-3'], $images['cert-4']],
        'specialist_additional_services'  => [
            ['specialist_additional_services_title' => 'Индивидуальные консультации'],
            ['specialist_additional_services_title' => 'Диагностика и заключение'],
            ['specialist_additional_services_title' => 'Родительские встречи'],
        ],
        'specialist_additional_education' => [
            ['specialist_additional_education_title' => 'Повышение квалификации «Детская нейропсихология»'],
            ['specialist_additional_education_title' => 'Курс «Работа с детьми с ОВЗ»'],
        ],
        'specialist_experience'           => [
            ['specialist_experience_title' => 'Центр детской нейропсихологии ORMAS — с 2019 года'],
            ['specialist_experience_title' => 'Частная практика — с 2016 года'],
        ],
        'specialist_reviews'              => $reviews,
    ]);
}

/* -------------------------------------------------------------------------
 * Price lists
 * ---------------------------------------------------------------------- */

WP_CLI::log('Creating price lists...');

$price_posts = [
    'diagnostics' => [
        'title' => 'Нейропсихологическая диагностика',
        'rows'  => [
            ['service_title' => 'Первичная диагностика', 'service_subtitle' => '60 минут, заключение', 'service_duration' => '60 мин', 'service_face_to_face' => '4 500 ₽', 'service_online' => '4 000 ₽'],
            ['service_title' => 'Повторная диагностика', 'service_subtitle' => '45 минут', 'service_duration' => '45 мин', 'service_face_to_face' => '3 500 ₽', 'service_online' => '3 000 ₽'],
            ['service_title' => 'Консультация по результатам', 'service_subtitle' => '30 минут', 'service_duration' => '30 мин', 'service_face_to_face' => '2 000 ₽', 'service_online' => '1 800 ₽'],
        ],
    ],
    'lessons' => [
        'title' => 'Коррекционные занятия',
        'rows'  => [
            ['service_title' => 'Индивидуальное занятие', 'service_subtitle' => 'Нейропсихолог', 'service_duration' => '45 мин', 'service_face_to_face' => '3 000 ₽', 'service_online' => '2 700 ₽'],
            ['service_title' => 'Абонемент 8 занятий', 'service_subtitle' => 'Нейропсихолог', 'service_duration' => '45 мин', 'service_face_to_face' => '22 000 ₽', 'service_online' => '20 000 ₽'],
            ['service_title' => 'Групповое занятие', 'service_subtitle' => 'До 4 детей', 'service_duration' => '45 мин', 'service_face_to_face' => '1 800 ₽', 'service_online' => '1 600 ₽'],
        ],
    ],
    'consultations' => [
        'title' => 'Консультации специалистов',
        'rows'  => [
            ['service_title' => 'Консультация логопеда', 'service_subtitle' => 'Первичная', 'service_duration' => '45 мин', 'service_face_to_face' => '2 500 ₽', 'service_online' => '2 200 ₽'],
            ['service_title' => 'Консультация психолога', 'service_subtitle' => 'Детская / семейная', 'service_duration' => '60 мин', 'service_face_to_face' => '3 000 ₽', 'service_online' => '2 800 ₽'],
            ['service_title' => 'БОС-терапия', 'service_subtitle' => 'Сеанс', 'service_duration' => '40 мин', 'service_face_to_face' => '2 200 ₽', 'service_online' => '—'],
        ],
    ],
];

$price_ids = [];
foreach ($price_posts as $slug => $price_post) {
    $price_id = ormas_demo_upsert('service', $slug, $price_post['title']);
    if (! $price_id) {
        continue;
    }
    $price_ids[$slug] = $price_id;
    ormas_demo_set_post($price_id, ['service_prices' => $price_post['rows']]);
}

$all_price_ids = array_values($price_ids);
$price_refs = [];
foreach ($all_price_ids as $price_id) {
    $price_refs[] = ['price_id' => (string) $price_id];
}

/* -------------------------------------------------------------------------
 * Service list for the homepage / services page
 * ---------------------------------------------------------------------- */

WP_CLI::log('Creating service cards...');

$service_cards = [
    ['neuropsychology', 'Нейропсихологическая диагностика', '5–12 лет', 'Диагностика, консультация, заключение', 'service-1'],
    ['psychological-support', 'Психологическая поддержка', '3–18 лет', 'Консультации для детей, подростков и родителей', 'service-2'],
    ['logoped-defektolog', 'Логопед-дефектолог', '2–10 лет', 'Запуск речи, звукопроизношение, развитие речи', 'service-3'],
    ['bos-therapy', 'БОС-терапия', '6–14 лет', 'Саморегуляция, внимание, снижение тревожности', 'service-4'],
    ['nejrokorrekcziya', 'Нейрокоррекция', '4–12 лет', 'Индивидуальные и групповые программы', 'service-5'],
    ['launch-speech', 'Запуск речи', '2–5 лет', 'Первичный приём и занятия с логопедом', 'service-6'],
];

foreach ($service_cards as $index => $card) {
    [$page_slug, $title, $age, $services, $image_key] = $card;

    $service_id = ormas_demo_upsert(
        'service_list',
        $page_slug . '-card',
        $title,
        '<p>' . $services . '. Индивидуальный подход и бережная атмосфера на занятиях.</p>'
    );
    if (! $service_id) {
        continue;
    }

    ormas_demo_set_post($service_id, [
        'img_service' => $images[$image_key],
        'link'        => '/service/' . $page_slug . '/',
        'age'         => $age,
        'services'    => $services,
    ]);
}

/* -------------------------------------------------------------------------
 * Homepage / blog custom fields
 * ---------------------------------------------------------------------- */

WP_CLI::log('Filling homepage custom fields...');

$home_faq = [
    ['question' => 'С какого возраста вы принимаете детей?', 'answer' => 'Мы работаем с детьми от 2 до 18 лет. Для малышей подбираем щадящий формат занятий.'],
    ['question' => 'Сколько длится первичная консультация?', 'answer' => 'Первичная консультация длится 60 минут и включает сбор анамнеза, диагностику и рекомендации.'],
    ['question' => 'Нужна ли подготовка к диагностике?', 'answer' => 'Специальная подготовка не требуется. Достаточно взять с собой удобную одежду и любимую игрушку ребёнка.'],
    ['question' => 'Можно ли заниматься онлайн?', 'answer' => 'Да, часть консультаций и занятий доступна онлайн. Формат подбирается индивидуально.'],
    ['question' => 'Как записаться на занятие?', 'answer' => 'Оставьте заявку на сайте или позвоните администратору. Мы подберём специалиста и удобное время.'],
];

$review_rows = [];
for ($i = 1; $i <= 6; $i++) {
    $review_rows[] = [
        'review_name'    => ['Мама Софии', 'Алексей', 'Екатерина', 'Ирина', 'Дмитрий', 'Ольга'][$i - 1],
        'review_image'   => $images['avatar-' . $i],
        'review_avatar'  => wp_get_attachment_url($images['avatar-' . $i]),
    ];
}

$main_page_fields = [
    'material_title'           => 'Гайд «Адаптация к школе без стресса»',
    'material_description'    => 'Практическое руководство для родителей будущих первоклассников: как подготовить ребёнка к школе, снизить тревожность и выстроить режим дня.',
    'material_link'           => '/materialy/',
    'material_file_list'      => [
        ['material_file' => $file_one],
        ['material_file' => $file_two],
    ],
    'material_image'          => $images['content-1'],
    'material_position_top'   => '20',
    'material_position_left'  => '10',
    'material_mail_title'     => 'Ваш гайд от ORMAS',
    'material_mail_text'      => '<p>Спасибо за интерес к материалам ORMAS! Во вложении — гайд по адаптации к школе.</p>',
    'reviews_list'            => $review_rows,
    'certificates_gallery'    => [$images['cert-1'], $images['cert-2'], $images['cert-3'], $images['cert-4']],
    'service_faq'             => $home_faq,
    'specialists_direction_slug' => 'neuropsychology',
];

ormas_demo_set_post($blog_id, $main_page_fields);
ormas_demo_set_post($home_id, ['specialists_direction_slug' => 'neuropsychology']);

/* -------------------------------------------------------------------------
 * Service pages
 * ---------------------------------------------------------------------- */

WP_CLI::log('Filling service pages...');

$service_faq = [
    ['question' => 'Как записаться на занятие?', 'answer' => 'Оставьте заявку на сайте или позвоните администратору — мы подберём удобное время.'],
    ['question' => 'Кто проводит занятия?', 'answer' => 'Занятия проводят специалисты с профильным высшим образованием и регулярным повышением квалификации.'],
    ['question' => 'Можно ли перенести занятие?', 'answer' => 'Да, перенести занятие можно не позднее чем за 24 часа до начала.'],
    ['question' => 'Есть ли абонементы?', 'answer' => 'Да, абонемент на 8 занятий выгоднее разовых встреч. Подробности — в прайс-листе.'],
];

$service_pages = [
    'neuropsychology' => [
        'title'   => 'Нейропсихология',
        'content' => '<p>Нейропсихологическая помощь детям с трудностями обучения, внимания, поведения и эмоциональной регуляции.</p>',
        'hero'    => 'hero-neuro',
        'direction' => 'neuropsychology',
    ],
    'psychological-support' => [
        'title'   => 'Психологическое сопровождение',
        'content' => '<p>Бережная психологическая поддержка для детей, подростков и родителей.</p>',
        'hero'    => 'hero-psych',
        'direction' => 'psychological-support',
    ],
    'logoped-defektolog' => [
        'title'   => 'Логопед-дефектолог',
        'content' => '<p>Запуск речи, коррекция звукопроизношения и развитие коммуникативных навыков.</p>',
        'hero'    => 'hero-speech',
        'direction' => 'speech',
    ],
    'bos-therapy' => [
        'title'   => 'БОС-терапия',
        'content' => '<p>Метод биологической обратной связи для тренировки саморегуляции, внимания и снижения тревожности.</p>',
        'hero'    => 'hero-bos',
        'direction' => 'bos-therapy',
    ],
    'nejrokorrekcziya' => [
        'title'   => 'Нейрокоррекция',
        'content' => '<p>Развивающие и коррекционные программы для детей с трудностями обучения и поведения.</p>',
        'hero'    => 'hero-corr',
        'direction' => 'neurocorrection',
    ],
    'nejropsihologicheskaya-diagnostika' => [
        'title'   => 'Нейропсихологическая диагностика',
        'content' => '<p>Комплексное обследование познавательных процессов, внимания, памяти и эмоционально-волевой сферы.</p>',
        'hero'    => 'hero-diag',
        'direction' => 'diagnostics',
    ],
    'our-services' => [
        'title'   => 'Наши услуги',
        'content' => '<p>Все программы центра ORMAS: диагностика, консультации, коррекционные и развивающие занятия.</p>',
        'hero'    => 'hero-services',
        'direction' => 'neuropsychology',
    ],
    'launch-speech' => [
        'title'   => 'Запуск речи',
        'content' => '<p>Программа для детей с задержкой речевого развития и отсутствием активной речи.</p>',
        'hero'    => 'hero-launch',
        'direction' => 'speech',
    ],
];

$service_page_ids = [];
foreach ($service_pages as $slug => $page) {
    $page_id = ormas_demo_upsert('service_pages', $slug, $page['title'], $page['content']);
    if (! $page_id) {
        continue;
    }
    $service_page_ids[$slug] = $page_id;

    ormas_demo_set_post($page_id, [
        'header_image'              => $images[$page['hero']],
        'service_faq'               => $service_faq,
        'price_ids'                 => $price_refs,
        'specialists_direction_slug' => $page['direction'],
    ]);
}

// Neuropsychology.
if (! empty($service_page_ids['neuropsychology'])) {
    $how_work = [];
    $how_titles = [
        ['Знакомство и диагностика', 'На первой встрече специалист знакомится с ребёнком и семьёй, уточняет запрос и проводит диагностику.'],
        ['Индивидуальный план', 'По результатам обследования составляется план занятий с учётом сильных и слабых сторон ребёнка.'],
        ['Регулярные занятия', 'Занятия проходят в игровой форме и включают упражнения на внимание, память, моторику и саморегуляцию.'],
        ['Обратная связь родителям', 'После каждого блока занятий специалист обсуждает динамику и даёт рекомендации для дома.'],
    ];
    foreach ($how_titles as $i => $item) {
        $how_work[] = ['title' => $item[0], 'content' => '<p>' . $item[1] . '</p>'];
    }

    $can_ask = [];
    $ask_titles = [
        ['Трудности обучения', 'Ребёнок быстро устаёт, не успевает за темпом класса, испытывает трудности с чтением и письмом.'],
        ['Невнимательность и импульсивность', 'Сложно сосредоточиться, довести дело до конца, часто отвлекается и перебивает.'],
        ['Эмоциональные трудности', 'Тревожность, страхи, резкие перепады настроения, сложности в общении со сверстниками.'],
        ['Подготовка к школе', 'Необходимо оценить готовность к школе и подобрать развивающую программу.'],
    ];
    foreach ($ask_titles as $i => $item) {
        $can_ask[] = [
            'title'   => $item[0],
            'content' => '<p>' . $item[1] . '</p>',
            'image'   => $images['content-' . ($i + 2)],
        ];
    }

    ormas_demo_set_post($service_page_ids['neuropsychology'], [
        'how_work_items'    => $how_work,
        'can_ask_for_items' => $can_ask,
    ]);
}

// Speech.
if (! empty($service_page_ids['logoped-defektolog'])) {
    $problems = [
        ['Ребёнок не говорит', 'Нет активной речи или словарный запас значительно ниже возрастной нормы.'],
        ['Нарушено звукопроизношение', 'Ребёнок заменяет, пропускает или искажает звуки.'],
        ['Трудности с пониманием речи', 'Сложно понимать инструкции, различать звуки и следовать правилам.'],
        ['Задержка речевого развития', 'Речь появилась позже возрастных норм или развивается неравномерно.'],
    ];
    $problem_rows = [];
    foreach ($problems as $item) {
        $problem_rows[] = ['title' => $item[0], 'subtitle' => $item[1]];
    }

    $how_work = [];
    $how_titles = [
        ['Первичный приём', 'Логопед оценивает речевое развитие, слух и артикуляцию, обсуждает запрос семьи.'],
        ['Индивидуальная программа', 'Подбираются упражнения и игры под конкретные трудности ребёнка.'],
        ['Занятия в игровой форме', 'Развиваем дыхание, артикуляцию, слуховое восприятие и связную речь.'],
        ['Домашние задания', 'Родители получают простые упражнения для закрепления результата дома.'],
    ];
    foreach ($how_titles as $i => $item) {
        $how_work[] = [
            'title' => $item[0],
            'text'  => $item[1],
            'image' => $images['content-' . ($i + 5)],
        ];
    }

    $advantages = [];
    $adv_titles = [
        ['Индивидуальный подход', 'Программа строится под возможности и интересы ребёнка.'],
        ['Игровой формат', 'Ребёнок занимается с интересом и без напряжения.'],
        ['Работа с родителями', 'Объясняем, как поддержать речь дома.'],
        ['Понятная динамика', 'Регулярно показываем результаты и корректируем план.'],
    ];
    foreach ($adv_titles as $i => $item) {
        $advantages[] = [
            'title' => $item[0],
            'text'  => $item[1],
            'image' => $images['content-' . ($i + 8)],
        ];
    }

    ormas_demo_set_post($service_page_ids['logoped-defektolog'], [
        's_contact_with_problem'      => $problem_rows,
        's_how_work'                  => $how_work,
        's_how_work_advantages_list'  => $advantages,
    ]);
}

// Psychological support.
if (! empty($service_page_ids['psychological-support'])) {
    $children = [
        ['Страхи и тревожность', 'Помогаем ребёнку понимать свои эмоции и справляться с тревогой.'],
        ['Адаптация к школе и саду', 'Поддерживаем в период перемен и помогаем выстроить новые привычки.'],
        ['Трудности в общении', 'Учим выражать чувства, договариваться и находить друзей.'],
    ];
    $teenagers = [
        ['Подростковый кризис', 'Помогаем подростку разобраться в себе и выстроить отношения с близкими.'],
        ['Самооценка и уверенность', 'Работаем с сомнениями в себе, страхом ошибок и критикой.'],
        ['Профориентация', 'Исследуем интересы и сильные стороны, обсуждаем будущее.'],
    ];
    $parents = [
        ['Воспитание без крика', 'Подбираем стратегии, которые помогают сохранять контакт и границы.'],
        ['Семейные конфликты', 'Помогаем услышать друг друга и найти общее решение.'],
        ['Поддержка в трудный период', 'Разбираем, как поддержать ребёнка и сохранить собственные ресурсы.'],
    ];

    $children_rows = [];
    foreach ($children as $item) {
        $children_rows[] = ['text' => $item[0] . ': ' . $item[1]];
    }
    $teenager_rows = [];
    foreach ($teenagers as $item) {
        $teenager_rows[] = ['text' => $item[0] . ': ' . $item[1]];
    }
    $parent_rows = [];
    foreach ($parents as $item) {
        $parent_rows[] = ['text' => $item[0] . ': ' . $item[1]];
    }

    $how_work = [];
    $how_titles = [
        ['Знакомство', 'На первой встрече обсуждаем запрос и подбираем формат работы.'],
        ['Диагностическая беседа', 'Понимаем, что стоит за трудностями ребёнка или семьи.'],
        ['Регулярные встречи', 'Работаем с эмоциями, отношениями и навыками совладания.'],
    ];
    foreach ($how_titles as $i => $item) {
        $how_work[] = [
            'title'   => $item[0],
            'content' => '<p>' . $item[1] . '</p>',
            'image'   => $images['content-' . ($i + 2)],
        ];
    }

    ormas_demo_set_post($service_page_ids['psychological-support'], [
        'psychological_support_children'   => $children_rows,
        'psychological_support_teenagers'  => $teenager_rows,
        'psychological_support_parents'    => $parent_rows,
        'psychological_support_how_work'   => $how_work,
        'warning_title'                    => 'Когда нужна помощь специалиста',
        'warning_text'                     => '<p>Если трудности длятся больше нескольких недель, мешают учёбе, сну или отношениям, стоит обратиться за консультацией. Ранняя поддержка помогает быстрее вернуть ребёнку уверенность и спокойствие.</p>',
    ]);
}

// BOS therapy.
if (! empty($service_page_ids['bos-therapy'])) {
    $advantages = [];
    $adv_titles = [
        ['Без лекарств', 'Метод не требует медикаментозного вмешательства.'],
        ['Наглядный результат', 'Ребёнок видит свои успехи на экране в реальном времени.'],
        ['Интересно ребёнку', 'Занятие проходит в формате игры.'],
        ['Долгосрочный эффект', 'Формируются навыки саморегуляции, которые остаются с ребёнком.'],
    ];
    foreach ($adv_titles as $item) {
        $advantages[] = ['title' => $item[0], 'text' => '<p>' . $item[1] . '</p>'];
    }

    $how_work = [];
    $how_titles = [
        ['Подготовка', 'Специалист закрепляет датчики и объясняет ребёнку, как будет проходить занятие.'],
        ['Игровое задание', 'Ребёнок управляет персонажем на экране с помощью своего состояния.'],
        ['Обратная связь', 'Организм получает сигнал о том, когда он расслаблен и сосредоточен.'],
        ['Закрепление', 'Навык переносится в повседневную жизнь и учебные ситуации.'],
    ];
    foreach ($how_titles as $i => $item) {
        $how_work[] = [
            'title' => $item[0],
            'text'  => $item[1],
            'image' => $images['content-' . ($i + 5)],
        ];
    }

    $problems = [];
    $problem_titles = [
        ['СДВГ', 'Трудности концентрации, импульсивность и гиперактивность.'],
        ['Тревожность', 'Напряжение, страхи и сложности с расслаблением.'],
        ['Нарушения сна', 'Трудности засыпания и беспокойный сон.'],
        ['Энурез', 'Функциональные нарушения, требующие комплексного подхода.'],
    ];
    foreach ($problem_titles as $i => $item) {
        $problems[] = [
            'title' => $item[0],
            'text'  => '<p>' . $item[1] . '</p>',
            'image' => $images['content-' . ($i + 9)],
        ];
    }

    ormas_demo_set_post($service_page_ids['bos-therapy'], [
        'bos_about_method' => '<p>БОС-терапия — это метод биологической обратной связи, при котором ребёнок учится управлять вниманием, дыханием и эмоциональным состоянием с помощью игровых заданий и сигналов обратной связи.</p><p>Метод безопасен, не требует медикаментов и хорошо сочетается с другими занятиями.</p>',
        'bos_advantages'   => $advantages,
        'bos_how_work'     => $how_work,
        'bos_problems'     => $problems,
    ]);
}

// Neurocorrection.
if (! empty($service_page_ids['nejrokorrekcziya'])) {
    $cards = [];
    $card_titles = [
        ['Внимание и память', 'Упражнения помогают удерживать внимание, запоминать инструкции и работать по плану.'],
        ['Моторика и координация', 'Развиваем крупную и мелкую моторику, чувство тела и пространственные представления.'],
        ['Саморегуляция', 'Учим ребёнка замечать своё состояние и управлять импульсами.'],
        ['Учебные навыки', 'Формируем предпосылки чтения, письма и счёта.'],
    ];
    foreach ($card_titles as $item) {
        $cards[] = ['card_title' => $item[0], 'card_text' => $item[1]];
    }

    $stages = [];
    $stage_titles = [
        ['Диагностика', 'Определяем сильные стороны и зоны роста ребёнка.'],
        ['Индивидуальный план', 'Подбираем последовательность упражнений и нагрузку.'],
        ['Коррекционные занятия', 'Регулярно тренируем нужные навыки в игровой форме.'],
        ['Итоговая встреча', 'Обсуждаем динамику и рекомендации на будущее.'],
    ];
    foreach ($stage_titles as $i => $item) {
        $stages[] = [
            'stage_title'       => $item[0],
            'stage_description' => $item[1],
            'stage_image'       => $images['content-' . ($i + 2)],
        ];
    }

    ormas_demo_set_post($service_page_ids['nejrokorrekcziya'], [
        'cards'       => $cards,
        'work_stages' => $stages,
    ]);
}

// Neurodiagnostics.
if (! empty($service_page_ids['nejropsihologicheskaya-diagnostika'])) {
    $items = [];
    $item_titles = [
        ['Понять причины трудностей', 'Диагностика показывает, какие функции требуют поддержки.'],
        ['Оценить готовность к школе', 'Понимаем, какие навыки уже сформированы, а какие нужно развивать.'],
        ['Подобрать программу', 'Получаем основу для индивидуального плана занятий.'],
        ['Отследить динамику', 'Повторная диагностика показывает результат работы.'],
    ];
    foreach ($item_titles as $i => $item) {
        $items[] = [
            'item_title' => $item[0],
            'item_text'  => $item[1],
            'image'      => $images['content-' . ($i + 2)],
        ];
    }

    $steps = [];
    $step_titles = [
        ['Беседа с родителями', 'Собираем анамнез и уточняем запрос.'],
        ['Диагностические пробы', 'Выполняем задания на память, внимание, мышление и речь.'],
        ['Наблюдение', 'Оцениваем, как ребёнок действует в новой ситуации.'],
        ['Заключение и рекомендации', 'Обсуждаем результаты и составляем план дальнейших шагов.'],
    ];
    foreach ($step_titles as $i => $item) {
        $steps[] = [
            'step_title'       => $item[0],
            'step_description' => $item[1],
            'step_image'       => $images['content-' . ($i + 6)],
        ];
    }

    ormas_demo_set_post($service_page_ids['nejropsihologicheskaya-diagnostika'], [
        'items'         => $items,
        'steps'         => $steps,
        'warning_title' => 'Важно знать',
        'warning_text'  => '<p>Диагностика не является медицинским диагнозом. Это инструмент, который помогает понять особенности развития ребёнка и подобрать подходящую поддержку.</p>',
    ]);
}

// Launch speech.
if (! empty($service_page_ids['launch-speech'])) {
    $stages = [];
    $stage_titles = [
        ['2–3 месяца', 'Гуление, первые звуки, реакция на голос взрослого.'],
        ['6–9 месяцев', 'Лепет, повторение слогов, понимание простых слов.'],
        ['1–1,5 года', 'Первые слова, указательный жест, понимание инструкций.'],
        ['2 года', 'Фразы из двух слов, активный словарный запас.'],
        ['3 года', 'Развёрнутая речь, вопросы, диалог со взрослым.'],
    ];
    foreach ($stage_titles as $item) {
        $stages[] = ['title' => $item[0], 'text' => $item[1]];
    }

    $intro = [];
    $intro_titles = [
        ['Первичный приём', 'Логопед оценивает речевое развитие и подбирает программу занятий.', 'content-2'],
        ['Занятия', 'Регулярные встречи в игровой форме, работа с родителями и домашними заданиями.', 'content-3'],
    ];
    foreach ($intro_titles as $item) {
        $intro[] = ['title' => $item[0], 'text' => $item[1], 'image' => $images[$item[2]]];
    }

    $principles = [];
    $principle_titles = [
        ['Игровой формат', 'Ребёнок учится через игру и интересные задания.', 'content-4'],
        ['Бережный темп', 'Не торопим ребёнка и учитываем его возможности.', 'content-5'],
        ['Работа с родителями', 'Объясняем, как заниматься дома.', 'content-6'],
        ['Регулярность', 'Небольшие занятия несколько раз в неделю дают результат.', 'content-7'],
        ['Положительное подкрепление', 'Отмечаем успехи и поддерживаем мотивацию.', 'content-8'],
        ['Комплексный подход', 'При необходимости подключаем других специалистов.', 'content-9'],
    ];
    foreach ($principle_titles as $item) {
        $principles[] = [
            'title' => $item[0],
            'text'  => $item[1],
            'icon'  => $images[$item[2]],
        ];
    }

    ormas_demo_set_post($service_page_ids['launch-speech'], [
        'ls_section_title'       => 'Этапы развития речи у ребёнка',
        'ls_speech_stages'       => $stages,
        'warning_title'          => 'Когда стоит обратиться к логопеду',
        'warning_text'           => 'Если ребёнок не говорит в 2 года, говорит мало или его речь непонятна окружающим — проконсультируйтесь со специалистом. Раннее обращение помогает быстрее запустить речь.',
        'ls_how_work_title'      => 'Как проходит работа',
        'ls_how_work_intro'      => $intro,
        'ls_how_work_principles' => $principles,
    ]);
}

/* -------------------------------------------------------------------------
 * Materials page
 * ---------------------------------------------------------------------- */

WP_CLI::log('Filling materials page...');

$materials = [
    [
        'material_title'      => 'Гайд «Адаптация к школе»',
        'material_description' => 'Практические советы для родителей будущих первоклассников.',
        'material_price'      => '',
        'material_link'       => '',
        'files'               => [$file_one],
        'image'               => $images['content-1'],
        'position_top'        => '20',
        'position_left'       => '10',
        'mail_title'          => 'Ваш гайд по адаптации к школе',
        'mail_text'           => '<p>Спасибо! Гайд прикреплён к письму.</p>',
    ],
    [
        'material_title'      => 'Карточки для развития речи',
        'material_description' => 'Набор упражнений для занятий с ребёнком дома.',
        'material_price'      => '390',
        'material_link'       => '',
        'files'               => [$file_two],
        'image'               => $images['content-2'],
        'position_top'        => '',
        'position_left'       => '',
        'mail_title'          => 'Карточки для развития речи',
        'mail_text'           => '<p>Спасибо за покупку! Карточки прикреплены к письму.</p>',
    ],
    [
        'material_title'      => 'Игры на внимание',
        'material_description' => 'Подборка игр для развития концентрации и усидчивости.',
        'material_price'      => '',
        'material_link'       => '/materialy/',
        'files'               => [$file_three],
        'image'               => $images['content-3'],
        'position_top'        => '',
        'position_left'       => '',
        'mail_title'          => 'Игры на внимание',
        'mail_text'           => '<p>Ссылка на подборку игр уже доступна.</p>',
    ],
    [
        'material_title'      => 'Чек-лист для родителей',
        'material_description' => 'Что взять с собой на первую консультацию.',
        'material_price'      => '',
        'material_link'       => '',
        'files'               => [$file_four],
        'image'               => $images['content-4'],
        'position_top'        => '',
        'position_left'       => '',
        'mail_title'          => 'Чек-лист для родителей',
        'mail_text'           => '<p>Спасибо! Чек-лист прикреплён к письму.</p>',
    ],
];

$materials_rows = [];
foreach ($materials as $material) {
    $files = [];
    foreach ($material['files'] as $file_id) {
        $files[] = ['material_file' => $file_id];
    }
    $materials_rows[] = [
        'material_title'       => $material['material_title'],
        'material_description' => $material['material_description'],
        'material_price'       => $material['material_price'],
        'material_link'        => $material['material_link'],
        'material_file_list'   => $files,
        'material_image'       => $material['image'],
        'material_position_top' => $material['position_top'],
        'material_position_left' => $material['position_left'],
        'material_mail_title'  => $material['mail_title'],
        'material_mail_text'   => $material['mail_text'],
    ];
}

ormas_demo_set_post($materials_id, ['materials_list' => $materials_rows]);

/* -------------------------------------------------------------------------
 * Blog posts
 * ---------------------------------------------------------------------- */

WP_CLI::log('Creating blog posts...');

$category = term_exists('Полезные статьи', 'category');
if (! $category) {
    $category = wp_insert_term('Полезные статьи', 'category', ['slug' => 'poleznye-stati']);
}
$category_id = is_array($category) ? (int) $category['term_id'] : 0;

$blog_posts = [
    [
        'slug'    => 'kak-podgotovit-rebenka-k-shkole',
        'title'   => 'Как подготовить ребёнка к школе без стресса',
        'excerpt' => 'Пять простых шагов, которые помогут будущему первокласснику адаптироваться к новому режиму.',
        'content' => '<p>Подготовка к школе — это не только умение читать и считать. Важно позаботиться о режиме дня, эмоциональной готовности и навыках самообслуживания.</p><p>Начните с небольшого расписания, обсудите с ребёнком, что его ждёт, и сохраняйте спокойный настрой. Поддержка родителей помогает снизить тревожность и сделать переход в школу более мягким.</p>',
        'image'   => 'blog-1',
        'author'  => 'elena-kuznetsova',
    ],
    [
        'slug'    => 'igry-na-vnimanie',
        'title'   => 'Игры на внимание для детей 5–7 лет',
        'excerpt' => 'Подборка упражнений, которые можно выполнять дома без специального оборудования.',
        'content' => '<p>Внимание — основа учебной деятельности. Игры на поиск отличий, повторение последовательностей и сортировку предметов помогают тренировать концентрацию.</p><p>Занимайтесь по 10–15 минут в день, меняйте задания и обязательно хвалите ребёнка за старание.</p>',
        'image'   => 'blog-2',
        'author'  => 'anna-smirnova',
    ],
    [
        'slug'    => 'zapusk-rechi',
        'title'   => 'Когда стоит обратиться к логопеду',
        'excerpt' => 'Основные признаки задержки речевого развития и что делать родителям.',
        'content' => '<p>Если ребёнок в два года не говорит или использует только отдельные звуки, стоит проконсультироваться со специалистом. Логопед оценит речевое развитие и подскажет, как помочь дома.</p><p>Раннее обращение позволяет быстрее запустить речь и избежать вторичных трудностей в общении и обучении.</p>',
        'image'   => 'blog-3',
        'author'  => 'maria-petrova',
    ],
];

foreach ($blog_posts as $post) {
    $post_id = ormas_demo_upsert('post', $post['slug'], $post['title'], $post['content'], [
        'post_excerpt' => $post['excerpt'],
    ]);
    if (! $post_id) {
        continue;
    }
    set_post_thumbnail($post_id, $images[$post['image']]);
    if ($category_id) {
        wp_set_post_terms($post_id, [$category_id], 'category', false);
    }
    if (! empty($team_ids[$post['author']])) {
        ormas_demo_set_post($post_id, ['article_author' => (string) $team_ids[$post['author']]]);
    }
}

/* -------------------------------------------------------------------------
 * Menus
 * ---------------------------------------------------------------------- */

WP_CLI::log('Creating navigation menus...');

$menu_name = 'Основное меню';
$menu = wp_get_nav_menu_object($menu_name);
if (! $menu) {
    $menu_id = wp_create_nav_menu($menu_name);
} else {
    $menu_id = (int) $menu->term_id;
}

if (! is_wp_error($menu_id)) {
    // Rebuild items so menu structure stays in sync with the seeder.
    $existing_items = wp_get_nav_menu_items($menu_id);
    if (! empty($existing_items)) {
        foreach ($existing_items as $existing_item) {
            wp_delete_post($existing_item->ID, true);
        }
    }

    $menu_items = [
        ['title' => 'Главная', 'url' => home_url('/'), 'type' => 'custom'],
        ['title' => 'Услуги', 'object_id' => $service_page_ids['our-services'] ?? 0, 'object' => 'page', 'type' => 'post_type'],
        ['title' => 'Специалисты', 'url' => home_url('/team/'), 'type' => 'custom'],
        ['title' => 'Отзывы', 'object_id' => $reviews_id, 'object' => 'page', 'type' => 'post_type'],
        ['title' => 'Материалы', 'object_id' => $materials_id, 'object' => 'page', 'type' => 'post_type'],
        ['title' => 'Блог', 'object_id' => $blog_id, 'object' => 'page', 'type' => 'post_type'],
        ['title' => 'Контакты', 'object_id' => $contacts_id, 'object' => 'page', 'type' => 'post_type'],
    ];

    foreach ($menu_items as $item) {
        $args = [
            'menu-item-title'  => $item['title'],
            'menu-item-status' => 'publish',
        ];
        if ($item['type'] === 'custom') {
            $args['menu-item-type'] = 'custom';
            $args['menu-item-url']  = $item['url'];
        } else {
            $args['menu-item-type']      = 'post_type';
            $args['menu-item-object']    = $item['object'];
            $args['menu-item-object-id'] = (int) $item['object_id'];
        }
        wp_update_nav_menu_item($menu_id, 0, $args);
    }

    $locations = get_theme_mod('nav_menu_locations', []);
    $locations['header-menu']        = $menu_id;
    $locations['footer-menu']        = $menu_id;
    $locations['header-menu-custom'] = $menu_id;
    $locations['footer-menu-news']   = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);
}

/* -------------------------------------------------------------------------
 * Finish
 * ---------------------------------------------------------------------- */

flush_rewrite_rules(false);
wp_cache_flush();

WP_CLI::success(sprintf(
    'Demo data seeded: %d team members, %d price lists, %d service pages, %d blog posts.',
    count($team_ids),
    count($price_ids),
    count($service_page_ids),
    count($blog_posts)
));
