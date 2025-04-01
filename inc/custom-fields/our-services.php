<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Список услуг')
  ->where('post_type', '=', 'service_list')
  ->add_fields([
    Field::make('image', 'img_service', 'Изображение'),
    Field::make('text', 'link', 'Ссылка на услугу'),
    Field::make('text', 'age', 'Возраст'),
    Field::make('text', 'services', 'Услуги'),
  ]);
