<?php
/**
 * Cache-busting version for a theme asset: file mtime, so every deploy that
 * touches the file produces a new URL and nginx/browser caches cannot serve
 * a stale stylesheet/script after a release (fixed _S_VERSION did exactly that).
 */
function ormas_pro_asset_version($relative_path)
{
    $file = get_template_directory() . $relative_path;
    return file_exists($file) ? filemtime($file) : _S_VERSION;
}

function ormas_pro_enqueue_assets()
{
    // Styles
    wp_enqueue_style('ormas-pro-style', get_template_directory_uri() . '/assets/css/main.css', array(), ormas_pro_asset_version('/assets/css/main.css'));

    // Карточки блога — только на шаблоне Blog.
    if (is_page_template('blog.php')) {
        wp_enqueue_style(
            'ormas-pro-blog-cards',
            get_template_directory_uri() . '/assets/css/blog-cards.css',
            array('ormas-pro-style'),
            ormas_pro_asset_version('/assets/css/blog-cards.css')
        );
    }

    // Шапка v8 (геометрия/иконки/лого) — общая для всех шаблонов, цвета не задаёт.
    wp_enqueue_style(
        'ormas-pro-header-v8',
        get_template_directory_uri() . '/assets/css/header-v8.css',
        array('ormas-pro-style'),
        file_exists($header_v8_path) ? filemtime($header_v8_path) : _S_VERSION
    );

    // Палитра и компоненты главной по макету v8 — только на главной странице.
    if (is_front_page() || is_home()) {
        wp_enqueue_style(
            'ormas-pro-home-v8',
            get_template_directory_uri() . '/assets/css/home-v8.css',
            array('ormas-pro-style'),
            ormas_pro_asset_version('/assets/css/home-v8.css')
        );
    }

    // Scripts
    wp_enqueue_script('ormas-pro-script', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), ormas_pro_asset_version('/assets/js/scripts.js'), true);
    wp_enqueue_script('ormas-pro-slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), ormas_pro_asset_version('/assets/js/slick.js'), true);
    wp_enqueue_script('ormas-pro-jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), ormas_pro_asset_version('/assets/js/jquery.magnific-popup.min.js'), true);
    wp_enqueue_script('ormas-pro-imask', get_template_directory_uri() . '/assets/js/imask.min.js', array(), ormas_pro_asset_version('/assets/js/imask.min.js'), true);
}
add_action('wp_enqueue_scripts', 'ormas_pro_enqueue_assets');
