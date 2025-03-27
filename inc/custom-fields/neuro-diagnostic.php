<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Нейродиагностика')
  ->where('post_id', '=', get_service_page_by_slug('nejropsihologicheskaya-diagnostika')->ID)
  ->add_fields([
    Field::make('complex', 'items', 'Зачем проводить нейропсихологическую диагностику?')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'item_title', 'Заголовок')->set_width(30),
        Field::make('textarea', 'item_text', 'Текст')->set_width(40),
        Field::make('image', 'image', 'Изображение')->set_type('image')->set_width(30),
      ]),
    Field::make('complex', 'steps', 'Что из себя представляет диагностика?')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'step_title', 'Заголовок')->set_width(30),
        Field::make('textarea', 'step_description', 'Описание')->set_width(40),
        Field::make('image', 'step_image', 'Изображение')->set_type('image')->set_width(30),
      ]),
    Field::make('text', 'warning_title', 'Заголовок блока предупреждения')->set_width(30),
    Field::make('rich_text', 'warning_text', 'Текст блока предупреждения')->set_width(70),
    Field::make('text', 'button_text_1', 'Текст кнопки второй секции'),
  ]);
