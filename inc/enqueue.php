<?php
function ormas_pro_enqueue_assets() {
    // Styles
    wp_enqueue_style('ormas-pro-style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');
    // wp_enqueue_style('ormas-pro-style', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.0.0');
    
    // Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('ormas-pro-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'ormas_pro_enqueue_assets');