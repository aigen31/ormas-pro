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
				<h1 class="about__left-title-item">Контакты</h1>
			</div>
		</div>

		<div class="contacts_banner_wrapper">
			<div class="contacts_left">
				<div class="contacts_item">
					<div class="contacts_icon"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/clock_icon.svg" alt=""></div>
					<span><b>Часы работы центра:</b> <?php echo carbon_get_theme_option('options_work_hours'); ?></span>
				</div>

				<div class="contacts_item">
					<div class="contacts_icon"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/phone_icon.svg" alt=""></div>
					<span><b>Тел.:</b> <a href="tel:<?php echo carbon_get_theme_option('options_number'); ?>"><?php echo carbon_get_theme_option('options_number'); ?></a></span>
				</div>

				<div class="contacts_item">
					<div class="contacts_icon"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/whatsapp_icon.svg" alt=""></div>
					<span><b>WhatsApp:</b> <a href="https://api.whatsapp.com/send/?phone=<?php echo carbon_get_theme_option('options_whatsapp'); ?>"><?php echo carbon_get_theme_option('options_whatsapp'); ?></a></span>
				</div>

				<div class="contacts_item">
					<div class="contacts_icon"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/email_icon.svg" alt=""></div>
					<span><b>Email:</b> <a href="mailto:<?php echo carbon_get_theme_option('options_email'); ?>"><?php echo carbon_get_theme_option('options_email'); ?></a></span>
				</div>

				<div class="contacts_item">
					<div class="contacts_icon"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/map_icon.svg" alt=""></div>
					<span><b>Адрес:</b> <?php echo carbon_get_theme_option('options_address'); ?></span>
				</div>
			</div>
			<div class="contacts_right">
				<div class="banner_form">
					<div class="banner__popup poopup hidden">
						<svg style="cursor: pointer;" class="banner__popup-svg" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path clip-rule="evenodd" d="M7.29289 8.6957L10.6194 12L7.29289 15.3043C6.90237 15.6922 6.90237 16.3212 7.29289 16.7091C7.68342 17.097 8.31658 17.097 8.70711 16.7091L12 13.4382L15.2929 16.7091C15.6834 17.097 16.3166 17.097 16.7071 16.7091C17.0976 16.3212 17.0976 15.6922 16.7071 15.3043L13.3806 12L16.7071 8.6957C17.0976 8.30778 17.0976 7.67885 16.7071 7.29094C16.3166 6.90302 15.6834 6.90302 15.2929 7.29094L12 10.5618L8.70711 7.29094C8.31658 6.90302 7.68342 6.90302 7.29289 7.29094C6.90237 7.67885 6.90237 8.30778 7.29289 8.6957Z"></path>
						</svg>
						<div class="poopup__title">Спасибо за обращение!</div>
						<div class="poopup__description">Наш администратор вскоре с Вами свяжется!</div>
					</div>

					<div class="banner_form_title">
						Записаться на консультацию
					</div>
					<form action="" method="POST" class="site-inputs">
						<input type="text" placeholder="Ваше имя" class="site-input" name="firstname">
						<input type="email" placeholder="Email" class="site-input" name="email">
						<input type="text" placeholder="Ваш номер телефона" class="site-input" id="phone-mask2" name="phone">
						<input type="hidden" value="6" name="type">
						<div class="site-checkbox">
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
						<button class="site-button send_banner_form">Записаться</button>
						<a href="https://api.whatsapp.com/send/?phone=79266699546" class="whatsapp_button"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/whatsapp_white.svg" alt=""><span>Написать в WhatsApp</span></a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<style media="screen">
	.neuropsychology-page.contacts_page div.about {
		height: auto;
	}

	.contacts_page div.about__left {
		height: auto;
	}

	.neuropsychology-page.contacts_page .about div.container {
		display: block;
	}

	.contacts_banner_wrapper {
	    display: flex;
	    flex-direction: row;
	    flex-wrap: nowrap;
	    gap: 80px;
	    align-items: center;
	}

	.contacts_left {
	    display: flex;
	    flex-direction: column;
	    width: 50%;
	    gap: 20px;
	}

	.contacts_right {
	    width: 50%;
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

	.banner_form {
	    background: #2E1464;
	    padding: 30px 55px;
	    border-radius: 10px;
	}

	.banner_form form.site-inputs {
	    display: flex;
	    flex-direction: column;
	    gap: 25px;
	}

	.banner_form input.site-input {
	    width: 100%;
	    padding: 15px 25px;
	}

	.banner_form .site-checkbox .site__checkbox-text {
	    color: #fff;
	}

	.banner_form .site-checkbox {
		width: 100%!important;
	}

	.banner_form .site-checkbox a {
	    color: #fff;
	}

	.banner_form button.site-button {
	    margin: 0;
	    padding: 20px 10px;
	    min-height: 65px;
	}

	.banner_form_title {
		font-size: 24px;
		font-weight: 700;
		line-height: 32px;
		text-align: center;
		color: #fff;
		margin-bottom: 30px;
	}

	.whatsapp_button span {
	    color: #fff;
	    font-size: 16px;
	    font-weight: 800;
	    text-align: left;
	    width: max-content;
		text-decoration: none;
	}

	.whatsapp_button {
	    background: #48BA0A;
	    border: none;
	    border-radius: 4px;
	    color: #fff;
	    cursor: pointer;
	    font-family: Nunito;
	    font-weight: 800;
	    letter-spacing: .1em;
	    outline: none;
	    text-align: center;
	    text-transform: uppercase;
	    -webkit-transition: all .2s ease;
	    transition: all .2s ease;
	    padding: 20px 10px;
	    display: flex;
	    align-items: center;
	    justify-content: center;
	    flex-direction: row;
	    gap: 15px;
	    min-height: 65px;
		text-decoration: none;
	}

	.banner__popup.poopup:not(.hidden) {
	    background: #fff;
	    z-index: 111;
	    height: max-content;
	    position: fixed;
	    width: max-content;
	    top: 50%;
	    left: 50%;
	    transform: translate(-50%, -50%);
	}

	.banner__popup-svg {
		cursor: pointer;
		fill: #2e1464;
		position: absolute;
		top: 10px;
		right: 15px;
	}

	@media (max-width: 1024px) {
		.whatsapp_button span {
			font-size: 14px;
		}
	}

	@media (max-width: 820px) {
		.contacts_banner_wrapper {
		    flex-direction: column;
			margin-top: 40px;
		}

		.contacts_left, .contacts_right {
		    width: 100%;
		}
	}

	@media screen and (max-width: 600px) {
	    h1.about__left-title-item {
	        font-size: 36px;
	    }
	}

	@media (max-width: 480px) {
		.banner_form {
		    padding: 20px 15px;
		}
	}
</style>
<script>
	$(document).ready(function () {
		$('.banner_form .site-inputs').submit(function( event ) {
		  let error = 0;
		  let checked = false;

		  $('.banner_form .site-input').each(function() {
		      if($(this).val().length == 0) {
		          $(this).addClass('error')
		          error++
		      } else {
		          $(this).removeClass('error')
		      }
		  })

		  if($('.banner_form .site-checkbox input').prop('checked') == false) {
		      $('.banner_form .site-checkbox').addClass('error')
		      checked = false
		  } else {
		      $('.banner_form .site-checkbox').removeClass('error')
		      checked = true
		  }

		  if(error == 0 && checked) {
		    let formData = $(this).serialize()
		      $('.banner_form .site-input').each(function() {
		          $(this).val('')
		      })
		      $('.banner_form .site-checkbox input').prop('checked', false)
		      $('.banner__popup').removeClass('hidden')
			  setTimeout(function () {
				  $('.banner__popup').addClass('hidden');
			  }, 5000);
		      // console.log( formData)
		      $.ajax({
		          type: 'POST',
		          url: `/wp-content/themes/ormas/request_contacts.php`,
		          data: formData
		    })
		  }
		  event.preventDefault()

			$(document).click(function (e){
				var div = $('.banner__popup')
				var divsvg = $('.banner__popup .banner__popup-svg')

				if (!div.is(e.target)
				&& div.has(e.target).length === 0 || divsvg.is(e.target)) {
					div.addClass('hidden')
				}
			});
		})
	});
</script>
