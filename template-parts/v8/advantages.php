<?php
/**
 * Преимущества главной (макет «ОРМАС · Главная v8»).
 *
 * Список редактируется в Carbon Fields: Главная страница → Преимущества.
 * Если список пуст, выводится набор по умолчанию.
 *
 * @package ormas.pro
 */

$main_page_id = get_option('page_for_posts');
$theme_uri    = get_template_directory_uri();

$default_items = [
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

$items = carbon_get_post_meta($main_page_id, 'advantages_items');
$items = is_array($items) ? $items : [];

if (empty($items)) {
	$items = $default_items;
}
?>
<div class="greeting v8-advantages">
	<div class="container">
		<div class="v8-advantages__grid">
			<?php foreach ($items as $item) : ?>
				<?php
				$icon  = ! empty($item['advantage_icon']) ? $item['advantage_icon'] : 'professional';
				$title = ! empty($item['advantage_title']) ? $item['advantage_title'] : '';
				$text  = ! empty($item['advantage_text']) ? $item['advantage_text'] : '';
				$icon_url = $theme_uri . '/assets/img/minified-svg/' . $icon . '.svg';
				?>
				<div class="v8-advantages__item">
					<img class="v8-advantages__icon" src="<?php echo esc_url($icon_url); ?>" alt="" aria-hidden="true" width="64" height="64" loading="lazy">
					<p class="v8-advantages__title"><?php echo esc_html($title); ?></p>
					<p class="v8-advantages__text"><?php echo esc_html($text); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
