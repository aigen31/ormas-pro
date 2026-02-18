<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Запуск речи')
  ->where('post_id', '=', get_service_page_by_slug('launch-speech')->ID)
  ->add_fields([
    Field::make('text', 'ls_section_title', 'Заголовок секции этапов')
      ->set_default_value('Этапы развития речи у ребёнка'),
    Field::make('complex', 'ls_speech_stages', 'Этапы развития речи')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('textarea', 'title', 'Заголовок (жирный текст)')->set_width(50),
        Field::make('textarea', 'text', 'Описание')->set_width(50),
      ]),
    Field::make('text', 'warning_title', 'Заголовок предупреждения'),
    Field::make('textarea', 'warning_text', 'Текст предупреждения'),
  ]);

Container::make('post_meta', 'Как проходит работа')
  ->where('post_id', '=', get_service_page_by_slug('launch-speech')->ID)
  ->add_fields([
    Field::make('text', 'ls_how_work_title', 'Заголовок секции')
      ->set_default_value('Как проходит работа'),
    Field::make('complex', 'ls_how_work_intro', 'Блоки (Первичный приём, Занятия)')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'title', 'Заголовок')->set_width(30),
        Field::make('textarea', 'text', 'Описание')->set_width(50),
        Field::make('image', 'image', 'Изображение (с маской)')->set_type('image')->set_width(20),
      ]),
    Field::make('complex', 'ls_how_work_principles', 'Принципы работы (6 карточек)')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'title', 'Заголовок')->set_width(30),
        Field::make('textarea', 'text', 'Описание')->set_width(50),
        Field::make('image', 'icon', 'Иконка')->set_type('image')->set_width(20),
      ]),
  ]);
