<div class="services inwork our-services-product" id="services">
	<img class="wave-fourteen" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-14.svg">
	<div class="container">
		<div class="services__list">
			<?php
			$posts = get_posts([
				'numberposts' => 0,
				'orderby'     => 'date',
				'order'       => 'DESC',
				'post_type'   => 'service_list',
				'suppress_filters' => true,
			]);
			foreach ($posts as $post) :
				setup_postdata($post);
				$service = get_carbon_page_meta($post->ID, [
					'img_service',
					'link',
					'age',
					'services',
				]);
				extract($service);
				$image = get_image_data($img_service, 'thumbnail');
			?>
				<div class="services__list-item">
					<div class="services__list-item-wrapper">
						<div class="services__list-header">
							<div class="services__list-img-wrapper">
								<?php if (!empty($image)) : ?>
									<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="services__list-item-img" loading="lazy">
								<?php endif; ?>
							</div>
							<div class="services__list-title">
								<a href="<?php echo esc_url($link); ?>">
									<p class="services__list-title-name"><?php the_title(); ?></p>
								</a>
								<?php if (!empty($age)) : ?>
									<div class="services__list-title-year">
										<img src="<?php bloginfo('template_directory') ?>/assets/img/minified-svg/laughing.svg" alt="smile" class="services__list-title-smile" width="24" height="24">
										<p class="services__list-title-smile-text">
											Возраст: <?php echo esc_html($age); ?>.
										</p>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="services__list-content">
							<?php the_content(); ?>
							<?php if (!empty($services)) : ?>
								<div class="services__list-content-info">
									<img src="<?php bloginfo('template_directory') ?>/assets/img/minified-svg/grid-row-2 copy.svg" alt="img" class="services__list-content-info-img" width="24" height="24">
									<p class="services__list-content-info-text">
										Услуги: <?php echo esc_html($services); ?>.
									</p>
								</div>
							<?php endif; ?>
						</div>
						<div class="services__list-btn">
							<div class="site-button services__list-item-right-button">Записаться</div>
						</div>
					</div>
				</div>
			<?php
			endforeach;
			wp_reset_postdata();
			?>
		</div>
	</div>
</div>