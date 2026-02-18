<?php
$data = get_carbon_page_meta(get_the_ID(), [
  'ls_how_work_title',
  'ls_how_work_intro',
  'ls_how_work_principles',
]);
extract($data);
?>
<section class="s ls-how-work">
  <div class="container">
    <h2 class="site-title ls-how-work__title">
      <?php echo esc_html($ls_how_work_title ?: 'Как проходит работа'); ?>
    </h2>

    <?php if (!empty($ls_how_work_intro)) : ?>
      <div class="ls-how-work__intro">
        <?php foreach ($ls_how_work_intro as $index => $intro) :
          $img_data = !empty($intro['image']) ? get_image_data($intro['image'], 'large') : null;
        ?>
          <div class="ls-how-work__intro-block">
            <div class="ls-how-work__intro-text">
              <?php if (!empty($intro['title'])) : ?>
                <h3 class="ls-how-work__intro-heading">
                  <?php echo esc_html($intro['title']); ?>
                </h3>
              <?php endif; ?>

              <?php if (!empty($intro['text'])) : ?>
                <p class="ls-how-work__intro-desc">
                  <?php echo nl2br(esc_html($intro['text'])); ?>
                </p>
              <?php endif; ?>
            </div>

            <?php if ($img_data) : ?>
              <div class="ls-how-work__intro-img">
                <img
                  src="<?php echo esc_attr($img_data['url']); ?>"
                  alt="<?php echo esc_attr($img_data['alt'] ?: $intro['title']); ?>"
                  class="ls-how-work__intro-photo">
              </div>
            <?php endif; ?>
            <?php if (isset($ls_how_work_intro[$index + 1])) : ?>
              <div class="ls-how-work__arrow-connector">
                <img
                  src="<?php bloginfo('template_directory'); ?>/assets/img/general/arrow_launch-speech.svg"
                  alt=""
                  class="ls-how-work__arrow-img">
              </div>
            <?php endif; ?>
          </div>


        <?php endforeach; ?>
      </div>

      <?php if (!empty($ls_how_work_principles)) : ?>
        <div class="ls-how-work__arrow-bridge">
          <img
            src="<?php bloginfo('template_directory'); ?>/assets/img/general/arrow-1_launch-speech.svg"
            alt=""
            class="ls-how-work__arrow-bridge-img">
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <?php if (!empty($ls_how_work_principles)) : ?>
      <div class="ls-how-work__grid">
        <?php
        // Split cards into two independent columns for masonry layout
        $left_cards  = [];
        $right_cards = [];
        foreach ($ls_how_work_principles as $idx => $principle) {
          if ($idx % 2 === 0) {
            $left_cards[] = ['data' => $principle, 'order' => $idx + 1];
          } else {
            $right_cards[] = ['data' => $principle, 'order' => $idx + 1];
          }
        }
        ?>
        <div class="ls-how-work__grid-col">
          <?php foreach ($left_cards as $card) :
            $principle = $card['data'];
            $icon_data = !empty($principle['icon']) ? get_image_data($principle['icon'], 'medium') : null;
          ?>
            <div class="ls-how-work__card" style="--card-order: <?php echo $card['order']; ?>">
              <?php if ($icon_data) : ?>
                <img
                  src="<?php echo esc_attr($icon_data['url']); ?>"
                  alt=""
                  class="ls-how-work__card-icon">
              <?php endif; ?>

              <div class="ls-how-work__card-content">
                <?php if (!empty($principle['title'])) : ?>
                  <h3 class="ls-how-work__card-title">
                    <?php echo esc_html($principle['title']); ?>
                  </h3>
                <?php endif; ?>

                <?php if (!empty($principle['text'])) : ?>
                  <p class="ls-how-work__card-text">
                    <?php echo nl2br(esc_html($principle['text'])); ?>
                  </p>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="ls-how-work__grid-col">
          <?php foreach ($right_cards as $card) :
            $principle = $card['data'];
            $icon_data = !empty($principle['icon']) ? get_image_data($principle['icon'], 'medium') : null;
          ?>
            <div class="ls-how-work__card" style="--card-order: <?php echo $card['order']; ?>">
              <?php if ($icon_data) : ?>
                <img
                  src="<?php echo esc_attr($icon_data['url']); ?>"
                  alt=""
                  class="ls-how-work__card-icon">
              <?php endif; ?>

              <div class="ls-how-work__card-content">
                <?php if (!empty($principle['title'])) : ?>
                  <h3 class="ls-how-work__card-title">
                    <?php echo esc_html($principle['title']); ?>
                  </h3>
                <?php endif; ?>

                <?php if (!empty($principle['text'])) : ?>
                  <p class="ls-how-work__card-text">
                    <?php echo nl2br(esc_html($principle['text'])); ?>
                  </p>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

    <div class="button-wrapper ls-how-work__button-wrapper">
      <div class="site-button ls-how-work__button how-work__button">
        Записаться на консультацию
      </div>
    </div>
  </div>
</section>