<?php
$main_page_id   = get_option('page_for_posts');
$form_title     = carbon_get_post_meta($main_page_id, 'form_title');
$form_text_1    = carbon_get_post_meta($main_page_id, 'form_text_1');
$form_text_2    = carbon_get_post_meta($main_page_id, 'form_text_2');
$form_btn_text  = carbon_get_post_meta($main_page_id, 'form_button_text');
?>
<div class="consultation" id="consultation">
    <div class="container container-consultation">
        <div class="consultation__text">
            <div class="consultation__text-title"><?php echo esc_html($form_title ? $form_title : 'Записаться на бесплатную консультацию'); ?></div>
            <div class="consultation__text-description">
                <p class="consultation__text-description-item">
                    <?php echo esc_html($form_text_1 ? $form_text_1 : 'Не знаете, какой специалист Вам нужен? Просто заполните данную форму и мы перезвоним.'); ?>
                </p>
                <p class="consultation__text-description-item">
                    <?php echo esc_html($form_text_2 ? $form_text_2 : 'Расскажите нашему сотруднику, что Вас беспокоит. Он сориентирует в выборе специалиста и подробно ответит на все Ваши вопросы.'); ?>
                </p>

            </div>
        </div>
        <form method="POST" class="site-inputs consultation__inputs">
            <div class="consultation__input-wrapper">
                <input type="text" placeholder="Ваше имя" class="site-input consultation__inputs-input" name="firstname">
                <input type="email" placeholder="Email" class="site-input consultation__inputs-input" name="email">
                <input type="text" placeholder="Ваш номер телефона" class="site-input consultation__inputs-input phone-mask" name="phone">
                <input type="hidden" name="type" value="Консультация">
                <input type="hidden" name="title" value="<?php the_page_title(); ?>">
                <input type="hidden" name="action" value="custom_form_submit">
                <?php wp_nonce_field('custom_form'); ?>

                <div style="height: 100px" class="smart-captcha" data-sitekey="<?=$GLOBALS['sitekeyYandex']?>"></div>
                
                <div class="site-checkbox signup__inputs-checkbox consultation__inputs-checkbox">
                    <label>
                        <input type="checkbox">
                        <div class="site-checkbox__checkbox">
                            <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.41 3L4 5.58L9.59 0L11 1.41L4 8.41L0 4.41L1.41 3Z" fill="#fff" />
                            </svg>
                        </div>
                        <div class="site__checkbox-text consultation__checkbox-text">
                            Согласие с условиями обработки <a href="/agreement/">персональных данных</a>
                        </div>
                    </label>
                </div>                
                 
                <button class="site-button consultation__inputs-button"><?php echo esc_html($form_btn_text ? $form_btn_text : 'Записаться'); ?></button>
            </div>
        </form>
    </div>
</div>

<div class="phone-country-popup-overlay hidden"></div>
<div class="phone-country-popup poopup hidden" role="dialog" aria-modal="true" aria-labelledby="phone-country-popup-title">
    <button type="button" class="phone-country-popup__close" aria-label="Закрыть"></button>
    <div class="phone-country-popup__title" id="phone-country-popup-title">Если Вы находитесь не в России, пожалуйста, напишите нам</div>
    <div class="phone-country-popup__socials">
        <a href="https://api.whatsapp.com/send/?phone=79266699546" target="_blank" rel="noopener" aria-label="WhatsApp">
            <svg width="44" height="44" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.17 4.80163C13.7983 3.42913 11.9742 2.67246 10.0308 2.67163C6.025 2.67163 2.76583 5.92913 2.765 9.9333C2.76333 11.2075 3.0975 12.46 3.73416 13.5641L2.70333 17.3275L6.555 16.3175C7.62083 16.8975 8.81417 17.2016 10.0275 17.2016H10.0308C14.035 17.2016 17.2942 13.9433 17.2958 9.93913C17.2967 7.99913 16.5417 6.17496 15.17 4.80163Z" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M10.9125 11.2999L11.2508 10.9641C11.5617 10.6558 12.0533 10.6166 12.4117 10.8683C12.7583 11.1116 13.0717 11.3299 13.3633 11.5333C13.8267 11.8549 13.8825 12.5149 13.4833 12.9133L13.1842 13.2124" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M6.7875 6.81583L7.08667 6.51666C7.485 6.11833 8.145 6.17416 8.46667 6.63666C8.66917 6.92833 8.8875 7.24166 9.13167 7.58833C9.38333 7.94666 9.345 8.43833 9.03583 8.74916L8.7 9.08749" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M13.1842 13.2126C11.95 14.4409 9.87583 13.3976 8.23833 11.7593" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8.24 11.7618C6.6025 10.1234 5.55917 8.05008 6.7875 6.81592" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8.7 9.0874C8.96584 9.50657 9.30667 9.92157 9.69167 10.3066L9.69334 10.3082C10.0783 10.6932 10.4933 11.0341 10.9125 11.2999" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        <a href="https://t.me/ormas_center" target="_blank" rel="noopener" aria-label="Telegram">
            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.1453 6.41983L18.2478 19.6583C18.0291 20.5925 17.4592 20.8251 16.6493 20.3852L12.2342 17.2332L10.1041 19.2185C9.8682 19.4471 9.67138 19.6378 9.2167 19.6378L9.53422 15.2818L17.7163 8.11875C18.0723 7.81179 17.6389 7.64103 17.1636 7.94866L7.04824 14.1198L2.69349 12.7989C1.74642 12.5125 1.72928 11.8813 2.891 11.4408L19.9239 5.08303C20.7125 4.79666 21.4025 5.25312 21.1453 6.4205V6.41983Z" fill="#FFFFFF" />
            </svg>
        </a>
    </div>
</div>
