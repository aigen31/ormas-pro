<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ormas.pro
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ormas_pro_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (! is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (! is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter('body_class', 'ormas_pro_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ormas_pro_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'ormas_pro_pingback_header');

/**
 * Get post by slug
 */
function get_post_by_slug($slug)
{
	$posts = get_posts([
		'name'        => $slug,
		// 'post_type'   => 'service_pages',
		'post_status' => 'publish',
		'numberposts' => 1
	]);

	return $posts ? $posts[0] : null;
}

/**
 * Check if the current post is a 'service_page' with the given slug
 *
 * @param string $target The slug or id to check against.
 * @return bool True if the current post matches, false otherwise.
 */
function is_service_page($target)
{
	if (is_singular('service_pages')) {
		global $post;
		return $post->post_name === $target || $post->ID === $target;
	}

	return false;
}
