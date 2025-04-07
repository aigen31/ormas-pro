<section class="servise-form _anim-items">
  <div class="servise-form__send-form">
    <p class="servise-form__close"></p>
    <p class="servise-form__title">Спасибо <br> за обращение!</p>
    <p class="servise-form__des">Мы перезвоним Вам, <br> как только освободится один из специалистов</p>
  </div>
  <div class="servise-form__wrapper">
    <p class="servise-form__title">Нужна помощь? </p>
    <p class="servise-form__des">Заполните заявку. Мы поможем разобраться и подобрать специалиста</p>
    <form action="" method="POST" class="site-inputs services__inputs page-service__inputs">
      <input type="hidden" name="action" value="custom_form_submit">
      <?php wp_nonce_field('custom_form'); ?>
      <input type="text" placeholder="Ваше имя" class="site-input page-service__inputs-input" name="firstname">
      <input type="email" placeholder="Email" class="site-input page-service__inputs-input" name="email">
      <input type="text" placeholder="Ваш номер телефона" class="site-input page-service__inputs-input phone-mask" name="phone">
      <input type="hidden" name="type" value="Консультация">
      <input type="hidden" name="title" value="<?php the_page_title(); ?>">
      <div class="site-checkbox page-service__inputs-checkbox">
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
      <button class="site-button page-service__inputs-button ">Записаться</button>
    </form>
  </div>
</section>