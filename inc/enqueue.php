<?php
function ormas_pro_enqueue_assets()
{
    // Styles
    wp_enqueue_style('ormas-pro-style', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');
    // wp_enqueue_style('ormas-pro-slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.0.0');

    // Scripts
    wp_enqueue_script('ormas-pro-script', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('ormas-pro-slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('ormas-pro-jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', true);
    wp_enqueue_script('ormas-pro-imask', get_template_directory_uri() . '/assets/js/imask.min.js', array(), '6.4.3', true);
}
add_action('wp_enqueue_scripts', 'ormas_pro_enqueue_assets');
