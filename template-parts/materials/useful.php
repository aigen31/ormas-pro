<?php
$material = get_carbon_page_meta($post->ID, [
	'material_title',
	'material_description',
	'material_link',
	'material_file',
	'material_image',
	'material_position_top',
	'material_position_left',
	'material_mail_title',
	'material_mail_text',
]);
extract($material);

$image = get_image_data($material_image, 'large');

if (!empty($material)) :
?>
	<div class="useful-materials inwork">
		<div class="container">
			<div class="useful__wrapper">
				<div class="useful__left">
					<?php if (!empty($material_image)) : ?>
						<?php if (!empty($material_position_top) || !empty($material_position_left)) : ?>
							<img style="<?php !empty($material_position_top) ? "bottom: {$material_position_top}px;" : '' ?><?php !empty($material_position_left) ? "left: {$material_position_left}px;" : '' ?>"
								class="useful__image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="465" height="448">
						<?php else : ?>
							<img class="useful__image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="465" height="448">
						<?php endif; ?>
					<?php endif; ?>
				</div>

				<form action="<?php get_template_directory_uri(); ?>/SendMailSmtpClass.php" method="POST" class="form-help-book useful__right" enctype="multipart/form-data">
					<div class="useful__right-title"><?php esc_html($material_title) ?></div>
					<?php if (!empty($material_description)) : ?>
						<div class="useful__right-description"><?php wp_kses_post($material_description) ?></div>
					<?php endif; ?>

					<?php if (!empty($material_link)) : ?>
						<a target="_blank" href="<?php esc_url($material_link) ?>" class="site-button useful__right-button">Подробнее</a>
					<?php else : ?>
						<input type="email" placeholder="Email" class="site-input useful__right-input" name="email">
						<input type="hidden" name="material_file" value="<?php esc_attr($material_file) ?>">
						<input type="hidden" name="ismaterial" value="true">
						<input type="hidden" name="materials__title" value="<?php esc_attr($material_title) ?>">
						<input type="hidden" name="materials__mail-title" value="<?php esc_attr($material_mail_title) ?>">
						<input type="hidden" name="materials__text-mail" value="<?php esc_attr($material_mail_text) ?>">
						<button class="site-button useful__right-button">Скачать</button>
						<div class="site-checkbox footer__top-line-column-inputs-checkbox">
							<label>
								<input class="useful__checkbox" type="checkbox">
								<div class="site-checkbox__checkbox">
									<svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1.41 3L4 5.58L9.59 0L11 1.41L4 8.41L0 4.41L1.41 3Z" fill="#fff"></path>
									</svg>
								</div>
								<div class="site__checkbox-text">
									Согласие с условиями обработки <a target="_blank" href="/agreement/">персональных данных</a>
								</div>
							</label>
						</div>
					<?php endif; ?>
				</form>
			</div>
		</div>
	</div>
<?php endif; ?>