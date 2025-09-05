<?php
$steps = carbon_get_post_meta($post->ID, 'steps');
if (!empty($steps)) :
?>
  <section class="s s-what-is-neuropsychology">
    <div class="container">
      <h2 class="s-what-is-neuropsychology__site-title site-title">
        Что из себя представляет диагностика?
      </h2>
      <div class="s-what-is-neuropsychology__wrapper">
        <?php
        foreach ($steps as $index => $step): ?>
          <div class="s-what-is-neuropsychology__item s-what-is-neuropsychology__item--arrow <?php echo $index % 2 != 0 ? 's-what-is-neuropsychology__item--reverse' : ''; ?>">
            <div class="s-what-is-neuropsychology__item-content">
              <?php if (!empty($step['step_title'])): ?>
                <h3 class="item-title s-what-is-neuropsychology__item-title">
                  <?php echo $step['step_title']; ?>
                </h3>
              <?php endif;
              if (!empty($step['step_description'])): ?>
                <p class="s-what-is-neuropsychology__item-text">
                  <?php echo $step['step_description']; ?>
                </p>
              <?php endif; ?>
            </div>
            <div class="s-what-is-neuropsychology__item-img-wrapper">
              <?php $image = get_image_data($step['step_image'], 'full');
              if (!empty($image)): ?>
                <img
                  src="<?php echo esc_url($image['url']); ?>"
                  alt="<?php echo esc_attr($image['alt']); ?>"
                  class="s-what-is-neuropsychology__item-img" />
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach;
        get_template_part('template-parts/warning');
        ?>
      </div>
      <div class="button-wrapper s-what-is-neuropsychology__button-wrapper">
        <div class="s-what-is-neuropsychology__button how-work__button site-button">
          Записаться на занятия
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>