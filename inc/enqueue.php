<?php
function ormas_pro_enqueue_assets()
{
    // Styles
    wp_enqueue_style('ormas-pro-style', get_template_directory_uri() . '/assets/css/main.css', array(), _S_VERSION);

    // Карточки блога — только на шаблоне Blog.
    if (is_page_template('blog.php')) {
        $blog_cards_path = get_template_directory() . '/assets/css/blog-cards.css';
        wp_enqueue_style(
            'ormas-pro-blog-cards',
            get_template_directory_uri() . '/assets/css/blog-cards.css',
            array('ormas-pro-style'),
            file_exists($blog_cards_path) ? filemtime($blog_cards_path) : _S_VERSION
        );
    }

    // Шапка v8 (геометрия/иконки/лого) — общая для всех шаблонов, цвета не задаёт.
    $header_v8_path = get_template_directory() . '/assets/css/header-v8.css';
    wp_enqueue_style(
        'ormas-pro-header-v8',
        get_template_directory_uri() . '/assets/css/header-v8.css',
        array('ormas-pro-style'),
        file_exists($header_v8_path) ? filemtime($header_v8_path) : _S_VERSION
    );

    // Палитра и компоненты главной по макету v8 — только на главной странице.
    if (is_front_page() || is_home()) {
        $home_v8_path = get_template_directory() . '/assets/css/home-v8.css';
        wp_enqueue_style(
            'ormas-pro-home-v8',
            get_template_directory_uri() . '/assets/css/home-v8.css',
            array('ormas-pro-style'),
            file_exists($home_v8_path) ? filemtime($home_v8_path) : _S_VERSION
        );
    }

    // Scripts
    wp_enqueue_script('ormas-pro-script', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('ormas-pro-slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('ormas-pro-jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', true);
    wp_enqueue_script('ormas-pro-imask', get_template_directory_uri() . '/assets/js/imask.min.js', array(), '6.4.3', true);
}
add_action('wp_enqueue_scripts', 'ormas_pro_enqueue_assets');
