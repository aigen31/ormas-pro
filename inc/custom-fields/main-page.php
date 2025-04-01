<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Главная страница')
  ->where('post_type', '=', 'page')
  ->where('post_id', '=', get_option('page_for_posts'))
  ->add_fields([
    Field::make('separator', 'service_list_separator', 'Список услуг'),
    Field::make('html', 'service_list', 'Список услуг')
      ->set_html('<p>Для редактирования списка услуг <a href="' . admin_url('edit.php?post_type=service_list') . '">перейдите по ссылке</a></p>'),
    Field::make('separator', 'specialists_separator', 'Специалисты'),
    Field::make('html', 'specialists', 'Специалисты')
      ->set_html('<p>Для редактирования списка специалистов <a href="' . admin_url('edit.php?post_type=specialists') . '">перейдите по ссылке</a></p>'),
    Field::make('separator', 'material_separator', 'Полезные материалы'),
    Field::make('text', 'material_title', 'Заголовок материала'),
    Field::make('textarea', 'material_description', 'Описание'),
    Field::make('text', 'material_link', 'Ссылка')->set_width(50),
    Field::make('file', 'material_file', 'Файл материала')->set_width(50),
    Field::make('image', 'material_image', 'Изображение материала')->set_type('image'),
    Field::make('text', 'material_position_top', 'Позиция изображения сверху (в px)')->set_width(50),
    Field::make('text', 'material_position_left', 'Позиция изображения слева (в px)')->set_width(50),
    Field::make('text', 'material_mail_title', 'Заголовок письма'),
    Field::make('textarea', 'material_mail_text', 'Текст письма'),
    Field::make('complex', 'reviews_list', 'Список отзывов')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'review_name', 'Имя')->set_width(50),
        Field::make('image', 'review_image', 'Фото отзыва')->set_type('image')->set_width(25),
        Field::make('image', 'review_avatar', 'Аватар')->set_type('image')->set_value_type('url')->set_width(25),
      ]),
    Field::make('separator', 'certificates_separator', 'Сертификаты'),
    Field::make('media_gallery', 'certificates_gallery', 'Список сертификатов')
  ]);
