<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Материалы')
  ->where('post_id', '=', get_page_by_path('materialy')->ID)
  ->add_fields([
    Field::make('complex', 'materials_list', 'Список материалов')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'material_title', 'Заголовок материала'),
        Field::make('textarea', 'material_description', 'Описание'),
        Field::make('text', 'material_price', 'Цена')
          ->set_width(50),
        Field::make('text', 'material_link', 'Ссылка')
          ->set_width(50),
        Field::make('file', 'material_file', 'Файл материала')
          ->set_width(50),
        Field::make('image', 'material_image', 'Изображение материала')
          ->set_type('image'),
        Field::make('text', 'material_position_top', 'Позиция изображения сверху (в px)')
          ->set_width(50),
        Field::make('text', 'material_position_left', 'Позиция изображения слева (в px)')
          ->set_width(50),
        Field::make('text', 'material_mail_title', 'Заголовок письма'),
        Field::make('textarea', 'material_mail_text', 'Текст письма'),
      ])
  ]);
