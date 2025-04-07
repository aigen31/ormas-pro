<div class="signup">
    <div class="container">
        <div class="signup__poopup poopup hidden">
            <svg style="cursor: pointer;" class="signup__poopup-svg" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" d="M7.29289 8.6957L10.6194 12L7.29289 15.3043C6.90237 15.6922 6.90237 16.3212 7.29289 16.7091C7.68342 17.097 8.31658 17.097 8.70711 16.7091L12 13.4382L15.2929 16.7091C15.6834 17.097 16.3166 17.097 16.7071 16.7091C17.0976 16.3212 17.0976 15.6922 16.7071 15.3043L13.3806 12L16.7071 8.6957C17.0976 8.30778 17.0976 7.67885 16.7071 7.29094C16.3166 6.90302 15.6834 6.90302 15.2929 7.29094L12 10.5618L8.70711 7.29094C8.31658 6.90302 7.68342 6.90302 7.29289 7.29094C6.90237 7.67885 6.90237 8.30778 7.29289 8.6957Z" />
            </svg>
            <div class="poopup__title">Спасибо за обращение!</div>
            <div class="poopup__description">Наш администратор вскоре с Вами свяжется!</div>
        </div>
        <div class="signup__text">
            <div class="signup__text-title">Записаться на экскурсию в центр</div>
            <div class="signup__text-description">
                Вы сможете всё увидеть своими глазами:
                <ul>
                    <li>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11 12.5858L15.2929 8.29291L16.7071 9.70712L11 15.4142L7.29291 11.7071L8.70712 10.2929L11 12.5858Z" fill="#fff" />
                        </svg>
                        как у нас всё устроено;
                    </li>
                    <li>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11 12.5858L15.2929 8.29291L16.7071 9.70712L11 15.4142L7.29291 11.7071L8.70712 10.2929L11 12.5858Z" fill="#fff" />
                        </svg>
                        познакомиться с нашими специалистами;
                    </li>
                    <li>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11 12.5858L15.2929 8.29291L16.7071 9.70712L11 15.4142L7.29291 11.7071L8.70712 10.2929L11 12.5858Z" fill="#fff" />
                        </svg>
                        понять, как мы можем помочь в Вашей ситуации
                    </li>
                </ul>
            </div>
        </div>
        <form method="POST" class="site-inputs signup__inputs">
            <input type="hidden" name="action" value="custom_form_submit">
            <?php wp_nonce_field('custom_form'); ?>
            <input type="text" placeholder="Ваше имя" class="site-input signup__inputs-input" name="firstname">
            <input type="text" placeholder="Ваша фамилия" class="site-input signup__inputs-input" name="lastname">
            <input type="email" placeholder="Email" class="site-input signup__inputs-input" name="email">
            <input type="text" placeholder="Ваш номер телефона" class="site-input signup__inputs-input phone-mask" name="phone">
            <input type="hidden" name="type" value="Запись на экскурсию">
            <input type="hidden" name="title" value="<?php the_page_title(); ?>">
            <div class="site-checkbox signup__inputs-checkbox">
                <label>
                    <input id="signupCheckbox" type="checkbox">
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
            <button class="site-button signup__inputs-button">Записаться</button>
        </form>
    </div>
</div>