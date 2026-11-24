<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Главная страница')
  ->where('post_type', '=', 'page')
  ->where('post_id', '=', get_option('page_for_posts'))
  ->add_fields([
    Field::make('separator', 'hero_separator', 'Первый экран'),
    Field::make('text', 'hero_eyebrow', 'Надзаголовок (город, формат)')->set_width(50),
    Field::make('text', 'hero_seo_title', 'H1 для SEO')->set_width(50),
    Field::make('textarea', 'hero_display', 'Крупный заголовок')->set_width(100),
    Field::make('textarea', 'hero_description', 'Описание под заголовком')->set_width(100),
    Field::make('text', 'hero_primary_text', 'Кнопка 1 — текст')->set_width(50),
    Field::make('text', 'hero_primary_link', 'Кнопка 1 — ссылка')->set_width(50),
    Field::make('text', 'hero_secondary_text', 'Кнопка 2 — текст')->set_width(50),
    Field::make('text', 'hero_secondary_link', 'Кнопка 2 — ссылка')->set_width(50),
    Field::make('text', 'hero_rating_value', 'Рейтинг — значение')->set_width(33),
    Field::make('text', 'hero_rating_label', 'Рейтинг — подпись')->set_width(33),
    Field::make('text', 'hero_rating_link', 'Рейтинг — ссылка')->set_width(33),
    Field::make('image', 'hero_photo', 'Фото первого экрана')->set_type('image')->set_width(33),
    Field::make('image', 'hero_logo', 'Логотип на кубе')->set_type('image')->set_width(33),
    Field::make('image', 'hero_cube_patch', 'Патч куба')->set_type('image')->set_width(33),

    Field::make('separator', 'advantages_separator', 'Преимущества'),
    Field::make('complex', 'advantages_items', 'Преимущества')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('select', 'advantage_icon', 'Иконка')
          ->add_options([
            'professional' => 'Профессионализм',
            'like' => 'У нас нет потока',
            'wallet' => 'На разный бюджет',
            'puzzle-piece' => 'Комплексный подход',
            'parents' => 'Рады родителям',
            'online' => 'Можно онлайн',
          ])
          ->set_width(30),
        Field::make('text', 'advantage_title', 'Заголовок')->set_width(30),
        Field::make('textarea', 'advantage_text', 'Текст')->set_width(40),
      ]),

    Field::make('separator', 'form_separator', 'Форма записи'),
    Field::make('text', 'form_title', 'Заголовок формы')->set_width(100),
    Field::make('textarea', 'form_text_1', 'Абзац 1')->set_width(100),
    Field::make('textarea', 'form_text_2', 'Абзац 2')->set_width(100),
    Field::make('text', 'form_button_text', 'Текст кнопки')->set_width(50),

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
    Field::make('complex', 'material_file_list', 'Список файлов')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('file', 'material_file', 'Файл материала')
      ]),
    Field::make('image', 'material_image', 'Изображение материала')->set_type('image'),
    Field::make('text', 'material_position_top', 'Позиция изображения сверху (в px)')->set_width(50),
    Field::make('text', 'material_position_left', 'Позиция изображения слева (в px)')->set_width(50),
    Field::make('text', 'material_mail_title', 'Заголовок письма'),
    Field::make('rich_text', 'material_mail_text', 'Текст письма'),
    Field::make('complex', 'reviews_list', 'Список отзывов')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'review_name', 'Имя')->set_width(50),
        Field::make('image', 'review_image', 'Фото отзыва')->set_type('image')->set_width(25),
        Field::make('image', 'review_avatar', 'Аватар')->set_type('image')->set_value_type('url')->set_width(25),
      ]),
    Field::make('separator', 'certificates_separator', 'Сертификаты'),
    Field::make('media_gallery', 'certificates_gallery', 'Список сертификатов'),
    Field::make('separator', 'faq_separator', 'Вопрос-ответ')
      ->set_width(100),
    Field::make('complex', 'service_faq', 'Добавить строку')
      ->set_layout('tabbed-horizontal')
      ->add_fields([
        Field::make('text', 'question', 'Вопрос')->set_width(30),
        Field::make('textarea', 'answer', 'Ответ')->set_width(70),
      ]),
  ]);