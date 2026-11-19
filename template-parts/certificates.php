<div class="certificates inwork" id="certificates">
  <div class="container">
    <div class="certificates__wrapper">
      <h2 class="site-title certificates__title">Дипломы и сертификаты</h2>
      <div class="certificates__list">
        <?php
        $main_page_id = get_option('page_for_posts');
        $certificates = carbon_get_post_meta($main_page_id, 'certificates_gallery');
        if (!empty($certificates)) :
          foreach ($certificates as $key => $certificate) :
            $image = get_image_data($certificate, 'large');
        ?>
            <div class="certificates__list-item" style="width: 100%; display: inline-block;">
              <div class="certificates__list-item-image">
                <a href="<?php echo $image['url']; ?>" class="image-popup-vertical-fit">
                  <img src="<?php echo $image['url']; ?>" alt="Сертификат <?=$key?>" class="certificate__image" loading="lazy">
                </a>
              </div>
            </div>
        <?php
          endforeach;
        endif;
        ?>
      </div>
      <div class="slick-arrows">
        <div class="slick-prev"></div>
        <div class="slick-next"></div>
      </div>
    </div>
  </div>
</div>