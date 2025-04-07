<div class="consultation" id="consultation">
    <div class="container container-consultation">
        <div class="poopup-consultation__poopup consultation-hide">
            <div class="poopup-consultation__poopup-wrapper">
                <div class="poopup-consultation__title">Спасибо за обращение!</div>
                <div class="poopup-consultation__description">Мы перезвоним Вам, как только освободится один из специалистов</div>
            </div>
            <div class="poopup-consultation__close-wrapper">
                <div class="poopup-consultation__close"></div>
            </div>
        </div>
        <div class="consultation__text">
            <div class="consultation__text-title">Записаться на бесплатную консультацию</div>
            <div class="consultation__text-description">
                <p class="consultation__text-description-item">
                    Не знаете, какой специалист Вам нужен? Просто заполните данную форму и мы перезвоним.
                </p>
                <p class="consultation__text-description-item">
                    Расскажите нашему сотруднику, что Вас беспокоит. Он сориентирует в выборе специалиста и подробно ответит на все Ваши вопросы.
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
                <button class="site-button consultation__inputs-button">Записаться</button>
            </div>
        </form>
    </div>
</div>