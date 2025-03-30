<div class="useful inwork" id="useful">
	<img class="wave-first" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave1.png">
	<?php
	$main_page_id = get_option('page_for_posts');
	$material = get_carbon_page_meta($main_page_id, [
		'material_image',
		'material_position_top',
		'material_position_left',
		'material_title',
		'material_description',
		'material_link',
		'material_file',
		'material_mail_title',
		'material_mail_text'
	]);
	extract($material);
	?>
	<div class="container">
		<div class="useful__left">
			<?php
			$image = get_image_data($material_image, 'large');

			if ($material_position_top || $material_position_left) :
				$style = '';
				if ($material_position_top) $style .= "bottom: {$material_position_top}px;";
				if ($material_position_left) $style .= "left: {$material_position_left}px;";
			?>
				<img style="<?php echo $style; ?>" class="useful__image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="465" height="448" loading="lazy">
			<?php else : ?>
				<img class="useful__image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_url($image['alt']); ?>" width="465" height="448" loading="lazy">
			<?php endif; ?>
		</div>
		<form action="" method="POST" class="useful__right useful-main-form">
			<div class="useful__right-title"><?php echo $material_title; ?></div>
			<div class="useful__right-description" data-type="<?php echo $count + 9; ?>">
				<?php echo $material_description; ?>
			</div>
			<?php if ($material_link) : ?>
				<a target="_blank" href="<?php echo $material_link; ?>" class="site-button useful__right-button">Подробнее</a>
			<?php else : ?>
				<?php
				if ($material_file) {
					$array = explode('/', $material_file);
					unset($array[0]);
					unset($array[1]);
					unset($array[2]);
					unset($array[3]);
					$path = implode('/', $array);
				}
				?>
				<input type="email" placeholder="Email" class="site-input useful__right-input useful__right-input--more" name="email">
				<input type="hidden" name="type" value="<?php echo $count + 9; ?>">
				<input type="hidden" name="material_file" value="<?php echo $path; ?>">
				<input type="hidden" name="ismaterial" value="true">
				<input type="hidden" name="materials__title" value="<?php echo $material_title; ?>">
				<input type="hidden" name="materials__mail-title" value="<?php echo $material_mail_title; ?>">
				<input type="hidden" name="materials__text-mail" value='<?php echo $material_mail_text; ?>'>
				<button class="site-button useful__right-button useful__right-button--more">Скачать</button>
				<a href="/materialy/" class="site-button useful__right-button useful__right-button--border">Смотреть все материалы</a>
			<?php endif; ?>
		</form>
	</div>
</div>