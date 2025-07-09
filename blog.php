<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-block">
		<div class="container">
			<div class="post-block__left">

				<div class="post-text">
					<?php the_title('<h1>', '</h1>') ?>
					<?php the_content() ?>
					<div class="blog-list"> 
						<?php
 
						if(!empty($_GET['tag'])) {
							$tag = strip_tags($_GET['tag']);
							$args = array(
								'posts_per_page' => -1,  
								'post_type'      => 'post',  
								'tax_query' => array(
									array(
										'taxonomy' => 'post_tag',  
										'field'    => 'slug',    
										'terms'    => $tag,  
									),
								),
							);
						} else {
							$args = array(
								'posts_per_page' => -1,  
								'post_type'      => 'post',  
							);
						}
 
						$posts = get_posts( $args );

						if ( $posts ) {
							foreach ( $posts as $post ) {
								setup_postdata( $post );
								?>
								<div class="post__list-article">
									<a href="<?php the_permalink(); ?>" class="post__list-item" >
										<?php the_post_thumbnail(); ?>
										<div class="post__list-item-text">
											<div class="flex-block-first">
												<span><?php the_title(); ?></span>
											</div>
											<div class="flex-block-second">
												<p><?php the_time('d.m.Y') ?></p>
											</div>
										</div>
									</a>
								</div>
								<?php
							}
							wp_reset_postdata();
						}
						?>
					</div>
				</div>
			</div>
			<div class="post-block__right"> 
				<ul class="list-tags">
				<?php
					$terms = get_terms( array(
						'taxonomy' => 'post_tag',
					) );

					foreach( $terms as $term ) {
						?>
						<li class="list-tags__item"> 
							<a href="?tag=<?=$term->slug?>" title="<?=$term->name?>"><?=$term->name?></a>
						</li>
						<?
					}
				?>
				</ul>
			</div>
		</div>

	</div>
	</div>
</article>
<?php get_footer(); ?>