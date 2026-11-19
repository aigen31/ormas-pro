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

/**
 * Keep Yoast's WebSite search action compatible with Google's rich-results
 * validator. Some Yoast versions output query-input as a
 * PropertyValueSpecification, while Google expects the compact string form.
 */
add_filter('wpseo_schema_website', function ($data) {
  if (empty($data['potentialAction'])) {
    return $data;
  }

  $actions = $data['potentialAction'];
  $is_action_list = isset($actions[0]) && is_array($actions[0]);

  if (!$is_action_list) {
    $actions = [$actions];
  }

  foreach ($actions as $key => $action) {
    if (isset($action['@type']) && $action['@type'] === 'SearchAction') {
      $actions[$key]['query-input'] = 'required name=search_term_string';
    }
  }

  $data['potentialAction'] = $is_action_list ? $actions : reset($actions);

  return $data;
});
