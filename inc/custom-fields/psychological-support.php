<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Психологическая поддержка')
  ->where('post_id', '=', get_post_by_slug('psychological-support')->ID)
  ->add_fields([
    Field::make('complex', 'psychological_support_children', 'С ребенком')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'text', 'Текст')->set_width(100),
      ]),
    Field::make('complex', 'psychological_support_teenagers', 'Подростку')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'text', 'Текст')->set_width(100),
      ]),
    Field::make('complex', 'psychological_support_parents', 'Родителям')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'text', 'Текст')->set_width(100),
      ]),
    Field::make('complex', 'psychological_support_how_work', 'Как проходит консультация')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'title', 'Заголовок')->set_width(40),
        Field::make('rich_text', 'content', 'Содержание')->set_width(40),
        Field::make('image', 'image', 'Изображение')->set_type('image')->set_width(20),
      ]),
    Field::make('text', 'warning_title', 'Заголовок блока предупреждения')->set_width(30),
    Field::make('rich_text', 'warning_text', 'Текст блока предупреждения')->set_width(70),
  ]);
