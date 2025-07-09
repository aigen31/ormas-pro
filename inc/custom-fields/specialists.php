<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Специалисты')
  ->where('post_type', '=', 'team')
  ->add_fields([
    Field::make('image', 'specialist_photo', 'Фото')->set_type('image')->set_width(20),
    Field::make('text', 'specialist_position', 'Должность')->set_width(20),
    Field::make('text', 'specialist_education', 'Образование')->set_width(20),
    Field::make('text', 'specialist_specialization', 'Специализация')->set_width(20),
    Field::make('textarea', 'specialist_description', 'Описание')->set_width(100),
    Field::make('complex', 'specialist_additional_services', 'Услуги')
      ->add_fields([
        Field::make('text', 'specialist_additional_services_title', 'Название')->set_width(100)
      ])->set_width(100),
    Field::make('complex', 'specialist_additional_education', 'Дополнительное образование')
      ->add_fields([
        Field::make('text', 'specialist_additional_education_title', 'Название')->set_width(100)
      ])->set_width(100),
    Field::make('complex', 'specialist_experience', 'Опыт работы')
      ->add_fields([
        Field::make('text', 'specialist_experience_title', 'Название')->set_width(100)
      ])->set_width(100),
    Field::make('complex', 'specialist_reviews', 'Отзывы')
      ->add_fields([
        Field::make('text', 'specialist_reviews_rating', 'Оценка')
          ->set_attribute('type', 'number')
          ->set_attribute('min', '1')
          ->set_attribute('max', '5'),
        Field::make('text', 'specialist_reviews_title', 'Заголовок'),
        Field::make('rich_text', 'specialist_reviews_content', 'Текст отзыва')
      ])
      ->set_layout('tabbed-horizontal')
      ->set_width(100)
  ]);
