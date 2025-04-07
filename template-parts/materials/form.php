<section class="materials-form">
	<img class="wave-six" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-6.png">
	<div class="container">
		<div class="materials-form__wrapper">
			<div class="materials-form__item">
				<p class="materials-form__title">Мы будем благодарны Вам за обратную связь и предложения.</p>
				<p class="materials-form__des">
					Понравились ли Вам наши материалы? <br>
					Какими из них Вы пользуетесь? <br>
					Всё ли оказалось понятным? <br>
					Ваши впечатления, пожелания и предложения мы будем учитывать при составлении новых материалов для Вас и Ваших детей!
				</p>
			</div>
			<div class="materials-form__item">
				<div class="footer__popup poopup hidden">
					<svg style="cursor: pointer;" class="footer__popup-svg" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path clip-rule="evenodd" d="M7.29289 8.6957L10.6194 12L7.29289 15.3043C6.90237 15.6922 6.90237 16.3212 7.29289 16.7091C7.68342 17.097 8.31658 17.097 8.70711 16.7091L12 13.4382L15.2929 16.7091C15.6834 17.097 16.3166 17.097 16.7071 16.7091C17.0976 16.3212 17.0976 15.6922 16.7071 15.3043L13.3806 12L16.7071 8.6957C17.0976 8.30778 17.0976 7.67885 16.7071 7.29094C16.3166 6.90302 15.6834 6.90302 15.2929 7.29094L12 10.5618L8.70711 7.29094C8.31658 6.90302 7.68342 6.90302 7.29289 7.29094C6.90237 7.67885 6.90237 8.30778 7.29289 8.6957Z" />
					</svg>
					<div class="poopup__title">Спасибо за обращение!</div>
					<div class="poopup__description">Наш администратор вскоре с Вами свяжется!</div>
				</div>
				<div class="footer__top-line-column-title">Остались вопросы?</div>
				<form method="POST" class="site-inputs footer__top-line-column-inputs-material">
					<input type="text" placeholder="Ваше имя" class="site-input footer__top-line-column-inputs-input" name="firstname">
					<input type="email" placeholder="Email" class="site-input footer__top-line-column-inputs-input" name="email">
					<textarea type="textarea" placeholder="Коментрарий" class="site-input footer__top-line-column-inputs-textarea" name="text"></textarea>
					<input type="hidden" name="type" value="Вопрос">
					<input type="hidden" name="title" value="<?php the_page_title(); ?>">
					<button class="site-button footer__top-line-column-inputs-button">Отправить</button>
					<div class="site-checkbox footer__top-line-column-inputs-checkbox">
						<label>
							<input type="checkbox">
							<div class="site-checkbox__checkbox">
								<svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1.41 3L4 5.58L9.59 0L11 1.41L4 8.41L0 4.41L1.41 3Z" fill="#fff"></path>
								</svg>
							</div>
							<div class="site__checkbox-text">
								Согласие с условиями обработки <a href="/agreement/">персональных данных</a>
							</div>
						</label>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>