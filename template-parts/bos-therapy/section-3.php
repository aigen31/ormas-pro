<?php
$steps = carbon_get_post_meta($post->ID, 'bos_how_work');
if (!empty($steps)) :
?>
	<div class="how_work2">
		<div class="container">
			<div class="site-title how-work__title">Как проходит занятие</div>

			<div class="how_work_slider">
				<?php

				foreach ($steps as $step):
					$image = get_image_data($step['image'], 'thumbnail');
				?>
					<div class="how_work_slide">
						<div>
							<?php if (!empty($step['title'])): ?>
								<div class="how_work_title"><?php echo $step['title']; ?></div>
							<?php endif;
							if (!empty($step['text'])): ?>
								<div class="how_work_text"><?php echo $step['text']; ?></div>
							<?php endif; ?>
						</div>
						<div class="how_work_image">
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="slick-prev"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/vector.svg" alt=""></div>
			<div class="slick-next"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/vector.svg" alt=""></div>
		</div>
	</div>
<?php endif; ?>

<style media="screen">
	.how_work2 {
		background: #fde8d8;
		padding-bottom: 28px;
		padding-top: 60px;
		position: relative;
		z-index: 2;
	}

	.how_work2 .container {
		position: relative;
	}

	.how_work_slide {
		padding: 35px 20px;
		min-height: 700px;
		height: 100%;
		background: #fff;
		display: flex !important;
		flex-direction: column;
		justify-content: space-between;
		gap: 20px;
		align-items: center;
		width: 430px !important;
	}

	.how_work_title {
		font-family: Nunito;
		font-size: 24px;
		font-weight: 700;
		line-height: 32px;
		text-align: left;
		margin-bottom: 20px;
	}

	.how_work_text {
		font-size: 16px;
		font-weight: 400;
		line-height: 24px;
		text-align: left;
	}

	.how_work_image {
		text-align: center;
	}

	.how_work2 .slick-arrow {
		position: absolute;
		top: 50%;
		transform: translate(0, 50%);
	}

	.how_work2 .slick-arrow.slick-prev {
		left: -25px;
		background: #96c8ed8c;
		border: none;
		width: 50px;
		height: 50px;
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: center;
	}

	.how_work2 .slick-arrow.slick-prev img {
		transform: rotateY(180deg);
	}

	.how_work2 .slick-arrow.slick-next {
		right: -25px;
		background: #96c8ed8c;
		border: none;
		width: 50px;
		height: 50px;
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: center;
	}

	.how_work2 .slick-arrow::after,
	.how_work2 .slick-arrow::before {
		content: none;
	}

	.how_work2 .slick-arrow.slick-disabled {
		display: none !important;
	}

	.how_work2 .slick-arrow:not(.slick-disabled) {
		display: flex !important;
	}

	.how_work_image img {
		max-width: 100%;
		max-height: 400px;
	}

	@media (max-width: 1300px) {
		.how_work2 .slick-arrow.slick-prev {
			left: 10px;
		}

		.how_work2 .slick-arrow.slick-next {
			right: 10px;
		}
	}

	@media (max-width: 1155px) {
		.how_work_slide {
			min-height: 690px;
		}
	}

	@media (max-width: 1024px) {
		.how_work2 .slick-list.draggable {
			overflow: visible;
		}

		.how_work_slide {
			width: 100% !important;
		}
	}

	@media (max-width: 768px) {
		.how_work_slide {
			min-height: 600px;
		}

		.how_work_slide {
			width: 400px !important;
		}

		.how_work_image img {
			max-width: 100%;
			max-height: 249px;
		}
	}

	@media (max-width: 500px) {
		.how_work_slide {
			width: 350px !important;
			min-height: 620px;
		}
	}

	@media (max-width: 450px) {
		.how_work_slide {
			width: 300px !important;
			min-height: 650px;
		}
	}

	.slick-slide:not(.slick-active) .how_work_slide {
		opacity: 0.5;
	}

	.slick-slide:not(.slick-active)>div {
		background: #fff;
	}
</style>
<script>
	$(document).ready(function() {
		if ($(".how_work_slider")) {
			$(".how_work_slider").slick({
				infinite: false,
				slidesToShow: 2,
				slidesToScroll: 1,
				arrows: true,
				variableWidth: true,
				dots: false,
				prevArrow: document.querySelector('.how_work2 .slick-prev'),
				nextArrow: document.querySelector('.how_work2 .slick-next'),
				responsive: [{
						breakpoint: 1024,
						settings: {
							variableWidth: false,
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						}
					},
				]
			});
		}

	});
</script>