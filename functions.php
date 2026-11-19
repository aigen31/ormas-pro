<?php

/**
 * ormas.pro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ormas.pro
 */

if (! defined('_S_VERSION')) {
  // Replace the version number of the theme on each release.
  define('_S_VERSION', '0.1.3');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ormas_pro_setup()
{
  /**
   * Nav Menus
   */
  require get_template_directory() . '/inc/nav-menus.php';

  /**
   * Add Theme Support
   */
  require get_template_directory() . '/inc/add-theme-support.php';
}
add_action('after_setup_theme', 'ormas_pro_setup');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom post types
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Carbon Fields
 */
add_action('after_setup_theme', 'crb_load');
function crb_load()
{
  require_once('vendor/autoload.php');
  \Carbon_Fields\Carbon_Fields::boot();
}
require get_template_directory() . '/inc/custom-fields.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Filters
 */
require get_template_directory() . '/inc/filters.php';

/**
 * TGM Plugin Activation
 */
require_once('tgm-plugin-activation/class-tgm-plugin-activation.php');
require get_template_directory() . '/inc/tgm-plugin-activation.php';

/**
 * Admin panel settings
 */
require get_template_directory() . '/inc/admin-panel.php';

/**
 * Page rewrite rules
 */
require get_template_directory() . '/inc/rewrite-rules.php';

/**
 * Send mail
 */
require get_template_directory() . '/inc/mail.php';

/**
 * Settings check
 */
require get_template_directory() . '/inc/settings-check.php';

/**
 * WPSEO extension settings
 */
require get_template_directory() . '/inc/wpseo-extension.php';

function ormas_pro_enqueue_intl_tel_input()
{
	$theme_dir = get_template_directory();
	$theme_uri = get_template_directory_uri();
	$css_path = '/assets/css/intlTelInput.css';
	$js_path = '/assets/js/intlTelInputWithUtils.js';

	wp_enqueue_style(
		'intl-tel-input',
		$theme_uri . $css_path,
		[],
		file_exists($theme_dir . $css_path) ? filemtime($theme_dir . $css_path) : _S_VERSION
	);

	wp_enqueue_script(
		'intl-tel-input',
		$theme_uri . $js_path,
		[],
		file_exists($theme_dir . $js_path) ? filemtime($theme_dir . $js_path) : _S_VERSION,
		true
	);
}
add_action('wp_enqueue_scripts', 'ormas_pro_enqueue_intl_tel_input', 5);

function my_register_globals() {
    $GLOBALS['sitekeyYandex'] = 'ysc1_jNsNXrkPRCzgxt3g8IthECYJJzUrQxhStwlFRhps7749ac22';
}
add_action('init', 'my_register_globals');

function ormas_medical_organization_schema()
{
	$schema = [
		'@context' => 'https://schema.org',
		'@type' => 'MedicalOrganization',
		'@id' => 'https://ormas.pro/#organization',
		'name' => 'Центр детской нейропсихологии ORMAS',
		'url' => 'https://ormas.pro/',
		'description' => 'Решение вопросов, связанных с помощью детям с СДВГ и ЗПР. Оказание помощи при подготовке ребенка к школе.',
		'telephone' => '+79266699546',
		'email' => 'info@ormas.pro',
		'address' => [
			'@type' => 'PostalAddress',
			'streetAddress' => 'Мичуринский проспект д. 19, корпус 1',
			'addressLocality' => 'Москва',
			'postalCode' => '119192',
			'addressCountry' => 'RU',
		],
		'taxID' => '772665158877',
		'founder' => [
			'@type' => 'Person',
			'name' => 'Каверина Анастасия Романовна',
		],
	];

	$json = wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	$html = '<script type="application/ld+json">' . $json . '</script>';
	echo $html;
}
