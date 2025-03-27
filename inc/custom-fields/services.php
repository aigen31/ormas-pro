<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Услуги')
  ->where('post_type', '=', 'service_pages')
  ->add_fields([
    Field::make('image', 'header_image', 'Изображение в заголовке')->set_type('image'),
    Field::make('separator', 'faq_separator', 'Вопрос-ответ')
      ->set_width(100),
    Field::make('complex', 'service_faq', 'Добавить строку')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'question', 'Вопрос')->set_width(30),
        Field::make('textarea', 'answer', 'Ответ')->set_width(70),
      ]),
    Field::make('separator', 'price_separator', 'Цены')
      ->set_width(100),
    Field::make('complex', 'price_ids', 'ID номера прайс-листов')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'price_id', 'ID прайс-листа'),
      ])->set_width(70),
    Field::make('html', 'prices_html', 'Специалисты')
      ->set_html('<p>Для редактирования цен услуг <a href="' . admin_url('edit.php?post_type=service#') . '">перейдите по ссылке</a></p>')
      ->set_width(30),
    Field::make('separator', 'specialists_separator', 'Слайдер направления специалистов')
      ->set_width(100),
    Field::make('text', 'specialists_direction_slug', 'Slug (ярлык) направления специалистов')->set_width(70),
    Field::make('html', 'specialists', 'Специалисты')
      ->set_html('<p>Для редактирования направлений <a href="' . admin_url('edit-tags.php?taxonomy=direction&post_type=specialists') . '">перейдите по ссылке</a></p>')
      ->set_width(30),
  ]);
