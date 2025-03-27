<div class="contacts_map">
	<img class="wave-nine" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-9.svg">

	<div class="container">
		<div class="site-title how-work__title">Как нас найти</div>

		<div class="contacts_item">
			<div class="contacts_icon"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/metro_icon.svg" alt=""></div>
			<span><b><?php echo carbon_get_theme_option('options_address'); ?></b></span>
		</div>

		<div class="contacts_banner_wrapper">
			<div class="contacts_left">
				<?php echo carbon_get_theme_option('options_map_description'); ?>
			</div>

			<div class="contacts_right">
				<?php echo carbon_get_theme_option('options_map_script'); ?>
			</div>
		</div>
	</div>
</div>

<div class="contacts_reqs">
	<div class="container">
		<div class="site-title small_title sm_center">Реквизиты</div>

		<div class="contacts_wrapper">
			<div class="contacts_left">
				<p><?php echo carbon_get_theme_option('ip_info'); ?></p>
				<p><?php echo carbon_get_theme_option('inn_info'); ?></p>
				<p><?php echo carbon_get_theme_option('ogrnip_info'); ?></p>
			</div>

			<div class="contacts_right">
				<p><?php echo carbon_get_theme_option('options_bank_account'); ?></p>
				<p><?php echo carbon_get_theme_option('options_bank_name'); ?></p>
				<p><?php echo carbon_get_theme_option('options_correspondent_account'); ?></p>
				<p><?php echo carbon_get_theme_option('options_bik'); ?></p>
			</div>
		</div>

		<div class="site-title small_title half_title">Подписывайтесь на наши социальные сети:</div>
		<div class="contacts_socials">
			<?php if (carbon_get_theme_option('options_vk')): ?>
				<a href="<?php echo carbon_get_theme_option('options_vk'); ?>">
					<img src="<?php bloginfo('template_directory') ?>/assets/img/general/logos_vk.svg" alt="VK">
				</a>
			<?php endif; ?>

			<?php if (carbon_get_theme_option('options_telegram')): ?>
				<a href="<?php echo carbon_get_theme_option('options_telegram'); ?>">
					<img src="<?php bloginfo('template_directory') ?>/assets/img/general/logos_telegram.svg" alt="Telegram">
				</a>
			<?php endif; ?>

			<?php if (carbon_get_theme_option('options_dzen')): ?>
				<a href="<?php echo carbon_get_theme_option('options_dzen'); ?>">
					<img src="<?php bloginfo('template_directory') ?>/assets/img/general/logos_dzen.svg" alt="Дзен">
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>

<style media="screen">
	.contacts_map {
		background: #f5f3fb;
		padding: 60px 0;
		position: relative;
		z-index: 1;
	}

	.contacts_map img.wave-nine {
		position: absolute;
		z-index: -1;
		width: 100%;
		bottom: 0;
	}

	.contacts_map .contacts_item {
		margin-bottom: 20px;
	}

	.contacts_map .contacts_banner_wrapper {
		gap: 35px;
		align-items: stretch;
	}

	.contacts_map .contacts_left {
		padding: 25px;
		font-size: 16px;
		font-weight: 400;
		line-height: 24px;
		text-align: left;
		background: #fff;
	}

	.site-title.small_title {
		font-size: 24px;
		font-weight: 700;
		line-height: 32px;
		text-align: left;
		margin-bottom: 23px;
	}

	.contacts_reqs {
		background: #fde8d8;
		padding-bottom: 60px;
	}

	.contacts_reqs .contacts_wrapper {
		display: flex;
		flex-direction: row;
		flex-wrap: nowrap;
		gap: 35px;
		margin-bottom: 60px;
	}

	.contacts_reqs p {
		margin: 0;
		font-size: 18px;
		font-weight: 400;
		line-height: 26px;
		text-align: left;
	}

	.contacts_wrapper .contacts_left {
		gap: 0;
	}

	.contacts_socials {
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		gap: 25px;
	}

	.half_title {
		width: 40%;
	}

	@media (max-width: 820px) {
		.contacts_map .contacts_right {
			height: 300px;
		}

		.half_title {
			width: 100%;
		}
	}

	@media (max-width: 480px) {
		.contacts_map .contacts_right {
			height: 250px;
		}

		.contacts_reqs .contacts_wrapper {
			flex-direction: column;
			margin-top: 40px;
		}

		.sm_center {
			text-align: center !important;
		}
	}
