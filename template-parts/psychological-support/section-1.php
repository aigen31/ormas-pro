<div class="psychological-support can-ask-psychological-support">
	<img class="how-work__bird" src="<?php bloginfo('template_directory') ?>/assets/img/general/bird-how-work.svg">
	<div class="container">
		<h2 class="site-title can-ask-for__title">С чем можно обратиться</h2>
		<div class="psychological-support__wrapper">
			<div class="psychological-support__block">
				<img src="<?php bloginfo('template_directory') ?>/assets/img/general/children.svg" alt="img" class="psychological-support__block-img">
				<p class="psychological-support__block-title">С ребенком</p>
				<ul class="psychological-support__block-list">
					<?php
					$children_items = carbon_get_post_meta($post->ID, 'psychological_support_children');
					foreach ($children_items as $item):
					?>
						<li class="psychological-support__block-item">
							<img src="<?php bloginfo('template_directory') ?>/assets/img/general/list-vector.svg" alt="img" class="psychological-support__block-item-img">
							<p class="psychological-support__block-item-text"><?php echo $item['text']; ?></p>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="psychological-support__block psychological-support__block--enrol">
				<p class="psychological-support__block-text">Это лишь примерный перечень запросов. Если вы сомневаетесь, поможет ли психолог именно
					с вашей ситуацией - заполните форму ниже. Наш администратор свяжется с вами и поможет разобраться.</p>
				<button class="psychological-support__block-button site-button">Записаться</button>
			</div>
			<div class="psychological-support__block psychological-support__block--teenager">
				<img src="<?php bloginfo('template_directory') ?>/assets/img/general/teenager.svg" alt="img" class="psychological-support__block-img psychological-support__block-img--teenager">
				<p class="psychological-support__block-title">Подростку</p>
				<ul class="psychological-support__block-list">
					<?php
					$teenagers_items = carbon_get_post_meta($post->ID, 'psychological_support_teenagers');
					foreach ($teenagers_items as $item):
					?>
						<li class="psychological-support__block-item">
							<img src="<?php bloginfo('template_directory') ?>/assets/img/general/list-vector.svg" alt="img" class="psychological-support__block-item-img">
							<p class="psychological-support__block-item-text"><?php echo $item['text']; ?></p>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="psychological-support__block psychological-support__block--parent">
				<img src="<?php bloginfo('template_directory') ?>/assets/img/general/parent.svg" alt="img" class="psychological-support__block-img psychological-support__block-img--parent">
				<p class="psychological-support__block-title">Родителям</p>
				<ul class="psychological-support__block-list">
					<?php
					$parents_items = carbon_get_post_meta($post->ID, 'psychological_support_parents');
					foreach ($parents_items as $item):
					?>
						<li class="psychological-support__block-item">
							<img src="<?php bloginfo('template_directory') ?>/assets/img/general/list-vector.svg" alt="img" class="psychological-support__block-item-img">
							<p class="psychological-support__block-item-text"><?php echo $item['text']; ?></p>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>