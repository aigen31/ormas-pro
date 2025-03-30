<div class="services inwork" id="services">
	<img class="wave-first" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave1.png">
	<div class="container">
		<h2 class="site-title services__title">Наши услуги</h2>
		<div class="services__list">
			<?php
			$main_page_id = get_option('page_for_posts');
			$services = carbon_get_post_meta($main_page_id, 'home_services');
			foreach ($services as $service) :
				$image_id = $service['service_image']; // Assuming this is the image ID
				$image = get_image_data($image_id, 'medium');
			?>
				<div class="services__list-item">
					<div class="services__list-item-wrapper">
						<div class="services__list-header">
							<div class="services__list-img-wrapper">
								<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="services__list-item-img" loading="lazy">
							</div>
							<div class="services__list-title">
								<p class="services__list-title-name"><?php echo $service['service_title']; ?></p>
								<div class="services__list-title-year">
									<img src="<?php bloginfo('template_directory') ?>/assets/img/minified-svg/laughing.svg" alt="smile" class="services__list-title-smile" width="24" height="24">
									<p class="services__list-title-smile-text">
										Возраст: <?php echo $service['service_age']; ?>.
									</p>
								</div>
							</div>
						</div>
						<div class="services__list-content">
							<p><?php echo $service['service_description']; ?></p>
							<div class="services__list-content-info">
								<img src="<?php bloginfo('template_directory') ?>/assets/img/minified-svg/grid-row-2 copy.svg" alt="img" class="services__list-content-info-img" width="24" height="24">
								<p class="services__list-content-info-text">
									Услуги: <?php echo $service['service_services']; ?>.
								</p>
							</div>
						</div>
						<div class="services__list-btn">
							<div class="site-button services__list-item-right-button" data-type="2" data-email="<?php // the_field('email_title'); 
																																																	?>">Записаться</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if (is_front_page() || is_home()): ?>
			<div class="home-price">
				<h2 class="site-title services__title">Наши цены</h2>
				<section class="servise-page-table">
					<div class="servise-page-table__wrapper">
						<div class="servise-page-table__header">
							<div class="servise-page-table__header-item servise-page-table__header-item_number">
								<p class="servise-page-table__header-item-text">№</p>
							</div>
							<div class="servise-page-table__header-item servise-page-table__header-item_name">
								<p class="servise-page-table__header-item-text">Название услуги</p>
							</div>
							<div class="servise-page-table__header-item servise-page-table__header-item_time">
								<p class="servise-page-table__header-item-text">Длит-ть</p>
							</div>
							<div class="servise-page-table__header-item servise-page-table__header-item_price">
								<p class="servise-page-table__header-item-text">Цена ₽ очно</p>
							</div>
							<div class="servise-page-table__header-item servise-page-table__header-item_price-online">
								<p class="servise-page-table__header-item-text">Цена ₽ онлайн</p>
							</div>
						</div>
						<div class="servise-page-table__content">
							<?php
							$count = 0;
							$count++;
							$services = carbon_get_post_meta(246, 'service_prices');
							foreach ($services as $service) : ?>
								<div class="servise-page-table__content-item">
									<div class="servise-page-table__content-table">
										<div class="servise-page-table__content-table-item servise-page-table__content-table-item_number">
											<p class="servise-page-table__content-table-item-text">
												<?php echo $count; ?>
											</p>
										</div>
										<div class="servise-page-table__content-table-item servise-page-table__content-table-item_name">
											<p class="servise-page-table__content-table-item-text">
												<span class="servise-page-table__content-table-item-span">
													<?php echo $service['service_title']; ?>
												</span>
												<?php echo $service['service_subtitle']; ?>
											</p>
										</div>
										<div class="servise-page-table__content-table-item-container">
											<div class="servise-page-table__content-table-item servise-page-table__content-table-item_time">
												<p class="servise-page-table__content-table-item-text">
													<?php echo $service['service_duration']; ?>
												</p>
												<p class="servise-page-table__content-table-item-text-hide">
													Длит-ть
												</p>
											</div>
											<div class="servise-page-table__content-table-item servise-page-table__content-table-item_price">
												<p class="servise-page-table__content-table-item-text">
													<?php echo $service['service_face_to_face']; ?>
												</p>
												<p class="servise-page-table__content-table-item-text-hide">
													Цена ₽ очно
												</p>
											</div>
											<div class="servise-page-table__content-table-item servise-page-table__content-table-item_price-online">
												<p class="servise-page-table__content-table-item-text">
													<?php echo $service['service_online']; ?>
												</p>
												<p class="servise-page-table__content-table-item-text-hide">
													Цена ₽ онлайн
												</p>
											</div>
										</div>
									</div>
								</div>
								<? if ($count == 5): ?>
									<div class="price__btn-more">
										<div class="party__list-item-text-more" onclick="this.parentNode.remove(); return false;">Развернуть</div>
									</div>
								<? endif; ?>
								<?php $count++; ?>
							<?php
							endforeach;
							?>
						</div>
					</div>
				</section>
			</div>
		<?php else: ?>
			<?php if (get_field('all_services', 'options')['subtype']) : ?>
				<div class="services__all-service-btn">
					<a href="/service/" class="services__all-service-btn-link">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g id="24 / arrows / arrow-top-right">
								<path id="icon" fill-rule="evenodd" clip-rule="evenodd" d="M19.0001 6.41421L5.70718 19.7071L4.29297 18.2929L17.5859 5H10.0001V3H21.0001V14H19.0001V6.41421Z" fill="white" />
							</g>
						</svg>
						все услуги и цены
					</a>
				</div>
			<?php endif; ?>

		<?php endif; ?>
	</div>
</div>