</style>

<style media="screen">
	.contacts_map {
		background: #f5f3fb;
		padding: 60px 0;
		position: relative;
		z-index: 1;
	}

	.contacts_map img.wave-nine {
		position: absolute;
		z-index: -1;
		width: 100%;
		bottom: 0;
	}

	.contacts_map .contacts_item {
		margin-bottom: 20px;
	}

	.contacts_map .contacts_banner_wrapper {
		gap: 35px;
		align-items: stretch;
	}

	.contacts_map .contacts_left {
		padding: 25px;
		font-size: 16px;
		font-weight: 400;
		line-height: 24px;
		text-align: left;
		background: #fff;
	}

	.site-title.small_title {
		font-size: 24px;
		font-weight: 700;
		line-height: 32px;
		text-align: left;
		margin-bottom: 23px;
	}

	.contacts_reqs {
		background: #fde8d8;
		padding-bottom: 60px;
	}

	.contacts_reqs .contacts_wrapper {
		display: flex;
		flex-direction: row;
		flex-wrap: nowrap;
		gap: 35px;
		margin-bottom: 60px;
	}

	.contacts_reqs p {
		margin: 0;
		font-size: 18px;
		font-weight: 400;
		line-height: 26px;
		text-align: left;
	}

	.contacts_wrapper .contacts_left {
		gap: 0;
	}

	.contacts_socials {
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		gap: 25px;
	}

	.half_title {
		width: 40%;
	}

	@media (max-width: 820px) {
		.contacts_map .contacts_right {
			height: 300px;
		}

		.half_title {
			width: 100%;
		}
	}

	@media (max-width: 480px) {
		.contacts_map .contacts_right {
			height: 250px;
		}

		.contacts_reqs .contacts_wrapper {
			flex-direction: column;
			margin-top: 40px;
		}

		.sm_center {
			text-align: center !important;
		}
	}
</style>

<style media="screen">
	.contacts_map {
		background: #f5f3fb;
		padding: 60px 0;
		position: relative;
		z-index: 1;
	}

	.contacts_map img.wave-nine {
		position: absolute;
		z-index: -1;
		width: 100%;
		bottom: 0;
	}

	.contacts_map .contacts_item {
		margin-bottom: 20px;
	}

	.contacts_map .contacts_banner_wrapper {
		gap: 35px;
		align-items: stretch;
	}

	.contacts_map .contacts_left {
		padding: 25px;
		font-size: 16px;
		font-weight: 400;
		line-height: 24px;
		text-align: left;
		background: #fff;
	}

	.site-title.small_title {
		font-size: 24px;
		font-weight: 700;
		line-height: 32px;
		text-align: left;
		margin-bottom: 23px;
	}

	.contacts_reqs {
		background: #fde8d8;
		padding-bottom: 60px;
	}

	.contacts_reqs .contacts_wrapper {
		display: flex;
		flex-direction: row;
		flex-wrap: nowrap;
		gap: 35px;
		margin-bottom: 60px;
	}

	.contacts_reqs p {
		margin: 0;
		font-size: 18px;
		font-weight: 400;
		line-height: 26px;
		text-align: left;
	}

	.contacts_wrapper .contacts_left {
		gap: 0;
	}

	.contacts_socials {
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		gap: 25px;
	}

	.half_title {
		width: 40%;
	}

	@media (max-width: 820px) {
		.contacts_map .contacts_right {
			height: 300px;
		}

		.half_title {
			width: 100%;
		}
	}

	@media (max-width: 480px) {
		.contacts_map .contacts_right {
			height: 250px;
		}

		.contacts_reqs .contacts_wrapper {
			flex-direction: column;
			margin-top: 40px;
		}

		.sm_center {
			text-align: center !important;
		}
	}
