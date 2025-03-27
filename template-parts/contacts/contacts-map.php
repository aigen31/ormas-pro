<div class="contacts_map">
	<img class="wave-nine" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-9.svg">

	<div class="container">
		<div class="site-title how-work__title">Как нас найти</div>

		<div class="contacts_item">
			<div class="contacts_icon"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/metro_icon.svg" alt=""></div>
			<?php $options_address = carbon_get_theme_option('options_address'); ?>
			<?php if (!empty($options_address)): ?>
				<span><b><?php echo $options_address; ?></b></span>
			<?php endif; ?>
		</div>

		<div class="contacts_banner_wrapper">
			<div class="contacts_left">
				<?php $options_map_description = carbon_get_theme_option('options_map_description'); ?>
				<?php if (!empty($options_map_description)): ?>
					<?php echo $options_map_description; ?>
				<?php endif; ?>
			</div>

			<div class="contacts_right">
				<?php $options_map_script = carbon_get_theme_option('options_map_script'); ?>
				<?php if (!empty($options_map_script)): ?>
					<?php echo $options_map_script; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<div class="contacts_reqs">
	<div class="container">
		<div class="site-title small_title sm_center">Реквизиты</div>

		<div class="contacts_wrapper">
			<div class="contacts_left">
				<?php $ip_info = carbon_get_theme_option('ip_info'); ?>
				<?php if (!empty($ip_info)): ?>
					<p><?php echo $ip_info; ?></p>
				<?php endif; ?>
				<?php $inn_info = carbon_get_theme_option('inn_info'); ?>
				<?php if (!empty($inn_info)): ?>
					<p><?php echo $inn_info; ?></p>
				<?php endif; ?>
				<?php $ogrnip_info = carbon_get_theme_option('ogrnip_info'); ?>
				<?php if (!empty($ogrnip_info)): ?>
					<p><?php echo $ogrnip_info; ?></p>
				<?php endif; ?>
			</div>

			<div class="contacts_right">
				<?php $options_bank_account = carbon_get_theme_option('options_bank_account'); ?>
				<?php if (!empty($options_bank_account)): ?>
					<p><?php echo $options_bank_account; ?></p>
				<?php endif; ?>
				<?php $options_bank_name = carbon_get_theme_option('options_bank_name'); ?>
				<?php if (!empty($options_bank_name)): ?>
					<p><?php echo $options_bank_name; ?></p>
				<?php endif; ?>
				<?php $options_correspondent_account = carbon_get_theme_option('options_correspondent_account'); ?>
				<?php if (!empty($options_correspondent_account)): ?>
					<p><?php echo $options_correspondent_account; ?></p>
				<?php endif; ?>
				<?php $options_bik = carbon_get_theme_option('options_bik'); ?>
				<?php if (!empty($options_bik)): ?>
					<p><?php echo $options_bik; ?></p>
				<?php endif; ?>
			</div>
		</div>

		<div class="site-title small_title half_title">Подписывайтесь на наши социальные сети:</div>
		<div class="contacts_socials">
			<?php $options_vk = carbon_get_theme_option('options_vk'); ?>
			<?php if (!empty($options_vk)): ?>
				<a href="<?php echo $options_vk; ?>">
					<img src="<?php bloginfo('template_directory') ?>/assets/img/general/logos_vk.svg" alt="VK">
				</a>
			<?php endif; ?>

			<?php $options_telegram = carbon_get_theme_option('options_telegram'); ?>
			<?php if (!empty($options_telegram)): ?>
				<a href="<?php echo $options_telegram; ?>">
					<img src="<?php bloginfo('template_directory') ?>/assets/img/general/logos_telegram.svg" alt="Telegram">
				</a>
			<?php endif; ?>

			<?php $options_dzen = carbon_get_theme_option('options_dzen'); ?>
			<?php if (!empty($options_dzen)): ?>
				<a href="<?php echo $options_dzen; ?>">
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