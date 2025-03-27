<?php
register_nav_menus([
	'header-menu-custom' => 'Меню в шапке новостей',
	'header-menu' => 'Меню в шапке',
	'footer-menu' => 'Нижнее меню',
	'footer-menu-news' => 'Нижнее меню новостей',
]);
add_theme_support('title-tag');
add_theme_support('post-thumbnails', array('post', 'reviews', 'news', 'customnews'));
add_image_size('post-thumb', 354, 340, true);
add_image_size('post-author', 85, 85, true);
add_image_size('post-review', 313, 313, true);