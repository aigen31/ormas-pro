<div class="post" id="news">
    <img class="wave-fourth" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave4.png">
    <div class="container">
        <h2 class="site-title post__title">Статьи</h2>
        <div class="post__list">
            <?php
            $posts = get_posts([
                'numberposts' => 0,
                'orderby'     => 'date',
                'order'       => 'DESC',
                'post_type'   => 'post',
                'suppress_filters' => true,
            ]);
            foreach ($posts as $post) :
                setup_postdata($post)
            ?>
                <article class="post__list-article">
                    <a href="<?php the_permalink(); ?>" class="post__list-item">
                        <?php the_post_thumbnail('post-thumb') ?>
                        <div class="post__list-item-text">
                            <div class="flex-block-first">
                                <span><?php the_title(); ?> </span>
                            </div>
                            <div class="flex-block-second">
                                <p><?php the_time('d.m.Y') ?></p>
                            </div>
                        </div>
                    </a>
                </article>
            <?php
            endforeach;
            wp_reset_postdata();
            ?>
        </div>
        <div class="slick-arrows">
            <div class="slick-prev"></div>
            <div class="slick-next"></div>
        </div>
    </div>
</div>