<div class="services-and-prices">
    <div class="container">
        <div class="site-title services-and-prices__title">Услуги и цены</div>

        <ul class="services-and-prices__list">
            <?php
            $prices_id = carbon_get_post_meta($post->ID, 'price_ids');
            foreach ($prices_id as $price_id) :
                $prices = carbon_get_post_meta($price_id['price_id'], 'service_prices');
            ?>
                <li class="services-and-prices__list-item">
                    <details class="services-and-prices__details" open>
                        <summary class="services-and-prices__summary">
                            <p class="services-and-prices__summary-name"><?php echo get_the_title($price_id['price_id']); ?></p>
                            <p class="services-and-prices__summary-cross"></p>
                        </summary>
                        <ul class="services-and-prices__header">
                            <li class="services-and-prices__header-item">
                                <p class="services-and-prices__header-item-title">Тип занятия</p>
                            </li>
                            <li class="services-and-prices__header-item">
                                <p class="services-and-prices__header-item-title">Длительность</p>
                            </li>
                            <li class="services-and-prices__header-item">
                                <p class="services-and-prices__header-item-title">Очно</p>
                            </li>
                            <li class="services-and-prices__header-item">
                                <p class="services-and-prices__header-item-title">Онлайн</p>
                            </li>
                        </ul>
                        <div class="services-and-prices__summary-wrapper">
                            <ul class="services-and-prices__summary-list">
                                <?php
                                if ($prices) :
                                    foreach ($prices as $price) :
                                ?>
                                        <li class="services-and-prices__summary-list-item">
                                            <div class="services-and-prices__summary-list-item-wrapper">
                                                <?php if ($price['service_title']) : ?>
                                                    <p class="services-and-prices__summary-list-item-title"><?php echo $price['service_title']; ?></p>
                                                <?php
                                                endif;
                                                if ($price['service_subtitle']) : ?>
                                                    <p class="services-and-prices__summary-list-item-specialist"><?php echo $price['service_subtitle']; ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <p class="services-and-prices__summary-list-item-text"><?php echo $price['service_duration']; ?>
                                                <span class="services-and-prices__summary-list-item-text-title">длительность</span>
                                            </p>
                                            <p class="services-and-prices__summary-list-item-text"><?php echo $price['service_face_to_face']; ?>
                                                <span class="services-and-prices__summary-list-item-text-title">цена очно</span>
                                            </p>
                                            <p class="services-and-prices__summary-list-item-text"><?php echo $price['service_online']; ?>
                                                <span class="services-and-prices__summary-list-item-text-title">цена онлайн</span>
                                            </p>
                                        </li>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </ul>
                        </div>
                    </details>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="promotion_block">
            <div class="promotion_sticker">Акция</div>
            <div class="promotion_text">
                <b>Скидка 5 % на занятия по методу БОС-терапии</b> при одновременном посещении занятий с нейропсихологом или детским психологом в нашем центре.
            </div>
            <div class="promotion_images">
                <img src="<?php bloginfo('template_directory') ?>/assets/img/general/promo.png" alt="">
                <img src="<?php bloginfo('template_directory') ?>/assets/img/general/marks_promo.png" alt="">
            </div>
        </div>

        <div class="services-and-prices__button-wrapper">
            <a href="/service/" class="site-button target-link services-and-prices__button">посмотреть весь прайс</a>
        </div>
    </div>
    <div class="how-work__poopup ps-services-and-prices-popup poopup hidden">
        <svg style="cursor: pointer;" class="ps-services-and-prices-svg" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" d="M7.29289 8.6957L10.6194 12L7.29289 15.3043C6.90237 15.6922 6.90237 16.3212 7.29289 16.7091C7.68342 17.097 8.31658 17.097 8.70711 16.7091L12 13.4382L15.2929 16.7091C15.6834 17.097 16.3166 17.097 16.7071 16.7091C17.0976 16.3212 17.0976 15.6922 16.7071 15.3043L13.3806 12L16.7071 8.6957C17.0976 8.30778 17.0976 7.67885 16.7071 7.29094C16.3166 6.90302 15.6834 6.90302 15.2929 7.29094L12 10.5618L8.70711 7.29094C8.31658 6.90302 7.68342 6.90302 7.29289 7.29094C6.90237 7.67885 6.90237 8.30778 7.29289 8.6957Z" />
        </svg>
        <div class="poopup__title">Записаться</div>
        <div class="poopup__description">Оставьте ваши контактные данные, и наш администратор вскоре с Вами свяжется!
        </div>
        <form method="POST" class="site-inputs how-work__inputs ps-services-and-prices-inputs poopup__inputs">
            <input type="text" placeholder="Ваше имя" class="site-input poopup__inputs-input" name="firstname">
            <input type="text" placeholder="Ваша фамилия" class="site-input poopup__inputs-input" name="lastname">
            <input type="email" placeholder="Email" class="site-input poopup__inputs-input" name="email">
            <input type="text" placeholder="Ваш номер телефона" class="site-input poopup__inputs-input" id="phone-mask3" name="phone">
            <input type="hidden" class="how-work-type" value="4" name="type">
            <div class="site-checkbox poopup__inputs-checkbox">
                <label>
                    <input type="checkbox">
                    <div class="site-checkbox__checkbox">
                        <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.41 3L4 5.58L9.59 0L11 1.41L4 8.41L0 4.41L1.41 3Z" fill="#fff" />
                        </svg>
                    </div>
                    <div class="site__checkbox-text">
                        Согласие с условиями обработки <a href="/agreement/">персональных данных</a>
                    </div>
                </label>
            </div>
            <button class="site-button poopup_inputs-button">Записаться</button>
        </form>
    </div>
</div>

<style media="screen">
    .promotion_block {
        margin: 100px 0 50px;
        padding: 80px 60px 40px;
        background: #F5F3FB;
        position: relative;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
    }

    .promotion_sticker {
        width: max-content;
        font-family: Nunito;
        font-size: 16px;
        font-weight: 700;
        line-height: 14px;
        letter-spacing: 0.06em;
        text-align: left;
        text-transform: uppercase;
        background: #FC5130;
        color: #fff;
        border-radius: 0px 0px 4px 4px;
        padding: 20px 40px;
        position: absolute;
        left: 60px;
        top: 0;
    }

    .promotion_text {
        font-size: 18px;
        line-height: 26px;
        text-align: left;
        width: 50%;
    }

    .promotion_images {
        position: absolute;
        bottom: -5px;
        right: 90px;
        width: max-content;
    }

    .promotion_images img:first-child {
        max-width: 360px;
    }

    .promotion_images img:nth-child(2) {
        position: absolute;
        top: 23%;
        right: -39px;
    }

    @media (max-width: 920px) {
        .promotion_images img:nth-child(2) {
            max-width: 380px;
        }

        .promotion_images img:first-child {
            max-width: 320px;
        }

        .promotion_images {
            right: 40px;
        }
    }

    @media (max-width: 680px) {
        .promotion_images {
            position: relative;
            display: block;
            bottom: -5px;
            right: 0px;
            width: 100%;
            margin: auto;
            text-align: center;
        }

        .promotion_text {
            width: 100%;
        }

        .promotion_block {
            padding-bottom: 0;
            gap: 25px;
            flex-direction: column;
            flex-wrap: nowrap;
        }

        .promotion_images img:nth-child(2) {
            position: absolute;
            top: 23%;
            right: 4%;
            max-width: 100%;
        }

        .promotion_images img:first-child {
            max-width: 100%;
        }
    }
</style>