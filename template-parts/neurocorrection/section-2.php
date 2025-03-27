<?php
$stages = carbon_get_the_post_meta('work_stages');
if (!empty($stages)) :
?>
  <section class="s s-neurocorrection-work">
    <div class="container">
      <h2 class="s-neurocorrection-work__title site-title">
        Как проходит работа
      </h2>
      <div class="grid s-neurocorrection-work__grid">
        <?php
        if (!empty($stages)):
          foreach ($stages as $stage):
            $image = get_image_data($stage['stage_image'], 'full'); ?>
            <div class="s-neurocorrection-work__item">
              <div class="s-neurocorrection-work__item-header">
                <div class="s-neurocorrection-work__item-img-wrapper">
                  <?php if ($image): ?>
                    <img
                      src="<?php echo esc_url($image['url']); ?>"
                      alt="<?php echo esc_attr($image['alt']); ?>"
                      class="s-neurocorrection-work__item-img" />
                  <?php endif; ?>
                </div>
                <?php if (!empty($stage['stage_title'])): ?>
                  <h3 class="item-title s-neurocorrection-work__item-title">
                    <?php echo $stage['stage_title']; ?>
                  </h3>
                <?php endif; ?>
              </div>
              <?php if (!empty($stage['stage_description'])): ?>
                <p class="item-text s-neurocorrection-work__item-text">
                  <?php echo $stage['stage_description']; ?>
                </p>
              <?php endif; ?>
            </div>
        <?php endforeach;
        endif; ?>
      </div>
      <div class="button-wrapper s-contact-with-problem__button-wrapper">
        <div class="s-contact-with-problem__button how-work__button site-button">
          Записаться на диагностику
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>