<?php get_header('404'); ?>
<section class="main neuropsychology-page page_404">
    <div class="consultation-overlay hidden "></div>

    <div class="about">
        <img class="wave-eight" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-8.svg">
        <div class="container">
            <div class="about__left">
                <div class="about__left-title">
                    <div class="checks">
                        <svg width="110" height="127" viewBox="0 0 110 127" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M62.2476 126.798C60.4376 126.798 58.6776 125.978 57.5076 124.488C45.4176 108.978 26.5976 96.538 4.51762 89.468C1.35762 88.458 -0.382377 85.078 0.637623 81.928C1.64762 78.768 5.02762 77.038 8.17762 78.038C26.6776 83.958 43.1776 93.388 55.9776 105.208C57.1176 68.278 70.9276 35.308 98.7476 2.60796C100.898 0.0879586 104.678 -0.222041 107.208 1.92796C109.728 4.07796 110.038 7.85796 107.888 10.388C77.8576 45.698 65.6276 79.638 68.2276 120.428C68.3976 123.058 66.8276 125.488 64.3676 126.418C63.6776 126.668 62.9576 126.798 62.2476 126.798Z" />
                        </svg>
                        <svg width="68" height="45" viewBox="0 0 68 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M28.0576 44.1876C27.1776 44.1876 26.2876 43.9976 25.4676 43.5976C23.4576 42.6376 22.1476 40.6476 22.0576 38.4276C21.7376 30.5576 16.1976 14.1576 4.8276 11.8876C1.5776 11.2376 -0.532398 8.0776 0.117602 4.8276C0.767602 1.5776 3.9176 -0.532398 7.1776 0.117602C21.0176 2.8776 29.3576 16.2476 32.5676 28.4376C41.0976 24.1976 51.9976 21.4076 62.8876 23.4176C66.1476 24.0176 68.2976 27.1476 67.6976 30.4076C67.0976 33.6676 63.9676 35.8176 60.7076 35.2176C49.7276 33.1876 38.1876 38.1476 31.6276 43.0076C30.5776 43.7876 29.3176 44.1876 28.0576 44.1876Z" />
                        </svg>
                        <svg width="35" height="53" viewBox="0 0 35 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M28.4076 52.388C27.2476 52.388 26.0676 52.048 25.0376 51.348C20.5676 48.298 14.0176 48.218 9.45761 51.148C6.94761 52.758 3.63761 52.288 1.67761 50.038C-0.282387 47.788 -0.282389 44.438 1.66761 42.178C4.92761 38.398 6.80761 32.978 6.94761 26.928C7.07761 21.618 5.97761 15.908 3.49761 8.95798C2.38761 5.83798 4.00761 2.40799 7.13761 1.28799C10.2576 0.177986 13.6876 1.79799 14.8076 4.92799C17.7576 13.188 19.1076 20.478 18.9476 27.208C18.8676 30.618 18.3876 33.918 17.5276 37.018C22.5876 37.098 27.6176 38.568 31.7976 41.418C34.5376 43.288 35.2476 47.018 33.3776 49.758C32.2076 51.478 30.3276 52.388 28.4076 52.388Z" />
                        </svg>
                    </div>
                    <h1 class="about__left-title-item">Ошибка 404</h1>
                    <span class="about_subtitle">Страница не найдена</span>
                </div>
                <div class="about__left-text">Неправильно набран адрес, или такой страницы на сайте не существует. Перейдите на главную страницу.</div>
                <a href="/" class="site-button">Вернуться на главную</a>


            </div>
            <div class="about__right">
                <img class="neuropsychology-direction" src="<?php bloginfo('template_directory') ?>/assets/img/general/404_image.png">
            </div>
        </div>
    </div>

    <div class="contacts_404">
        <div class="container">
            <div class="site-title small_title md_center call_us_404">Связаться с нами</div>
            <div class="contacts_404_wrapper">
                <div class="contacts_item">
                    <div class="contacts_icon"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/clock_icon.svg" alt=""></div>
                    <span><b>Часы работы центра:</b> ежедневно, с 10:00 до 20:00 (по Мск)</span>
                </div>

                <div class="contacts_item">
                    <div class="contacts_icon"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/email_icon.svg" alt=""></div>
                    <span><b>Email:</b> <a href="mailto:info@ormas.pro">info@ormas.pro</a></span>
                </div>

                <div class="contacts_item">
                    <div class="contacts_icon"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/phone_icon.svg" alt=""></div>
                    <span><b>Тел.:</b> <a href="tel:+74991137650">+7 (499) 113-76-50</a></span>
                </div>

                <div class="contacts_item">
                    <div class="contacts_icon"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/whatsapp_icon.svg" alt=""></div>
                    <span><b>WhatsApp:</b> <a href="https://api.whatsapp.com/send/?phone=79266699546">+7 (926) 669-95-46</a></span>
                </div>
            </div>
        </div>
    </div>

    <?php get_footer() ?>

    <style media="screen">
        .page_404 {
            background: #f5f3fb;
        }

        .contacts_404 {
            background: transparent;
            padding: 0px 0 60px;
            position: relative;
            z-index: 1;
            margin-top: -50px;
        }

        .contacts_item {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            gap: 15px;
            align-items: center;
        }

        .contacts_icon {
            background: #fff;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            width: 50px;
            min-width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0px 10px 18.2px -6px #2E146426;
        }

        .contacts_item span {
            font-size: 20px;
            line-height: 32px;
        }

        .contacts_item a {
            text-decoration: none;
        }

        .site-title.call_us_404 {
            font-size: 32px;
            font-weight: 700;
            line-height: 40px;
            text-align: left;
            margin-bottom: 40px;

        }

        span.about_subtitle {
            width: 100%;
            display: block;
            font-size: 24px;
            font-weight: 600;
            line-height: 20px;
            margin-top: 25px;
            margin-bottom: 25px;
            text-align: left;
        }

        .neuropsychology-page.page_404 .about__left-text {
            font-size: 18px;
            font-weight: 700;
            line-height: 26px;
            text-align: left;
        }

        .page_404 .about__left {
            text-align: left;
        }

        .page_404 .about__left .site-button {
            margin: 0;
            padding: 20px 30px;
            min-height: 65px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            width: max-content;
            margin-top: 30px;
        }

        .contacts_404_wrapper {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: flex-start;
            gap: 25px;
            justify-content: space-between;
        }

        .contacts_404_wrapper .contacts_item {
            width: calc(40% - 15px);
        }

        @media (max-width: 1024px) {
            .contacts_404_wrapper .contacts_item {
                width: calc(50% - 15px);
            }

            .md_center {
                text-align: center !important;
            }

            .contacts_404 {
                padding: 60px 0 60px;
                margin-top: 0px;
            }
        }

        @media (max-width: 768px) {
            .contacts_404 {
                padding: 20px 0 60px;
            }
        }

        @media (max-width: 600px) {
            .neuropsychology-page.page_404 .about__right {
                margin-top: 65px;
            }

            .contacts_404_wrapper .contacts_item {
                width: 100%;
            }

            .neuropsychology-page.page_404 .about__left-text {
                font-weight: 500;
            }
        }
    </style>
    </body>
</section>
<?php get_footer(); ?>