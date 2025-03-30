<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'БОС-терапия')
  ->where('post_id', '=', get_service_page_by_slug('bos-therapy')->ID)
  ->add_fields([
    Field::make('rich_text', 'bos_about_method', 'Параграф')->set_width(100),
    Field::make('complex', 'bos_advantages', 'Преимущества БОС-терапии')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'title', 'Заголовок')->set_width(30),
        Field::make('rich_text', 'text', 'Текст')->set_width(70),
      ]),
    Field::make('complex', 'bos_how_work', 'Как проходит занятие')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'title', 'Шаг')->set_width(20),
        Field::make('text', 'text', 'Описание')->set_width(60),
        Field::make('image', 'image', 'Изображение')->set_type('image')->set_width(20),
      ]),
    Field::make('complex', 'bos_problems', 'С чем можно обратиться')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'title', 'Заголовок')->set_width(30),
        Field::make('rich_text', 'text', 'Описание')->set_width(50),
        Field::make('image', 'image', 'Изображение')->set_type('image')->set_width(20),
      ]),
  ]);
