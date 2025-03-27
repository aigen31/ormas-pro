<?php
$cards = carbon_get_the_post_meta('cards');
if (!empty($cards)) :
?>
  <section class="s s-contact-with-problem">
    <img class="wave-nine" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-9.svg">
    <div class="container">
      <h2 class="s-contact-with-problem__title site-title">
        Нейрокоррекция поможет
      </h2>
      <div class="grid s-contact-with-problem__list">
        <?php
        foreach ($cards as $card): ?>
          <div class="s-contact-with-problem__card">
            <div class="s-contact-with-problem__img s-contact-with-problem__img--figure"></div>
            <div class="s-contact-with-problem__right-col">
              <?php if (!empty($card['card_title'])): ?>
                <h3 class="s-contact-with-problem__card-title">
                  <?php echo $card['card_title']; ?>
                </h3>
              <?php endif;
              if (!empty($card['card_text'])): ?>
                <p class="s-contact-with-problem__card-text">
                  <?php echo $card['card_text']; ?>
                </p>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="button-wrapper s-contact-with-problem__button-wrapper">
        <div class="s-contact-with-problem__button how-work__button site-button">
          Записаться на консультацию
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>