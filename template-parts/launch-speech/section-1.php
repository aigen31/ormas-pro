<?php
$problems = carbon_get_post_meta(get_the_ID(), 's_contact_with_problem');
if (!empty($problems)) :
?>
	<section class="s s-contact-with-problem">
		<img class="how-work__bird" src="<?php bloginfo('template_directory') ?>/assets/img/general/bird-how-work.svg">
		<img class="wave-nine" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-9.svg">
		<div class="container">
			<h2 class="site-title s-contact-with-problem__title">
				С чем можно<br class="--only-sm"> обратиться
			</h2>

			<div class="s-contact-with-problem__list grid">
				<?php foreach ($problems as $problem) : ?>
					<div class="s-contact-with-problem__card">
						<div class="s-contact-with-problem__img"></div>

						<?php if (!empty($problem['title']) || !empty($problem['subtitle'])) : ?>
							<div class="s-contact-with-problem__right-col">
								<?php if (!empty($problem['title'])) : ?>
									<h3 class="s-contact-with-problem__card-title">
										<?php echo $problem['title']; ?>
									</h3>
								<?php endif;
								if (!empty($problem['subtitle'])) : ?>
									<p class="s-contact-with-problem__card-text">
										<?php echo $problem['subtitle']; ?>
									</p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
				<?php get_template_part('template-parts/warning'); ?>
			</div>

			<div class="button-wrapper s-contact-with-problem__button-wrapper">
				<div class="site-button how-work__button s-contact-with-problem__button">
					Записаться на консультацию
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>