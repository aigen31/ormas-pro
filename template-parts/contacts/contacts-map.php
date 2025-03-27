<div class="contacts_map">
	<img class="wave-nine" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-9.svg">

	<div class="container">
		<div class="site-title how-work__title">Как нас найти</div>

		<div class="contacts_item">
			<div class="contacts_icon">
				<img src="<?php bloginfo('template_directory') ?>/assets/img/general/metro_icon.svg" alt="">
			</div>
			<span><b>Станция метро «Раменки», выход № 7.</b></span>
		</div>

		<div class="contacts_banner_wrapper">
			<div class="contacts_left">
				<?php
				$map_description = carbon_get_theme_option('options_map_description');
				if (!empty($map_description)) :
					echo $map_description;
				endif;
				?>
			</div>

			<div class="contacts_right">
				<?php
				$map_script = carbon_get_theme_option('options_map_script');
				if (!empty($map_script)) :
				?>
					<script type="text/javascript" charset="utf-8" async src="<?php echo $map_script; ?>"></script>
				<?php
				endif;
				?>
			</div>
		</div>
	</div>
</div>

<div class="contacts_reqs">
	<div class="container">
		<div class="site-title small_title sm_center">Реквизиты</div>

		<div class="contacts_wrapper">
			<div class="contacts_left">
				<?php
				$ip_info = carbon_get_theme_option('ip_info');
				if (!empty($ip_info)) :
				?>
					<p><?php echo $ip_info; ?></p>
				<?php
				endif;

				$inn_info = carbon_get_theme_option('inn_info');
				if (!empty($inn_info)) :
				?>
					<p><?php echo $inn_info; ?></p>
				<?php
				endif;

				$ogrnip_info = carbon_get_theme_option('ogrnip_info');
				if (!empty($ogrnip_info)) :
				?>
					<p><?php echo $ogrnip_info; ?></p>
				<?php
				endif;
				?>
			</div>

			<div class="contacts_right">
				<?php
				$bank_account = carbon_get_theme_option('options_bank_account');
				if (!empty($bank_account)) :
				?>
					<p><?php echo $bank_account; ?></p>
				<?php
				endif;

				$bank_name = carbon_get_theme_option('options_bank_name');
				if (!empty($bank_name)) :
				?>
					<p><?php echo $bank_name; ?></p>
				<?php
				endif;

				$correspondent_account = carbon_get_theme_option('options_correspondent_account');
				if (!empty($correspondent_account)) :
				?>
					<p><?php echo $correspondent_account; ?></p>
				<?php
				endif;

				$bik = carbon_get_theme_option('options_bik');
				if (!empty($bik)) :
				?>
					<p><?php echo $bik; ?></p>
				<?php
				endif;
				?>
			</div>
		</div>

		<div class="site-title small_title half_title">Подписывайтесь на наши социальные сети:</div>
		<div class="contacts_socials">
			<?php
			$vk = carbon_get_theme_option('options_vk');
			if (!empty($vk)) :
			?>
				<a href="<?php echo $vk; ?>">
					<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/general/logos_vk.svg" alt="">
				</a>
			<?php
			endif;

			$telegram = carbon_get_theme_option('options_telegram');
			if (!empty($telegram)) :
			?>
				<a href="<?php echo $telegram; ?>">
					<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/general/logos_telegram.svg" alt="">
				</a>
			<?php
			endif;

			$dzen = carbon_get_theme_option('options_dzen');
			if (!empty($dzen)) :
			?>
				<a href="<?php echo $dzen; ?>">
					<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/img/general/logos_dzen.svg" alt="">
				</a>
			<?php
			endif;
			?>
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