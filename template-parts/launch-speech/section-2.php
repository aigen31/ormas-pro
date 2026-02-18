<?php
$data = get_carbon_page_meta(get_the_ID(), [
  'ls_section_title',
  'ls_speech_stages',
]);
extract($data);

if (!empty($ls_speech_stages)) :
?>
  <section class="s speech-stages">
    <img class="how-work__bird" src="<?php bloginfo('template_directory') ?>/assets/img/general/bird-how-work.svg">
    <img class="wave-nine" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-9.svg">
    <div class="container">
      <h2 class="site-title speech-stages__title">
        <?php echo esc_html($ls_section_title ?: 'Этапы развития речи у ребёнка'); ?>
      </h2>

      <div class="speech-stages__grid">
        <?php foreach ($ls_speech_stages as $index => $stage) :
          $card_num = $index + 1;
          $cube_file_default = "cube-{$card_num}.svg";
          $cube_file_mobile = ($card_num == 1 || ($card_num >= 3 && $card_num <= 6)) ? "cube-{$card_num}-sm.svg" : $cube_file_default;
        ?>
          <div class="speech-stages__card">
            <div class="speech-stages__cube-wrapper">
              <picture>
                <source
                  media="(max-width: 768px)"
                  srcset="<?php bloginfo('template_directory'); ?>/assets/img/general/<?php echo esc_attr($cube_file_mobile); ?>">
                <img
                  src="<?php bloginfo('template_directory'); ?>/assets/img/general/<?php echo esc_attr($cube_file_default); ?>"
                  alt="Куб <?php echo $card_num; ?>"
                  class="speech-stages__cube-image">
              </picture>
            </div>

            <div class="speech-stages__content">
              <p class="speech-stages__card-text">
                <?php if (!empty($stage['title'])) : ?>
                  <strong><?php echo esc_html($stage['title']); ?></strong>
                <?php endif; ?>
                <?php if (!empty($stage['text'])) : ?>
                  <?php echo ' ' . esc_html($stage['text']); ?>
                <?php endif; ?>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="hide-sm">
        <?php get_template_part('template-parts/warning'); ?>
      </div>

      <div class="button-wrapper speech-stages__button-wrapper">
        <div class="site-button speech-stages__button how-work__button">
          Записаться на консультацию
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>