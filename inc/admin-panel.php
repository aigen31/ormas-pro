<?php
// Disable content editor on the homepage
function ormas_remove_editor_from_homepage()
{
  $main_page_id = get_option('page_for_posts');
  if (isset($_GET['post']) && $_GET['post'] == $main_page_id) {
    remove_post_type_support('page', 'editor');
  }
}
add_action('admin_init', 'ormas_remove_editor_from_homepage');

// Disable comments on all post types
function ormas_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'ormas_disable_comments_post_types_support');

// Close comments on the front-end
function ormas_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'ormas_disable_comments_status', 20, 2);
add_filter('pings_open', 'ormas_disable_comments_status', 20, 2);

// Hide existing comments
function ormas_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'ormas_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function ormas_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'ormas_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function ormas_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'ormas_disable_comments_admin_menu_redirect');
