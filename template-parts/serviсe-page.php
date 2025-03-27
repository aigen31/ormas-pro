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
			foreach ($posts as $post) :
			?>

				<div class="servise-page-table__content-item">
					<div class="servise-page-table__content-title">
						<p class="servise-page-table__content-title-item"><?php the_title(); ?></p>
					</div>
					<?php
					$count = 1;
					$catalog_services = carbon_get_post_meta($post->ID, 'service_prices');
					if (!empty($catalog_services)) :
						foreach ($catalog_services as $service) :
					?>
							<div class="servise-page-table__content-table">
								<div class="servise-page-table__content-table-item servise-page-table__content-table-item_number">
									<p class="servise-page-table__content-table-item-text">
										<?php echo $count;
										$count++; ?>
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
									<div class="servise-page-table__content-table-item 
            servise-page-table__content-table-item_time">
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

					<?php
						endforeach;
					endif;
					?>

					<div class="servise-page-table__content-btn">
						<div class="site-button services__list-item-right-button" data-type="<?php echo $count; ?>">Записаться</div>
					</div>

				</div>
			<?php
			endforeach;
			?>
			<div class="services__poopup poopup hidden">
				<svg style="cursor: pointer;" class="services__poopup-svg" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path clip-rule="evenodd" d="M7.29289 8.6957L10.6194 12L7.29289 15.3043C6.90237 15.6922 6.90237 16.3212 7.29289 16.7091C7.68342 17.097 8.31658 17.097 8.70711 16.7091L12 13.4382L15.2929 16.7091C15.6834 17.097 16.3166 17.097 16.7071 16.7091C17.0976 16.3212 17.0976 15.6922 16.7071 15.3043L13.3806 12L16.7071 8.6957C17.0976 8.30778 17.0976 7.67885 16.7071 7.29094C16.3166 6.90302 15.6834 6.90302 15.2929 7.29094L12 10.5618L8.70711 7.29094C8.31658 6.90302 7.68342 6.90302 7.29289 7.29094C6.90237 7.67885 6.90237 8.30778 7.29289 8.6957Z" />
				</svg>
				<div class="poopup__title">Записаться</div>
				<div class="poopup__description">Оставьте ваши контактные данные, и наш администратор вскоре с Вами свяжется!
				</div>
				<form action="" method="POST" class="site-inputs services__inputs poopup__inputs">
					<input type="text" placeholder="Ваше имя" class="site-input poopup__inputs-input" name="firstname">
					<input type="text" placeholder="Ваша фамилия" class="site-input poopup__inputs-input" name="lastname">
					<input type="email" placeholder="Email" class="site-input poopup__inputs-input" name="email">
					<input type="text" placeholder="Ваш номер телефона" class="site-input poopup__inputs-input" id="phone-mask3" name="phone">
					<input type="hidden" class="services-type" value="1" name="type">
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
		</div>
	</div>
</section>