</style>

<style media="screen">
	.contacts_map {
		background: #f5f3fb;
		padding: 60px 0;
		position: relative;
		z-index: 1;
	}

	.contacts_map img.wave-nine {
		position: absolute;
		z-index: -1;
		width: 100%;
		bottom: 0;
	}

	.contacts_map .contacts_item {
		margin-bottom: 20px;
	}

	.contacts_map .contacts_banner_wrapper {
		gap: 35px;
		align-items: stretch;
	}

	.contacts_map .contacts_left {
		padding: 25px;
		font-size: 16px;
		font-weight: 400;
		line-height: 24px;
		text-align: left;
		background: #fff;
	}

	.site-title.small_title {
		font-size: 24px;
		font-weight: 700;
		line-height: 32px;
		text-align: left;
		margin-bottom: 23px;
	}

	.contacts_reqs {
		background: #fde8d8;
		padding-bottom: 60px;
	}

	.contacts_reqs .contacts_wrapper {
		display: flex;
		flex-direction: row;
		flex-wrap: nowrap;
		gap: 35px;
		margin-bottom: 60px;
	}

	.contacts_reqs p {
		margin: 0;
		font-size: 18px;
		font-weight: 400;
		line-height: 26px;
		text-align: left;
	}

	.contacts_wrapper .contacts_left {
		gap: 0;
	}

	.contacts_socials {
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		gap: 25px;
	}

	.half_title {
		width: 40%;
	}

	@media (max-width: 820px) {
		.contacts_map .contacts_right {
			height: 300px;
		}

		.half_title {
			width: 100%;
		}
	}

	@media (max-width: 480px) {
		.contacts_map .contacts_right {
			height: 250px;
		}

		.contacts_reqs .contacts_wrapper {
			flex-direction: column;
			margin-top: 40px;
		}

		.sm_center {
			text-align: center !important;
		}
	}
</style>

<style media="screen">
	.contacts_map {
		background: #f5f3fb;
		padding: 60px 0;
		position: relative;
		z-index: 1;
	}

	.contacts_map img.wave-nine {
		position: absolute;
		z-index: -1;
		width: 100%;
		bottom: 0;
	}

	.contacts_map .contacts_item {
		margin-bottom: 20px;
	}

	.contacts_map .contacts_banner_wrapper {
		gap: 35px;
		align-items: stretch;
	}

	.contacts_map .contacts_left {
		padding: 25px;
		font-size: 16px;
		font-weight: 400;
		line-height: 24px;
		text-align: left;
		background: #fff;
	}

	.site-title.small_title {
		font-size: 24px;
		font-weight: 700;
		line-height: 32px;
		text-align: left;
		margin-bottom: 23px;
	}

	.contacts_reqs {
		background: #fde8d8;
		padding-bottom: 60px;
	}

	.contacts_reqs .contacts_wrapper {
		display: flex;
		flex-direction: row;
		flex-wrap: nowrap;
		gap: 35px;
		margin-bottom: 60px;
	}

	.contacts_reqs p {
		margin: 0;
		font-size: 18px;
		font-weight: 400;
		line-height: 26px;
		text-align: left;
	}

	.contacts_wrapper .contacts_left {
		gap: 0;
	}

	.contacts_socials {
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		gap: 25px;
	}

	.half_title {
		width: 40%;
	}

	@media (max-width: 820px) {
		.contacts_map .contacts_right {
			height: 300px;
		}

		.half_title {
			width: 100%;
		}
	}

	@media (max-width: 480px) {
		.contacts_map .contacts_right {
			height: 250px;
		}

		.contacts_reqs .contacts_wrapper {
			flex-direction: column;
			margin-top: 40px;
		}

		.sm_center {
			text-align: center !important;
		}
	}
</style>