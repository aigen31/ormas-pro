<?php
add_filter('wpseo_breadcrumb_links', function ($links) {
  if (is_singular('service_pages')) {
    foreach ($links as $key => $link) {
      if (isset($link['url']) && str_ends_with($link['url'], '/service_pages/')) {
        unset($links[$key]);
      }
    }

    $links = array_values($links);
  }
  return $links;
});
