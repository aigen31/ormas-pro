<?php
/**
 * Verifies that the local demo content has been seeded.
 * Run after docker/seed-demo.php.
 */

if (! defined('ABSPATH')) {
    fwrite(STDERR, "This script must be run through WP-CLI.\n");
    exit(1);
}

$failures = [];
$checks = 0;

function ormas_verify_value($label, $value, array &$failures, int &$checks, bool $allow_empty = false): void
{
    $checks++;
    if ($allow_empty) {
        return;
    }

    $is_empty = is_array($value) ? empty($value) : trim((string) $value) === '';
    if ($is_empty) {
        $failures[] = $label;
    }
}

function ormas_verify_post_fields(int $post_id, array $fields, array &$failures, int &$checks, array $allow_empty = []): void
{
    foreach ($fields as $field) {
        ormas_verify_value(
            'post ' . $post_id . ' field ' . $field,
            carbon_get_post_meta($post_id, $field),
            $failures,
            $checks,
            in_array($field, $allow_empty, true)
        );
    }
}

$option_fields = [
    'options_email', 'options_number', 'options_whatsapp', 'options_vk', 'options_dzen',
    'options_youtube', 'twitter_link', 'options_telegram', 'options_work_hours',
    'options_address', 'options_map_description', 'options_map_script', 'ip_info',
    'inn_info', 'ogrnip_info', 'agreement_user', 'offer_agreement', 'center_rules',
    'all_services', 'options_bank_account', 'options_bank_name',
    'options_correspondent_account', 'options_bik',
];
foreach ($option_fields as $field) {
    ormas_verify_value('theme option ' . $field, carbon_get_theme_option($field), $failures, $checks);
}

$blog_id = (int) get_option('page_for_posts');
ormas_verify_value('page_for_posts', $blog_id, $failures, $checks);
ormas_verify_post_fields($blog_id, [
    'material_title', 'material_description', 'material_link', 'material_file_list',
    'material_image', 'material_position_top', 'material_position_left',
    'material_mail_title', 'material_mail_text', 'reviews_list',
    'certificates_gallery', 'service_faq', 'specialists_direction_slug',
], $failures, $checks);

$service_page_fields = [
    'neuropsychology'                    => ['how_work_items', 'can_ask_for_items'],
    'psychological-support'              => ['psychological_support_children', 'psychological_support_teenagers', 'psychological_support_parents', 'psychological_support_how_work', 'warning_title', 'warning_text'],
    'logoped-defektolog'                 => ['s_contact_with_problem', 's_how_work', 's_how_work_advantages_list'],
    'bos-therapy'                        => ['bos_about_method', 'bos_advantages', 'bos_how_work', 'bos_problems'],
    'nejrokorrekcziya'                   => ['cards', 'work_stages'],
    'nejropsihologicheskaya-diagnostika' => ['items', 'steps', 'warning_title', 'warning_text'],
    'launch-speech'                      => ['ls_section_title', 'ls_speech_stages', 'warning_title', 'warning_text', 'ls_how_work_title', 'ls_how_work_intro', 'ls_how_work_principles'],
    'our-services'                       => [],
];

foreach ($service_page_fields as $slug => $specific_fields) {
    $posts = get_posts([
        'name'             => $slug,
        'post_type'        => 'service_pages',
        'post_status'      => 'publish',
        'posts_per_page'   => 1,
        'suppress_filters' => true,
    ]);
    $post_id = ! empty($posts) ? (int) $posts[0]->ID : 0;
    ormas_verify_value('service page ' . $slug, $post_id, $failures, $checks);
    if (! $post_id) {
        continue;
    }
    ormas_verify_post_fields($post_id, array_merge([
        'header_image', 'service_faq', 'price_ids', 'specialists_direction_slug',
    ], $specific_fields), $failures, $checks);
}

$team_posts = get_posts(['post_type' => 'team', 'posts_per_page' => -1, 'post_status' => 'publish']);
ormas_verify_value('team count', count($team_posts) >= 6, $failures, $checks);
foreach ($team_posts as $team_post) {
    ormas_verify_post_fields((int) $team_post->ID, [
        'specialist_photo', 'specialist_position', 'specialist_education',
        'certificates_specialist', 'specialist_description',
        'specialist_certificates', 'specialist_additional_services',
        'specialist_additional_education', 'specialist_experience',
        'specialist_reviews',
    ], $failures, $checks);
}

$price_posts = get_posts(['post_type' => 'service', 'posts_per_page' => -1, 'post_status' => 'publish']);
ormas_verify_value('price list count', count($price_posts) >= 3, $failures, $checks);
foreach ($price_posts as $price_post) {
    ormas_verify_post_fields((int) $price_post->ID, ['service_prices'], $failures, $checks);
}

$service_cards = get_posts(['post_type' => 'service_list', 'posts_per_page' => -1, 'post_status' => 'publish']);
ormas_verify_value('service card count', count($service_cards) >= 6, $failures, $checks);
foreach ($service_cards as $service_card) {
    ormas_verify_post_fields((int) $service_card->ID, ['img_service', 'link', 'age', 'services'], $failures, $checks);
}

$materials_page = get_page_by_path('materialy');
ormas_verify_value('materials page', $materials_page ? (int) $materials_page->ID : 0, $failures, $checks);
if ($materials_page) {
    $materials = carbon_get_post_meta((int) $materials_page->ID, 'materials_list');
    ormas_verify_value('materials count', is_array($materials) && count($materials) >= 4, $failures, $checks);
    foreach ((array) $materials as $index => $material) {
        ormas_verify_value('material ' . $index . ' title', $material['material_title'] ?? '', $failures, $checks);
        ormas_verify_value('material ' . $index . ' description', $material['material_description'] ?? '', $failures, $checks);
        ormas_verify_value('material ' . $index . ' image', $material['material_image'] ?? '', $failures, $checks);
        ormas_verify_value('material ' . $index . ' files', $material['material_file_list'] ?? '', $failures, $checks);
        ormas_verify_value('material ' . $index . ' mail title', $material['material_mail_title'] ?? '', $failures, $checks);
        ormas_verify_value('material ' . $index . ' mail text', $material['material_mail_text'] ?? '', $failures, $checks);
    }
}

$blog_posts = get_posts(['post_type' => 'post', 'posts_per_page' => -1, 'post_status' => 'publish', 'exclude' => [1]]);
ormas_verify_value('blog post count', count($blog_posts) >= 3, $failures, $checks);
foreach ($blog_posts as $blog_post) {
    ormas_verify_value('blog post ' . $blog_post->ID . ' thumbnail', get_post_thumbnail_id((int) $blog_post->ID), $failures, $checks);
    ormas_verify_post_fields((int) $blog_post->ID, ['article_author'], $failures, $checks);
}

$locations = get_theme_mod('nav_menu_locations', []);
ormas_verify_value('header menu location', $locations['header-menu'] ?? 0, $failures, $checks);
ormas_verify_value('footer menu location', $locations['footer-menu'] ?? 0, $failures, $checks);

if (! empty($failures)) {
    WP_CLI::warning('Demo verification: ' . ($checks - count($failures)) . '/' . $checks . ' checks passed.');
    foreach (array_slice($failures, 0, 50) as $failure) {
        WP_CLI::warning('Empty or missing: ' . $failure);
    }
    WP_CLI::error('Demo content verification failed.');
}

WP_CLI::success('Demo verification passed: ' . $checks . '/' . $checks . ' checks.');
