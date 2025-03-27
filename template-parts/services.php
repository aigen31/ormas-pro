<div class="services inwork" id="services">
	<img class="wave-first" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave1.png">
	<div class="container">
		<div class="services__poopup poopup hidden">
			<svg style="cursor: pointer;" class="services__poopup-svg" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path clip-rule="evenodd" d="M7.29289 8.6957L10.6194 12L7.29289 15.3043C6.90237 15.6922 6.90237 16.3212 7.29289 16.7091C7.68342 17.097 8.31658 17.097 8.70711 16.7091L12 13.4382L15.2929 16.7091C15.6834 17.097 16.3166 17.097 16.7071 16.7091C17.0976 16.3212 17.0976 15.6922 16.7071 15.3043L13.3806 12L16.7071 8.6957C17.0976 8.30778 17.0976 7.67885 16.7071 7.29094C16.3166 6.90302 15.6834 6.90302 15.2929 7.29094L12 10.5618L8.70711 7.29094C8.31658 6.90302 7.68342 6.90302 7.29289 7.29094C6.90237 7.67885 6.90237 8.30778 7.29289 8.6957Z" />
			</svg>
			<div class="poopup__title">Записаться</div>
			<div class="poopup__description">Оставьте ваши контактные данные, и наш администратор вскоре с Вами свяжется!
			</div>
			<form method="POST" class="site-inputs services__inputs poopup__inputs">
				<input type="text" placeholder="Ваше имя" class="site-input poopup__inputs-input" name="firstname">
				<input type="text" placeholder="Ваша фамилия" class="site-input poopup__inputs-input" name="lastname">
				<input type="email" placeholder="Email" class="site-input poopup__inputs-input" name="email">
				<input type="text" placeholder="Ваш номер телефона" class="site-input poopup__inputs-input" id="phone-mask3" name="phone">
				<input type="hidden" class="services-type" value="2" name="type">
				<input type="hidden" class="services-type-email_title" value="" name="email_title">
				<div class="site-checkbox poopup__inputs-checkbox">
					<label>
						<input type="checkbox">
						<div class="site-checkbox__checkbox">
							<svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1.41 3L4 5.58L9.59 0L11 1.41L4 8.41L0 4.41L1.41 3Z" fill="#fff" />
							</svg>
						</div>
						<div class="site__checkbox-text">
							Согласие с условиями обработки <a href="/agreement/">персональных данных</a>
						</div>
					</label>
				</div>
				<button class="site-button poopup_inputs-button">Записаться</button>
			</form>
		</div>
		<h2 class="site-title services__title">Наши услуги</h2>
		<div class="services__list">
			<?php
			$main_page_id = carbon_get_theme_option('main_page_id');
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