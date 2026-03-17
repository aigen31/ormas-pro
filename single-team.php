<?php get_header(); ?>
<?           

$specialist = get_carbon_page_meta(get_the_ID(), [
	'specialist_photo',
	'specialist_position',
	'specialist_description',
	'specialist_education',
	'specialist_specialization',
	'specialist_additional_education',
	'specialist_experience',
	'specialist_additional_services',
	'specialist_reviews',
]);
extract($specialist);
$image = get_image_data($specialist_photo, 'large'); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-block single-team__container">
        <div class="container">
            <div class="post-text">
                <div class="single-team__picture">
                    <img src="<?=$image['url']?>">
                </div>
                <?php the_title('<h1>', '</h1>') ?>
                <div class="party__list-item-text-status">
                    <?php echo $specialist_position; ?>
                </div>
                <div class="party__list-item-text-education">
                    <?php if ($specialist_education) : ?>
                    <div class="party__attributes">
                        <span>Образование:</span>
                        <span><?php echo $specialist_education; ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ($specialist_specialization) : ?>
                    <div class="party__attributes">
                        <span>Специализация:</span>
                        <span><?php echo $specialist_specialization; ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="full-width party__list-item-text-content">
                        <p>
                            <?php echo $specialist_description; ?>
                        </p>
                    </div>
                    <?php if (!empty($specialist_additional_education) || !empty($specialist_experience)) : ?>
                    <div class="full-width">
                        <?php
						if (!empty($specialist_additional_services)) : ?>
                        <div class="full-width">
                            <span>Услуги:</span>
                            <span>
                                <ul>
                                    <?php foreach ($specialist_additional_services as $edu) : ?>
                                    <li>
                                        <?php echo $edu['specialist_additional_services_title']; ?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </span>
                        </div>
                        <?php endif; ?>
                        <?php
						if (!empty($specialist_additional_education)) : ?>
                        <div class="full-width">
                            <span>Дополнительное образование:</span>
                            <span>
                                <ul>
                                    <?php foreach ($specialist_additional_education as $edu) : ?>
                                    <li>
                                        <?php echo $edu['specialist_additional_education_title']; ?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </span>
                        </div>
                        <?php endif; ?>
                        <?php
						if (!empty($specialist_experience)) : ?>
                        <div class="full-width">
                            <span>Опыт работы:</span>
                            <span>
                                <ul>
                                    <?php foreach ($specialist_experience as $exp) : ?>
                                    <li>
                                        <?php echo $exp['specialist_experience_title']; ?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </span>
                        </div>
                        <?php endif; ?>
                        <?php
						if (!empty($specialist_reviews)) : ?>
                        <div class="party__reviews-slider__wrapper">
                            <div class="party__reviews-slider">
                                <?php foreach ($specialist_reviews as $review) : ?>
                                <div class="party__reviews-slider-item">
                                    <?php if (!empty($review['specialist_reviews_rating'])) : ?>
                                    <div class="party__reviews-slider-rating">
                                        <?php for ($i = 0; $i < $review['specialist_reviews_rating']; $i++) : ?>
                                        <img class="party__reviews-slider-rating-star"
                                            src="<?php echo get_template_directory_uri(); ?>/assets/img/general/star.svg"
                                            alt="">
                                        <?php endfor; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($review['specialist_reviews_title'])) : ?>
                                    <p class="party__reviews-slider-rating-title">
                                        <?php echo $review['specialist_reviews_title']; ?>
                                    </p>
                                    <?php endif; ?>
                                    <?php if (!empty($review['specialist_reviews_content'])) : ?>
                                    <p class="party__reviews-slider-rating-content">
                                        “<?php echo $review['specialist_reviews_content'] ?>”
                                    </p>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="party__reviews-controls"></div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
		$specialist_articles = get_posts([
			'post_type' => 'post',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'meta_query' => [
				[
					'key' => 'article_author',
					'value' => get_the_ID(),
					'compare' => '='
				]
			],
			'orderby' => 'date',
			'order' => 'DESC'
		]);

		if (!empty($specialist_articles)) : ?>
        <div class="container">
            <div class="single-team__news-list">
                <div class="site-title">Материалы автора</div>
                <div class="author-articles__list">
                    <?php foreach ($specialist_articles as $article) : ?>
                    <?php     
					$thumbnail_id = get_post_thumbnail_id($article->ID);
                    $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'medium');
                    $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
					?>
                    <div class="author-articles__item author-article">
                        <a href="<?php echo get_permalink($article->ID); ?>" class="author-article__link">
                            <?php if ($thumbnail_url) : ?>
                            <div class="author-article__thumbnail">
								<img src="<?php echo esc_url($thumbnail_url); ?>"
									alt="<?php echo esc_attr($thumbnail_alt ?: get_the_title($article->ID)); ?>"
									class="author-article__thumbnail-img">
                            </div>
                            <?php endif; ?>
                            <div class="author-article__title">
                                <?php echo get_the_title($article->ID); ?>
                            </div>
                            <div class="author-article__date">
                                <?php echo get_the_date('d.m.Y', $article->ID); ?>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    </div>
</article>
<?php get_footer(); ?>