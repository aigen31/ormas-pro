<?php
add_action( 'init', 'register_post_types' );

function register_post_types() {
  register_post_type('service', [
    'label'  => null,
    'labels' => [
      'name'               => 'Цены',
      'singular_name'      => 'Цена услуги',
      'add_new'            => 'Добавить цену',
      'add_new_item'       => 'Добавление цен',
      'edit_item'          => 'Редактирование цен',
      'new_item'           => 'Новые цены услуги',
      'view_item'          => 'Смотреть услуги',
      'search_items'       => 'Искать услуги',
      'not_found'          => 'Не найдено',
      'not_found_in_trash' => 'Не найдено в корзине',
      'parent_item_colon'  => '',
      'menu_name'          => 'Цены услуг',
    ],
    'description'            => '',
    'public'                 => true,
    'show_in_rest'        => false,
    'menu_position'       => 10,
    'menu_icon'           => 'dashicons-money-alt',
    'supports'            => ['title'],
    'taxonomies'          => [],
    'has_archive'         => true,
    'rewrite'             => true,
    'query_var'           => true,
  ]);

  register_post_type('service_pages', [
    'label'  => null,
    'labels' => [
      'name'               => 'Услуги',
      'singular_name'      => 'Услуга',
      'add_new'            => 'Добавить услугу',
      'add_new_item'       => 'Добавление услуги',
      'edit_item'          => 'Редактирование услуги',
      'new_item'           => 'Новая услуга',
      'view_item'          => 'Смотреть услугу',
      'search_items'       => 'Искать услугу',
      'not_found'          => 'Не найдено',
      'not_found_in_trash' => 'Не найдено в корзине',
      'parent_item_colon'  => '',
      'menu_name'          => 'Услуги',
    ],
    'description'            => '',
    'public'                 => true,
    'show_in_rest'        => false,
    'menu_position'       => 10,
    'menu_icon'           => 'dashicons-money-alt',
    'supports'            => ['title', 'editor'],
    'taxonomies'          => [],
    'has_archive'         => true,
    'rewrite'             => true,
    'query_var'           => true,
  ]);

  register_post_type('specialists', [
    'label'  => null,
    'labels' => [
      'name'               => 'Специалисты',
      'singular_name'      => 'Специалист',
      'add_new'            => 'Добавить специалиста',
      'add_new_item'       => 'Добавление специалиста',
      'edit_item'          => 'Редактирование специалиста',
      'new_item'           => 'Новый специалист',
      'view_item'          => 'Смотреть специалиста',
      'search_items'       => 'Искать специалиста',
      'not_found'          => 'Не найдено',
      'not_found_in_trash' => 'Не найдено в корзине',
      'parent_item_colon'  => '',
      'menu_name'          => 'Специалисты',
    ],
    'description'            => '',
    'public'                 => true,
    'show_in_rest'        => false,
    'menu_position'       => 11,
    'menu_icon'           => 'dashicons-groups',
    'supports'            => ['title'],
    'taxonomies'          => ['direction'], // Add taxonomy "направление"
    'has_archive'         => true,
    'rewrite'             => true,
    'query_var'           => true,
  ]);

  register_taxonomy('direction', ['specialists'], [
    'label' => 'Направления',
    'labels' => [
      'name'              => 'Направления',
      'singular_name'     => 'Направление',
      'search_items'      => 'Искать направления',
      'all_items'         => 'Все направления',
      'edit_item'         => 'Редактировать направление',
      'update_item'       => 'Обновить направление',
      'add_new_item'      => 'Добавить новое направление',
      'new_item_name'     => 'Новое название направления',
      'menu_name'         => 'Направления',
    ],
    'description'        => 'Таксономия для направления специалистов',
    'public'             => true,
    'hierarchical'       => true,
    'show_in_rest'       => true,
  ]);
}
