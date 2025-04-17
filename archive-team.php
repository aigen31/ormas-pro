<?php get_header(); ?>
<section class="party-page inwork">
  <div class="container">
    <?php the_archive_title('<h2 class="site-title party__title">', '</h2>'); ?>
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
          ]);
          extract($specialist);
          $image = get_image_data($specialist_photo, 'medium');
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
        endwhile;
      endif;
      ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>