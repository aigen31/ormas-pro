<?php get_header(); ?>
<section class="party-page inwork neuropsychology-page">
  <img class="how-work__bird" src="<?php bloginfo('template_directory') ?>/assets/img/general/bird-how-work.svg">
  <?php get_template_part('template-parts/direction', null, [
    'header_image' => get_template_directory_uri() . '/assets/img/general/direction-team.webp',
    'description' => '<b>Познакомьтесь со специалистами</br> центра детской психологии ORMAS!</b></br> В нашей команде – детские и семейные психологи,</br> нейропсихологи, логопеды-дефектологи и БОС-терапевт.</br> Каждый специалист имеет свой уникальный подход к работе</br> с детьми и является профессионалом в своей области.'
  ]); ?>
  <div class="container">
    <div class="party-page__list">
      <?php
      if (have_posts()) :
        while (have_posts()) : the_post();
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
          $image = get_image_data($specialist_photo, 'large');
      ?>
          <div class="party__list-item">
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
                  <div class="full-width party__more">
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
                                    <img class="party__reviews-slider-rating-star" src="<?php echo get_template_directory_uri(); ?>/assets/img/general/star.svg" alt="">
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
                  <div class="party__more-btn">
                    подробнее
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
      <?php
        endwhile;
      endif;
      ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>