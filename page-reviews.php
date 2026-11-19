<?php get_header(); ?>
<section class="main materials-page">
	<?php get_template_part('template-parts/reviews/about'); ?>
	<?php get_template_part('template-parts/reviews/reviews'); ?>
	<?php get_template_part('template-parts/reviews/form'); ?>
</section>
<style>
	.reviews {
		padding-top: 100px;
		padding-bottom: 100px;
	}

	@media screen and (max-width: 1024px) {
		.reviews {
			padding-top: 0px;
			padding-bottom: 40px;
		}
	}
</style>
<?php get_footer() ?>