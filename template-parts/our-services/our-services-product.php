<div class="services inwork our-services-product" id="services">
	<img class="wave-fourteen" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-14.svg">
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
		<div class="services__list">

			<?php
			$count = 2;
			// параметры по умолчанию
			$posts = get_posts(array(
				'numberposts' => 0,
				'category_name' => null,
				'orderby'     => 'date',
				'order'       => 'DESC',
				'post_type'   => 'our_services',
				'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
			));
			foreach ($posts as $post) {
				setup_postdata($post);
			?>

				<div class="services__list-item">
					<div class="services__list-item-wrapper">
						<div class="services__list-header">
							<div class="services__list-img-wrapper">
								<img src="<?php the_field('img-servise'); ?>" alt="img" class="services__list-item-img" loading="lazy">
							</div>
							<div class="services__list-title">
								<a href="<?php the_field('link'); ?>">
									<p class="services__list-title-name"><?php the_title(); ?></p>
								</a>
								<div class="services__list-title-year">
									<img src="<?php bloginfo('template_directory') ?>/assets/img/minified-svg/laughing.svg" alt="smile" class="services__list-title-smile" width="24" height="24">
									<p class="services__list-title-smile-text">
										<?php the_field('yaer-servise'); ?>
									</p>
								</div>
							</div>
						</div>
						<div class="services__list-content">
							<?php the_content(); ?>
							<div class="services__list-content-info">
								<img src="<?php bloginfo('template_directory') ?>/assets/img/minified-svg/grid-row-2 copy.svg" alt="img" class="services__list-content-info-img" width="24" height="24">
								<p class="services__list-content-info-text">
									<?php the_field('servise-name'); ?>
								</p>
							</div>
						</div>
						<div class="services__list-btn">
							<div class="site-button services__list-item-right-button" data-type="2" data-email="<?php the_field('email_title'); ?>">Записаться</div>
						</div>
					</div>
				</div>
			<?php
				// формат вывода the_title() ...
			}
			wp_reset_postdata(); // сброс
			?>
		</div>
	</div>
</div>