<?php
/**
 * Первый экран главной (макет «ОРМАС · Главная v8»).
 *
 * Тексты и ссылки редактируются в Carbon Fields: Главная страница → Первый экран.
 * Изображения по умолчанию берутся из assets/img/v8 и могут быть переопределены.
 *
 * @package ormas.pro
 */

$main_page_id = get_option('page_for_posts');

$hero = [
	'eyebrow'     => carbon_get_post_meta($main_page_id, 'hero_eyebrow'),
	'seo_title'   => carbon_get_post_meta($main_page_id, 'hero_seo_title'),
	'display'     => carbon_get_post_meta($main_page_id, 'hero_display'),
	'description' => carbon_get_post_meta($main_page_id, 'hero_description'),
	'primary_text'    => carbon_get_post_meta($main_page_id, 'hero_primary_text'),
	'primary_link'    => carbon_get_post_meta($main_page_id, 'hero_primary_link'),
	'secondary_text'  => carbon_get_post_meta($main_page_id, 'hero_secondary_text'),
	'secondary_link'  => carbon_get_post_meta($main_page_id, 'hero_secondary_link'),
	'rating_value'    => carbon_get_post_meta($main_page_id, 'hero_rating_value'),
	'rating_label'    => carbon_get_post_meta($main_page_id, 'hero_rating_label'),
	'rating_link'     => carbon_get_post_meta($main_page_id, 'hero_rating_link'),
	'photo'           => carbon_get_post_meta($main_page_id, 'hero_photo'),
	'logo'            => carbon_get_post_meta($main_page_id, 'hero_logo'),
	'cube_patch'      => carbon_get_post_meta($main_page_id, 'hero_cube_patch'),
];

$theme_uri = get_template_directory_uri();

$photo_url = $hero['photo'] ? wp_get_attachment_image_url($hero['photo'], 'large') : $theme_uri . '/assets/img/v8/hero-family.png';
$logo_url  = $hero['logo'] ? wp_get_attachment_image_url($hero['logo'], 'medium') : $theme_uri . '/assets/img/v8/logo-ormas.png';
$patch_url = $hero['cube_patch'] ? wp_get_attachment_image_url($hero['cube_patch'], 'medium') : $theme_uri . '/assets/img/v8/cube-patch.svg';

$ttl = static function ($value, $fallback) {
	$value = is_string($value) ? trim($value) : '';
	return '' !== $value ? $value : $fallback;
};
?>
<div class="v8-hero">
	<svg class="v8-hero__wave" viewBox="0 0 1024 607" preserveAspectRatio="none" aria-hidden="true" focusable="false">
		<path d="M0,369 C358.4,409 614.4,254 1024,194 L1024,607 L0,607 Z" fill="#FFEADA"/>
	</svg>
	<div class="v8-hero__inner">
		<img class="v8-hero__checks" src="<?php echo esc_url($theme_uri . '/assets/img/v8/hero-checks.svg'); ?>" alt="" aria-hidden="true" width="185" height="190" loading="lazy">

		<div class="v8-hero__text">
			<div class="v8-hero__meta">
				<p class="v8-hero__eyebrow"><?php echo esc_html($ttl($hero['eyebrow'], 'Москва, м. Раменки · Очно и онлайн')); ?></p>
				<h1 class="v8-hero__seo-title"><?php echo esc_html($ttl($hero['seo_title'], 'Центр детской нейропсихологии ОРМАС')); ?></h1>
			</div>

			<?php
			$display_text = esc_html($ttl($hero['display'], 'Ребёнку трудно учиться, говорить или справляться с эмоциями?'));
			// Перенос перед «или» как в макете.
			$display_text = str_replace(' или ', '<br class="v8-hero__br"> или ', $display_text);
			?>
			<p class="v8-hero__display"><?php echo $display_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

			<p class="v8-hero__description"><?php echo esc_html($ttl($hero['description'], 'Нейропсихологи, логопеды, дефектологи и детские психологи. Диагностика и индивидуальные занятия с учётом особенностей ребёнка.')); ?></p>

			<div class="v8-hero__actions">
				<div class="v8-hero__buttons">
					<a class="v8-btn" href="<?php echo esc_url($ttl($hero['primary_link'], '#consultation')); ?>">
						<?php echo esc_html($ttl($hero['primary_text'], 'Подобрать специалиста')); ?>
					</a>
					<a class="v8-btn v8-btn--secondary" href="<?php echo esc_url($ttl($hero['secondary_link'], '/service/')); ?>">
						<?php echo esc_html($ttl($hero['secondary_text'], 'Услуги и цены')); ?>
					</a>
				</div>

				<div class="v8-rating">
					<span class="v8-rating__stars" aria-hidden="true"></span>
					<span class="v8-rating__value"><?php echo esc_html($ttl($hero['rating_value'], '5,0')); ?></span>
					<span class="v8-rating__divider" aria-hidden="true"></span>
					<a class="v8-rating__label" href="<?php echo esc_url($ttl($hero['rating_link'], '#reviews')); ?>">
						<?php echo esc_html($ttl($hero['rating_label'], 'Нам доверяют родители')); ?>
					</a>
				</div>
			</div>
		</div>

		<div class="v8-hero__photo">
			<img class="v8-hero__photo-img" src="<?php echo esc_url($photo_url); ?>" alt="Семья на приёме в центре ОРМАС" width="505" height="668">
			<img class="v8-hero__cube-patch" src="<?php echo esc_url($patch_url); ?>" alt="" aria-hidden="true" width="210" height="230">
			<img class="v8-hero__cube-logo" src="<?php echo esc_url($logo_url); ?>" alt="ОРМАС" width="180" height="64">
		</div>
	</div>
</div>
