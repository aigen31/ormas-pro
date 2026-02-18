<?php

add_action('carbon_fields_register_fields', 'ormas_register_fields');
function ormas_register_fields()
{
  /**
   * Retrieves all Carbon Fields meta fields for the specified page
   * @param int $page_id Page ID
   * @param array $fields Array of required field keys
   * @return array Array of meta field values
   */
  function get_carbon_page_meta($page_id, $fields)
  {
    $result = [];
    foreach ($fields as $field) {
      $result[$field] = carbon_get_post_meta($page_id, $field);
    }
    return $result;
  }

  /**
   * Get array with image URL and ALT attribute
   * @param int $image_id Image ID
   * @param string $size Image size
   * @return array Array with image URL and ALT attribute
   */
  function get_image_data($image_id, $size)
  {
    if (!$image_id) return null;
    $image_url = wp_get_attachment_image_url($image_id, $size);
    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
    return [
      'url' => $image_url,
      'alt' => $image_alt
    ];
  }

  require_parts([
    'company-info',
    'theme-settings',
    'specialists',
    'main-page',
    'neuropsychology',
    'speech',
    'psychological-support',
    'bos-therapy',
    'neurocorrecrion',
    'neuro-diagnostic',
    'services',
    'materials',
    'our-services',
    'launch-speech'
  ], 'inc/custom-fields');
}
