<?php
$prices_id = carbon_get_post_meta($post->ID, 'price_ids');
$service_offers = [];

if (!empty($prices_id)) {
    foreach ($prices_id as $price_id) {
        $prices = carbon_get_post_meta($price_id['price_id'], 'service_prices');

        if (empty($prices)) {
            continue;
        }

        foreach ($prices as $price) {
            $service_title = trim(wp_strip_all_tags((string) ($price['service_title'] ?? '')));
            $service_subtitle = trim(wp_strip_all_tags((string) ($price['service_subtitle'] ?? '')));
            $service_duration = trim(wp_strip_all_tags((string) ($price['service_duration'] ?? '')));
            $service_description_parts = [];

            if ($service_duration !== '') {
                $service_description_parts[] = 'Длительность ' . $service_duration;
            }

            if ($service_subtitle !== '') {
                $service_description_parts[] = $service_subtitle;
            }

            foreach ([
                'service_face_to_face' => 'очно',
                'service_online' => 'онлайн',
            ] as $price_field => $format) {
                $service_price = preg_replace('/[^\d]/', '', (string) ($price[$price_field] ?? ''));

                if ($service_title === '' || $service_price === '') {
                    continue;
                }

                $offer = [
                    '@type' => 'Offer',
                    'name' => $service_title . ' (' . $format . ')',
                    'price' => $service_price,
                    'priceCurrency' => 'RUB',
                ];

                if (!empty($service_description_parts)) {
                    $offer['description'] = implode('. ', $service_description_parts);
                }

                $service_offers[] = $offer;
            }
        }
    }
}

if (!empty($service_offers)) {
    $service_schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        '@id' => get_permalink() . '#service',
        'name' => get_the_title(),
        'description' => trim(wp_strip_all_tags(get_the_content())),
        'provider' => [
            '@type' => 'MedicalClinic',
            '@id' => 'https://ormas.pro/#organization',
            'name' => 'Центр детской нейропсихологии ORMAS',
            'url' => 'https://ormas.pro/',
            'telephone' => '+79266699546',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Мичуринский проспект д. 19, корпус 1',
                'addressLocality' => 'Москва',
                'postalCode' => '119192',
                'addressCountry' => 'RU',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => 55.697934,
                'longitude' => 37.504948,
            ],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                    'Sunday',
                ],
                'opens' => '10:00',
                'closes' => '20:00',
            ],
            'priceRange' => '$$',
        ],
        'audience' => [
            '@type' => 'Audience',
            'audienceType' => 'Дети, Школьники, Дошкольники',
        ],
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => 'Прайс-лист на услуги: ' . get_the_title(),
            'itemListElement' => $service_offers,
        ],
    ];

    echo '<script type="application/ld+json">' . wp_json_encode($service_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
?>
<div class="services-and-prices" id="service">
    <div class="container">
        <h2 class="site-title services-and-prices__title">Услуги и цены</h2>

        <ul class="services-and-prices__list">
            <?php
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
                                <p class="services-and-prices__header-item-title">Длит-ть (минуты)</p>
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
                                                <span class="services-and-prices__summary-list-item-text-title"><noindex>длительность</noindex></span>
                                            </p>
                                            <p class="services-and-prices__summary-list-item-text"><?php echo $price['service_face_to_face']; ?>
                                                <span class="services-and-prices__summary-list-item-text-title"><noindex>цена очно</noindex></span>
                                            </p>
                                            <p class="services-and-prices__summary-list-item-text"><?php echo $price['service_online']; ?>
                                                <span class="services-and-prices__summary-list-item-text-title"><noindex>цена онлайн</noindex></span>
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
