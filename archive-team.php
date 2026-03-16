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
          <div class="party__list-item" id="team-<?php the_ID(); ?>">
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
                <a href="<?php echo get_permalink(); ?>" class="party__list-item-text-more">
                  подробнее
                </a>
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