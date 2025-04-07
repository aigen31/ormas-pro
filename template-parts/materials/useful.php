<?php
$materials = carbon_get_post_meta($post->ID, 'materials_list');

if (!empty($materials)) :
?>
	<div class="useful-materials inwork">
		<div class="container">
			<?php foreach ($materials as $material) :
				$image = get_image_data($material['material_image'], 'large');
			?>
				<div class="useful__wrapper">
					<?php if (!empty($material['material_price'])) : ?>
						<p class="useful__price useful__price--pay"><?php echo $material['material_price']; ?> руб</p>
					<?php else : ?>
						<p class="useful__price useful__price--free">Бесплатно</p>
					<?php endif; ?>
					<div class="useful__left">
						<?php if (!empty($material['material_image'])) : ?>
							<?php if (!empty($material['material_position_top']) || !empty($material['material_position_left'])) : ?>
								<img style="<?php echo !empty($material['material_position_top']) ? "bottom: {$material['material_position_top']}px;" : '' ?><?php echo !empty($material['material_position_left']) ? "left: {$material['material_position_left']}px;" : '' ?>"
									class="useful__image" src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>" width="465" height="448">
							<?php else : ?>
								<img class="useful__image" src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>" width="465" height="448">
							<?php endif; ?>
						<?php endif; ?>
					</div>

					<form method="POST" class="form-help-book useful__right" enctype="multipart/form-data">
						<input type="hidden" name="action" value="custom_form_submit">
						<?php wp_nonce_field('custom_form'); ?>
						<div class="useful__right-title"><?php echo esc_html($material['material_title']) ?></div>
						<?php if (!empty($material['material_description'])) : ?>
							<div class="useful__right-description"><?php echo wp_kses_post($material['material_description']) ?></div>
						<?php endif; ?>

						<?php if (!empty($material['material_link'])) : ?>
							<a target="_blank" href="<?php echo esc_url($material['material_link']) ?>" class="site-button useful__right-button">Подробнее</a>
						<?php else : ?>
							<input type="email" placeholder="Email" class="site-input useful__right-input" name="email">
							<input type="hidden" name="material_file" value="<?php echo esc_attr($material['material_file']) ?>">
							<input type="hidden" name="ismaterial" value="true">
							<input type="hidden" name="materials__title" value="<?php echo esc_attr($material['material_title']) ?>">
							<input type="hidden" name="materials__mail-title" value="<?php echo esc_attr($material['material_mail_title']) ?>">
							<input type="hidden" name="materials__text-mail" value="<?php echo esc_attr($material['material_mail_text']) ?>">
							<input type="hidden" name="material" value="<?php echo esc_attr($material['material_title']); ?>">
							<input type="hidden" name="title" value="<?php the_page_title(); ?>">
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
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>