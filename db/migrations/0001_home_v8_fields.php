<?php
/**
 * Заполняет новые поля Carbon Fields главной (v8), если они ещё пустые.
 *
 * Аддитивно: существующие значения на проде не перезаписываются.
 * Значения совпадают с дефолтами шаблонов (template-parts/v8/*), поэтому
 * первый деплой не меняет внешний вид, но поля становятся редактируемыми в админке.
 */

$main_page_id = (int) get_option('page_for_posts');
if (! $main_page_id) {
	echo "0001: page_for_posts is empty, skip\n";
	return;
}

$text_fields = [
	'hero_eyebrow'       => 'Москва, м. Раменки · Очно и онлайн',
	'hero_seo_title'     => 'Центр детской нейропсихологии ОРМАС',
	'hero_display'       => 'Ребёнку трудно учиться, говорить или справляться с эмоциями?',
	'hero_description'   => 'Нейропсихологи, логопеды, дефектологи и детские психологи. Диагностика и индивидуальные занятия с учётом особенностей ребёнка.',
	'hero_primary_text'  => 'Подобрать специалиста',
	'hero_primary_link'  => '#consultation',
	'hero_secondary_text'=> 'Услуги и цены',
	'hero_secondary_link'=> '/service/',
	'hero_rating_value'  => '5,0',
	'hero_rating_label'  => 'Нам доверяют родители',
	'hero_rating_link'   => '#reviews',
	'form_title'         => 'Записаться на бесплатную консультацию',
	'form_text_1'        => 'Не знаете, какой специалист Вам нужен? Просто заполните данную форму и мы перезвоним.',
	'form_text_2'        => 'Расскажите нашему сотруднику, что Вас беспокоит. Он сориентирует в выборе специалиста и подробно ответит на все Ваши вопросы.',
	'form_button_text'   => 'Записаться',
];

$changed = 0;
foreach ($text_fields as $key => $value) {
	$current = carbon_get_post_meta($main_page_id, $key);
	if (is_string($current) && '' !== trim($current)) {
		continue;
	}
	carbon_set_post_meta($main_page_id, $key, $value);
	$changed++;
}

$advantages = [
	[
		'advantage_icon'  => 'professional',
		'advantage_title' => 'Профессионализм',
		'advantage_text'  => 'У нас работают только специалисты с высшим образованием. Мы контролируем, чтобы они регулярно проходили повышение квалификации, пользовались супервизиями.',
	],
	[
		'advantage_icon'  => 'like',
		'advantage_title' => 'У нас нет «потока»',
		'advantage_text'  => 'Мы контролируем нагрузку специалистов и учитываем их возможности, чтобы они могли полноценно погрузиться в случай каждой семьи.',
	],
	[
		'advantage_icon'  => 'wallet',
		'advantage_title' => 'На разный бюджет',
		'advantage_text'  => 'У нас есть разные варианты стоимости занятий в зависимости от опыта работы специалиста, с которым Вы захотите заниматься.',
	],
	[
		'advantage_icon'  => 'puzzle-piece',
		'advantage_title' => 'Комплексный подход',
		'advantage_text'  => 'При необходимости Вы сможете получить одновременно помощь нескольких специалистов в одном месте.',
	],
	[
		'advantage_icon'  => 'parents',
		'advantage_title' => 'Рады родителям',
		'advantage_text'  => 'Нам нечего скрывать и мы приветствуем присутствие родителей на занятиях. По нашему опыту в таком сотрудничестве результаты достигаются гораздо быстрее.',
	],
	[
		'advantage_icon'  => 'online',
		'advantage_title' => 'Можно онлайн',
		'advantage_text'  => 'Мы работаем онлайн, поэтому Вы можете получить помощь квалифицированных специалистов из любой точки мира!',
	],
];

$current_advantages = carbon_get_post_meta($main_page_id, 'advantages_items');
if (empty($current_advantages)) {
	carbon_set_post_meta($main_page_id, 'advantages_items', $advantages);
	$changed++;
}

echo "0001: home v8 fields filled: {$changed}\n";
