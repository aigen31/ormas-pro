<?php get_header(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-block">
		<div class="container">
			<div class="post-block__left">
				<div class="post-block__left-top">
					<div class="post-block__left-top-left">
						<div class="post-block__left-top-left-date"><?php the_time('d.m.Y') ?></div>
						<div class="post-block__left-top-left-views">
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
						</div>
					</div>
					<div class="post-block__left-top-right">
						<img src="<?php bloginfo('template_directory') ?>/assets/img/general/post-social.jpg">
					</div>
				</div>

				<div class="post-text">
					<?php the_title('<h1>', '</h1>') ?>
					<?php the_content() ?>
				</div>
				<div class="post-block__left-top">
					<div class="post-block__left-top-left">
						<div class="post-block__left-top-left-date">16.06.2020</div>
						<div class="post-block__left-top-left-views">
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
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>
	</div>
</article>
<?php get_footer(); ?>