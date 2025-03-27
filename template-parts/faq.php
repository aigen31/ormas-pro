<div class="frequent-questions">
    <img class="wave-ten" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-10.svg">
    <img class="wave-eleven" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-11.svg">
    <div class="container">
        <div class="site-title frequent-questions__title">Частые вопросы родителей</div>
        <div class="frequent-questions__list">
            <?php
            $faq_items = carbon_get_post_meta($post->ID, 'service_faq');
            if (!empty($faq_items)) :
                foreach ($faq_items as $item) :
            ?>
                <li class="frequent-questions__item">
                    <details class="frequent-questions__details">
                        <summary class="frequent-questions__summary">
                            <p class="frequent-questions__summary-name"><?php echo esc_html($item['question']); ?></p>
                            <p class="frequent-questions__summary-cross"></p>
                        </summary>
                        <div class="frequent-questions__details-text"><?php echo $item['answer']; ?></div>
                    </details>
                </li>
            <?php
                endforeach;
            endif;
            ?>
        </div>
        <div class="frequent-questions__button-wrapper">
            <button class="site-button target-link frequent-questions__button">Хочу задать свой вопрос</и>
        </div>
    </div>

    <div class="frequent-questions__poopup services__poopup poopup hidden">
        <svg style="cursor: pointer;" class="frequent-questions__poopup-svg services__poopup-svg" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" d="M7.29289 8.6957L10.6194 12L7.29289 15.3043C6.90237 15.6922 6.90237 16.3212 7.29289 16.7091C7.68342 17.097 8.31658 17.097 8.70711 16.7091L12 13.4382L15.2929 16.7091C15.6834 17.097 16.3166 17.097 16.7071 16.7091C17.0976 16.3212 17.0976 15.6922 16.7071 15.3043L13.3806 12L16.7071 8.6957C17.0976 8.30778 17.0976 7.67885 16.7071 7.29094C16.3166 6.90302 15.6834 6.90302 15.2929 7.29094L12 10.5618L8.70711 7.29094C8.31658 6.90302 7.68342 6.90302 7.29289 7.29094C6.90237 7.67885 6.90237 8.30778 7.29289 8.6957Z" />
        </svg>
        <div class="poopup__title">Остались вопросы?</div>
        <div class="poopup__description">Оставьте ваши контактные данные, и наш администратор вскоре с Вами свяжется!
        </div>
        <form method="POST" class="site-inputs services__inputs poopup__inputs">
            <input type="text" placeholder="Ваше имя" class="site-input poopup__inputs-input" name="firstname">
            <input type="email" placeholder="Email" class="site-input poopup__inputs-input" name="email">
            <input type="text" placeholder="Ваш номер телефона" class="site-input poopup__inputs-input" id="phone-mask3" name="phone">
            <textarea type="textarea" placeholder="Ваш вопрос" class="site-input poopup__inputs-input" name="text"></textarea>
            <input type="hidden" value="6" name="type">
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