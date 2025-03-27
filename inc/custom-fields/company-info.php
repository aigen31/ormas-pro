<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('theme_options', 'Информация о компании')
  ->set_icon('dashicons-info')
  ->add_fields([
    Field::make('text', 'options_email', 'Почта')->set_width(50),
    Field::make('text', 'options_number', 'Номер телефона')->set_width(50),
    Field::make('text', 'options_whatsapp', 'WhatsApp')->set_width(20),
    Field::make('text', 'options_vk', 'VK')->set_width(20),
    Field::make('text', 'options_youtube', 'YouTube')->set_width(20),
    Field::make('text', 'twitter_link', 'Twitter')->set_width(20),
    Field::make('text', 'options_telegram', 'Telegram')->set_width(20),
    Field::make('text', 'options_work_hours', 'Часы работы центра')->set_width(100),
    Field::make('text', 'options_address', 'Адрес')->set_width(100),
    Field::make('textarea', 'options_map_description', 'Описание проезда')->set_width(100),
    Field::make('text', 'options_map_script', 'Скрипт карты')->set_width(100),
    Field::make('text', 'options_dzen', 'Дзен')->set_width(20),
  ])
  ->add_tab('ИП', [
    Field::make('text', 'ip_info', 'ИП')->set_width(50),
    Field::make('text', 'inn_info', 'ИНН')->set_width(50),
    Field::make('text', 'ogrnip_info', 'ОГРНИП')->set_width(100),
  ])
  ->add_tab('Ссылки на документы', [
    Field::make('text', 'agreement_user', 'Пользовательское соглашение')->set_width(50),
    Field::make('text', 'offer_agreement', 'Договор публичной оферты')->set_width(50),
    Field::make('text', 'center_rules', 'Правила Центра')->set_width(50),
    Field::make('text', 'all_services', 'Прайс-лист')->set_width(50),
  ])
  ->add_tab('Банковские реквизиты', [
    Field::make('text', 'options_bank_account', 'Расчетный счет')->set_width(50),
    Field::make('text', 'options_bank_name', 'Название банка')->set_width(50),
    Field::make('text', 'options_correspondent_account', 'Корреспондентский счет')->set_width(50),
    Field::make('text', 'options_bik', 'БИК')->set_width(50),
  ]);
