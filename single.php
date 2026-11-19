<?php get_header(); ?>
<? $author_id = carbon_get_post_meta(get_the_ID(), 'article_author'); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-block">
		<div class="container">
			<div class="post-block__left">
				<div class="post-block__left-top">
					<div class="post-block__left-top-left">
						<div class="post-block__left-top-left-date"><?php the_time('d.m.Y') ?></div>
						<!-- <div class="post-block__left-top-left-views">
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0)">
									<path d="M0.667969 8.00033C0.667969 8.00033 3.33464 2.66699 8.0013 2.66699C12.668 2.66699 15.3346 8.00033 15.3346 8.00033C15.3346 8.00033 12.668 13.3337 8.0013 13.3337C3.33464 13.3337 0.667969 8.00033 0.667969 8.00033Z" stroke="#808694" stroke-width="1.4"
										stroke-linecap="round" stroke-linejoin="round" />
									<path d="M8 9.99998C9.10457 9.99998 10 9.10455 10 7.99998C10 6.89542 9.10457 5.99998 8 5.99998C6.89543 5.99998 6 6.89542 6 7.99998C6 9.10455 6.89543 9.99998 8 9.99998Z" stroke="#808694" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
								</g>
								<defs>
									<clipPath id="clip0">
										<rect width="16" height="16" fill="white" />
									</clipPath>
								</defs>
							</svg>
							<?php // if (function_exists('the_views')) {
								// the_views();
							// } ?>
						</div> -->
					</div>
					<div class="post-block__left-top-right">
						<?php if (!empty($author_id)):
							$author_name = get_the_title($author_id);
							$author_photo = carbon_get_post_meta($author_id, 'specialist_photo');
							$author_specialization = carbon_get_post_meta($author_id, 'specialist_position');
							?>
							<a href="<?=get_permalink($author_id)?>" class="article-author-box">
								<div class="author-info">
									<?php if ($author_photo) : ?>
										<div class="author-photo">
											<?php echo wp_get_attachment_image($author_photo, 'medium'); ?>
										</div>
									<?php endif; ?>
									
									<div class="author-details">
										<div class="author-name"><?php echo esc_html($author_name); ?></div>
										<?php if ($author_specialization) : ?>
											<div class="author-specialization">
												<?php echo esc_html($author_specialization); ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</a>
						<?php endif; ?>
					</div>
				</div>

				<div class="post-text">
					<?php the_title('<h1>', '</h1>') ?>
					<?php the_content() ?>
				</div>
				<div class="post-block__left-top">
					<div class="post-block__left-top-left">
						<!-- <div class="post-block__left-top-left-views">
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0)">
									<path d="M0.667969 8.00033C0.667969 8.00033 3.33464 2.66699 8.0013 2.66699C12.668 2.66699 15.3346 8.00033 15.3346 8.00033C15.3346 8.00033 12.668 13.3337 8.0013 13.3337C3.33464 13.3337 0.667969 8.00033 0.667969 8.00033Z" stroke="#808694" stroke-width="1.4"
										stroke-linecap="round" stroke-linejoin="round" />
									<path d="M8 9.99998C9.10457 9.99998 10 9.10455 10 7.99998C10 6.89542 9.10457 5.99998 8 5.99998C6.89543 5.99998 6 6.89542 6 7.99998C6 9.10455 6.89543 9.99998 8 9.99998Z" stroke="#808694" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
								</g>
								<defs>
									<clipPath id="clip0">
										<rect width="16" height="16" fill="white" />
									</clipPath>
								</defs>
							</svg>
							<?php // if (function_exists('the_views')) {
								 // the_views();
							 // } ?>
						</div> -->
					</div>

				</div>
			</div>
			<div class="post-block__right">
				<div class="services__list services__list--sidebar">
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

	</div>
	</div>
</article>
<?php get_footer(); ?>