<?php
$items = carbon_get_post_meta($post->ID, 'items');
if (!empty($items)) :
?>
  <section class="s s-neuropsychology">
    <img class="wave-nine" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-9.svg">
    <div class="container">
      <h2 class="s-neuropsychology__site-title site-title">
        Зачем проводить нейропсихологическую диагностику?
      </h2>
      <div class="grid s-neuropsychology__grid">
        <?php
        foreach ($items as $item): ?>
          <div class="s-neuropsychology__item">
            <?php $image = get_image_data($item['image'], 'full');
            if (!empty($image)): ?>
              <img
                src="<?php echo esc_url($image['url']); ?>"
                alt="<?php echo esc_attr($image['alt']); ?>"
                class="s-neuropsychology__figure" />
            <?php endif;
            if (!empty($item['item_title'])): ?>
              <h3 class="item-title s-neuropsychology__item-title">
                <?php echo $item['item_title']; ?>
              </h3>
            <?php endif;
            if (!empty($item['item_text'])): ?>
              <p class="item-text s-neuropsychology__item-text">
                <?php echo $item['item_text']; ?>
              </p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="button-wrapper s-neuropsychology__button-wrapper">
        <div class="s-neuropsychology__button how-work__button site-button">
          Записаться на консультацию
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>