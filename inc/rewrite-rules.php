<?php
add_filter('post_type_link', 'custom_service_pages_permalink', 10, 2);
function custom_service_pages_permalink($post_link, $post)
{
  if ($post->post_type === 'service_pages') {
    return home_url('/service/' . $post->post_name . '/');
  }
  return $post_link;
}

add_action('init', 'ormas_init_rewrite_rules');
function ormas_init_rewrite_rules()
{
  add_rewrite_rule('^service/([^/]+)/?$', 'index.php?service_pages=$matches[1]', 'top');
}
