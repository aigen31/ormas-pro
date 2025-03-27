<?php
$items = carbon_get_post_meta($post->ID, 'how_work_items');
if (!empty($items)) :
?>
  <div class="how-work">
    <img class="how-work__bird" src="<?php bloginfo('template_directory') ?>/assets/img/general/bird-how-work.svg">
    <img class="wave-nine" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-9.svg">

    <div class="container">
      <div class="site-title how-work__title">Как проходит работа</div>

      <ul class="how-work__list">
        <?php
        foreach ($items as $item) :
        ?>
          <li class="how-work__item">
            <?php if (!empty($item['title'])) : ?>
              <p class="how-work__item-title"><?php echo $item['title']; ?></p>
            <?php endif;
            if (!empty($item['content'])) : ?>
              <div class="how-work__item-des"><?php echo $item['content']; ?></div>
            <?php endif; ?>
          </li>
        <?php
        endforeach;
        ?>
      </ul>
      <div class="how-work__button-wrapper">
        <button class="site-button how-work__button">Записаться на консультацию</button>
      </div>
    </div>
  </div>
<?php endif; ?>