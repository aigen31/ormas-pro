<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Container::make('theme_options', 'Настройка темы')
//   ->set_icon('dashicons-admin-generic')
//   ->add_fields([
//     Field::make('text', 'main_page_id', 'ID главной страницы')->set_width(100),
//   ]);

Container::make('post_meta', 'Цены услуг')
  ->where('post_type', '=', 'service')
  ->add_fields([
    Field::make('complex', 'service_prices', 'Добавить строку')
      ->set_layout('grid')
      ->add_fields([
        Field::make('text', 'service_title', 'Название')->set_width(20),
        Field::make('text', 'service_subtitle', 'Подзаголовок')->set_width(20),
        Field::make('text', 'service_duration', 'Длительность')->set_width(20),
        Field::make('text', 'service_face_to_face', 'Цена очно')->set_width(20),
        Field::make('text', 'service_online', 'Цена онлайн')->set_width(20),
      ]),
  ]);
