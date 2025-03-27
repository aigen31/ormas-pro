<div class="party inwork" id="team">
    <img class="wave-third" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave3.png">
    <div class="container">
        <h2 class="site-title party__title">Наши специалисты</h2>
        <div class="party__poopup-list">
            <?php
            $posts = get_posts(array(
                'numberposts' => 20,
                'category_name' => null,
                'orderby'     => 'date',
                'order'       => 'ASC',
                'post_type'   => 'specialists',
                'suppress_filters' => true,
            ));
            foreach ($posts as $post) :
                $specialist = get_carbon_page_meta($post->ID, [
                    'specialist_photo',
                    'specialist_position',
                    'specialist_education',
                    'specialist_specialization',
                    'specialist_additional_education',
                    'specialist_experience',
                ]);
                $teamIndex++;
                extract($specialist);
                $image = get_image_data($specialist_photo, 'thumbnail');
            ?>
                <div class="party__poopup poopup hidden">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" d="M7.29289 8.6957L10.6194 12L7.29289 15.3043C6.90237 15.6922 6.90237 16.3212 7.29289 16.7091C7.68342 17.097 8.31658 17.097 8.70711 16.7091L12 13.4382L15.2929 16.7091C15.6834 17.097 16.3166 17.097 16.7071 16.7091C17.0976 16.3212 17.0976 15.6922 16.7071 15.3043L13.3806 12L16.7071 8.6957C17.0976 8.30778 17.0976 7.67885 16.7071 7.29094C16.3166 6.90302 15.6834 6.90302 15.2929 7.29094L12 10.5618L8.70711 7.29094C8.31658 6.90302 7.68342 6.90302 7.29289 7.29094C6.90237 7.67885 6.90237 8.30778 7.29289 8.6957Z" />
                    </svg>
                    <div class="party__list-item-shadow"></div>
                    <div class="party__list-item-background"></div>
                    <div style="background-image:url(<?php echo $image['url']; ?>);" class="party__list-item-image"></div>
                    <div class="party__list-item-text">
                        <div class="party__list-item-text-title">
                            <?php the_title(); ?>
                        </div>
                        <div class="party__list-item-text-status">
                            <?php echo $specialist_position; ?>
                        </div>
                        <div class="party__list-item-text-education">
                            <?php if ($specialist_education) : ?>
                                <div>
                                    <span>Образование:</span>
                                    <span><?php echo $specialist_education; ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($specialist_specialization) : ?>
                                <div>
                                    <span>Специализация:</span>
                                    <span><?php echo $specialist_specialization; ?></span>
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
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11 12.5858L15.2929 8.29291L16.7071 9.70712L11 15.4142L7.29291 11.7071L8.70712 10.2929L11 12.5858Z" fill="#808694" />
                                                    </svg>
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
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11 12.5858L15.2929 8.29291L16.7071 9.70712L11 15.4142L7.29291 11.7071L8.70712 10.2929L11 12.5858Z" fill="#808694" />
                                                    </svg>
                                                    <?php echo $exp['specialist_experience_title']; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
        <div class="party__list">
            <?php
            $posts = get_posts(array(
                'numberposts' => 20,
                'category_name' => null,
                'orderby'     => 'date',
                'order'       => 'ASC',
                'post_type'   => 'specialists',
                'suppress_filters' => true,
            ));
            $teamIndex = 0;
            foreach ($posts as $post) :
                setup_postdata($post);
                $specialist = get_carbon_page_meta($post->ID, [
                    'specialist_photo',
                    'specialist_position',
                    'specialist_education',
                    'specialist_specialization',
                    'specialist_description'
                ]);
                $teamIndex++;
                extract($specialist);
                $image = get_image_data($specialist_photo, 'thumbnail');
            ?>
                <div class="party__list-item">
                    <div class="party__list-item-shadow"></div>
                    <div class="party__list-item-background"></div>
                    <div style="background-image:url(<?php echo esc_url($image['url']); ?>);" class="party__list-item-image"></div>
                    <div class="party__list-item-text">
                        <div class="party__list-item-text-title">
                            <?php the_title(); ?>
                        </div>
                        <div class="party__list-item-text-status">
                            <?php echo $specialist_position; ?>
                        </div>
                        <div class="party__list-item-text-content">
                            <p>
                                <?php echo $specialist_description; ?>
                            </p>
                        </div>
                        <div class="party__list-item-text-education">
                            <?php if ($specialist_education) : ?>
                                <div>
                                    <span>Образование:</span>
                                    <span><?php echo $specialist_education; ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($specialist_specialization) : ?>
                                <div>
                                    <span>Специализация:</span>
                                    <span><?php echo $specialist_specialization; ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="party__list-item-text-more" data-number="<?php echo $teamIndex; ?>">Подробнее</div>
                    </div>
                </div>
            <?php endforeach;
            wp_reset_postdata(); ?>
        </div>
        <div class="slick-arrows">
            <div class="slick-prev"></div>
            <div class="slick-next"></div>
        </div>
    </div>
</div>