<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Нейропсихология')
  ->where('post_id', '=', get_post_by_slug('neuropsychology')->ID)
  ->add_fields([
    Field::make('complex', 'how_work_items', 'Как проходит работа')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'title', 'Заголовок')->set_width(50),
        Field::make('rich_text', 'content', 'Содержание')->set_width(50)
      ]),
    Field::make('complex', 'can_ask_for_items', 'С чем можно обратиться')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'title', 'Заголовок')->set_width(30),
        Field::make('rich_text', 'content', 'Содержание')->set_width(50),
        Field::make('image', 'image', 'Изображение')->set_type('image')->set_width(20),
      ]),
  ]);
