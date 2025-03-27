<div class="s-what-is-neuropsychology__item s-what-is-neuropsychology__item--attention">
  <div class="s-what-is-neuropsychology__item-content">
    <?php
    $warning = get_carbon_page_meta($post->ID, [
      'warning_title',
      'warning_text'
    ]);
    extract($warning);

    if ($warning_title) :
    ?>
      <h3 class="item-title s-what-is-neuropsychology__item-title s-what-is-neuropsychology__item-title--attention">
        <?php echo $warning_title; ?>
      </h3>
    <?php endif;
    if ($warning_text) :
    ?>
      <div class="s-what-is-neuropsychology__item-text s-what-is-neuropsychology__item-text--attention">
        <?php echo $warning_text; ?>
      </div>
    <?php endif; ?>
  </div>
</div>