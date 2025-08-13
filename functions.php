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
  define('_S_VERSION', '0.1.0');
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


/* Убираем раздел Услуги в хлебных крошках */
add_filter( 'wpseo_breadcrumb_links', function( $links ) {
    if ( is_singular( 'service_pages' ) ) {
        foreach ( $links as $key => $link ) {
            if ( isset( $link['url'] ) && str_ends_with($link['url'], '/service_pages/') ) {
                unset( $links[$key] );
            }
        }

        // Переиндексируем массив
        $links = array_values( $links );
    }
    return $links;
});