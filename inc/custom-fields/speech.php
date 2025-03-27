<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Речь')
  ->where('post_id', '=', get_service_page_by_slug('logoped-defektolog')->ID)
  ->add_fields([
    Field::make('complex', 's_contact_with_problem', 'С чем можно обратиться')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'title', 'Заголовок')->set_width(50),
        Field::make('text', 'subtitle', 'Подзаголовок')->set_width(50),
      ]),
    Field::make('complex', 's_how_work', 'Как проходит работа')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'title', 'Заголовок')->set_width(40),
        Field::make('text', 'text', 'Текст')->set_width(40),
        Field::make('image', 'image', 'Изображение')->set_type('image')->set_width(20),
      ]),
    Field::make('complex', 's_how_work_advantages_list', 'Преимущества')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'title', 'Заголовок')->set_width(40),
        Field::make('text', 'text', 'Текст')->set_width(40),
        Field::make('image', 'image', 'Изображение')->set_type('image')->set_width(20),
      ]),
  ]);
