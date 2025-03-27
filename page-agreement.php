<?php get_header(); ?>
<div class="post-block agreement-block">
	<div class="container">
		<div class="post-block__left">
			<div class="post-text">
				<h1><?php the_title(); ?></h1>
				<div class="agreement-block__date">Версия от <?php the_time('d.m.Y'); ?></div>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>