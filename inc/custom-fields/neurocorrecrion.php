<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Нейрокоррекция')
  ->where('post_id', '=', get_post_by_slug('nejrokorrekcziya')->ID)
  ->add_fields([
    Field::make('complex', 'cards', 'Карточки')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'card_title', 'Заголовок')->set_width(50),
        Field::make('textarea', 'card_text', 'Текст')->set_width(50),
      ]),
    Field::make('complex', 'work_stages', 'Этапы работы')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'stage_title', 'Заголовок')->set_width(30),
        Field::make('textarea', 'stage_description', 'Описание')->set_width(40),
        Field::make('image', 'stage_image', 'Изображение')
          ->set_type('image')
          ->set_width(30),
      ]),
  ]);
