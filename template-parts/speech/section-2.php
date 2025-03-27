<section class="s s-how-work">
	<div class="container">
		<h2 class="site-title s-how-work__title">
			Как проходит работа
		</h2>
		<?php
		$how_work = carbon_get_post_meta($post->ID, 's_how_work');
		if (!empty($how_work)) : ?>
			<div class="s-how-work__stages-list grid">
				<?php foreach ($how_work as $item) : ?>
					<div class="s-how-work__card">
						<div class="s-how-work__card-column s-how-work__card-column--left">
							<?php if (!empty($item['title'])) : ?>
								<h3 class="s-how-work__card-title">
									<?php echo $item['title']; ?>
								</h3>
							<?php endif;
							if (!empty($item['text'])) : ?>
								<p class="s-how-work__card-text">
									<?php echo $item['text']; ?>
								</p>
							<?php endif; ?>
						</div>

						<div class="s-how-work__card-column s-how-work__card-column--right">
							<?php if (!empty($item['image'])) :
								$img = get_image_data($item['image'], 'large');
							?>
								<img src="<?php echo esc_attr($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" class="s-how-work__card-img">
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif;

		$advantages = carbon_get_post_meta($post->ID, 's_how_work_advantages_list');
		if (!empty($advantages)) : ?>
			<div class="s-how-work__advantages-list grid">
				<?php foreach ($advantages as $advantage) : ?>
					<div class="s-how-work__advantages-card">
						<?php
						if (!empty($advantage['image'])) :
							$img = get_image_data($advantage['image'], 'full');
						?>
							<img src="<?php echo esc_attr($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" class="s-how-work__advantages-img">
						<?php endif; ?>

						<?php if (!empty($advantage['title'])) : ?>
							<h3 class="s-how-work__advantages-card-title">
								<?php echo $advantage['title']; ?>
							</h3>
						<?php endif; ?>

						<?php if (!empty($advantage['text'])) : ?>
							<p class="s-how-work__advantages-card-text">
								<?php echo $advantage['text']; ?>
							</p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="button-wrapper s-how-work__button-wrapper">
			<div class="site-button how-work__button s-how-work__button">
				Записаться на консультацию
			</div>
		</div>
	</div>
</section>