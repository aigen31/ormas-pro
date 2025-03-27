<?php
$how_work_items = carbon_get_post_meta($post->ID, 'psychological_support_how_work');
if (!empty($how_work_items)) :
?>
	<div class="how-work how-work-psychological-support">
		<img class="wave-nine" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-9.svg">
		<div class="container">
			<div class="site-title how-work__title">Как проходит консультация с психологом?</div>
			<ul class="how-work__list">
				<?php
				foreach ($how_work_items as $item):
					$image = get_image_data($item['image'], 'thumbnail')
				?>
					<li class="how-work__item">
						<div class="how-work__item-wrapper">
							<?php if (!empty($item['title'])): ?>
								<p class="how-work__item-title"><?php echo $item['title']; ?></p>
							<?php endif;
							if (!empty($item['content'])): ?>
								<div class="how-work__item-des"><?php echo $item['content']; ?></div>
							<?php endif; ?>
						</div>
						<img src="<?php echo $image['url']; ?>" alt="<?php $image['alt']; ?>" class="how-work__item-img" loading="lazy">
					</li>
				<?php endforeach; ?>
			</ul>
			<?php get_template_part('template-parts/warning'); ?>
			<div class="how-work__button-wrapper">
				<button class="site-button psychological-support-how-work-button">Записаться на консультацию</и>
			</div>
		</div>
	</div>
<?php endif; ?>