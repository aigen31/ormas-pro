<div class="neuropsychology-slider neuropsychology-slider--main" id="team">
    <img class="wave-third" src="<?php echo get_template_directory_uri(); ?>/assets/img/general/wave3.png" loading="lazy">
    <div class="container">
        <div class="site-title neuropsychology-slider__title">Наши специалисты</div>
        <div class="neuropsychology-slider__list">
            <?php
            $direcrion_slug = carbon_get_post_meta($post->ID, 'specialists_direction_slug');
            $posts = get_posts(array(
                'numberposts' => 20,
                'orderby'     => 'date',
                'order'       => 'ASC',
                'direction'   => $direcrion_slug,
                'post_type'   => 'team',
                'suppress_filters' => true,
            ));

            foreach ($posts as $post) {
                setup_postdata($post);
                $specialist = get_carbon_page_meta($post->ID, [
                    'specialist_photo',
                    'specialist_position',
                ]);
                extract($specialist);
                $image = get_image_data($specialist_photo, 'medium');
            ?>
                <div class="party__list-item">
                    <!-- <div class="party__list-item-shadow"></div>
                    <div class="party__list-item-background"></div> -->
                    <div style="background-image:url(<?php echo $image['url']; ?>);" class="party__list-item-image"></div>
                    <div class="party__list-item-text">
                        <div class="party__list-item-text-title">
                            <?php the_title(); ?>
                        </div>
                        <div class="party__list-item-text-status">
                            <?php echo $specialist_position; ?>
                        </div>
                        <a href="<?php echo get_post_type_archive_link('team'); ?>" class="party__list-item-text-more" tabindex="0">Подробнее</a>
                    </div>
                </div>
            <?php
            }
            wp_reset_postdata();
            ?>
        </div>
        <div class="slick-arrows">
            <div class="slick-prev"></div>
            <div class="slick-next"></div>
        </div>
    </div>
</div>