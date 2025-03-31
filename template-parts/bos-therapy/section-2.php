<?php
$problems = carbon_get_post_meta($post->ID, 'bos_problems');
if (!empty($problems)) :
?>
	<div class="can-ask-for">
		<div class="container">
			<h2 class="site-title can-ask-for__title">С чем можно обратиться</h2>
			<ul class="can-ask-for__list">
				<?php
				foreach ($problems as $problem):
					$image = get_image_data($problem['image'], 'medium');
				?>
					<li class="can-ask-for__item">
						<?php if (!empty($problem['title'])): ?>
							<p class="can-ask-for__item-title"><?php echo $problem['title']; ?></p>
						<?php endif;
						if (!empty($problem['text'])): ?>
							<div class="can-ask-for__item-des"><?php echo $problem['text']; ?></div>
						<?php endif;
						if (!empty($image['url'])): ?>
							<img src="<?php echo $image['url']; ?>" alt="<?php echo !empty($image['alt']) ? $image['alt'] : ''; ?>" class="can-ask-for__item-img" loading="lazy">
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
<?php endif; ?>

<style media="screen">
	@media screen and (max-width: 600px) {
		.neuropsychology-page li.can-ask-for__item {
			margin-top: 34px;
			padding-top: 35%;
		}

		.neuropsychology-page img.can-ask-for__item-img {
			height: auto;
			left: 0;
			right: auto;
			width: 50%;
		}

		.neuropsychology-page .can-ask-for__list {
			margin-top: 25px;
		}
	}
</style>