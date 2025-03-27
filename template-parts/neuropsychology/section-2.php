<?php
$items = carbon_get_post_meta($post->ID, 'can_ask_for_items');
if (!empty($items)) :
?>
    <div class="can-ask-for">
        <div class="container">
            <h2 class="site-title can-ask-for__title">С чем можно обратиться</h2>
            <ul class="can-ask-for__list">
                <?php
                foreach ($items as $item):
                    $image = get_image_data($item['image'], 'full');
                ?>
                    <li class="can-ask-for__item">
                        <?php if (!empty($item['title'])): ?>
                            <p class="can-ask-for__item-title"><?php echo $item['title']; ?></p>
                        <?php endif;
                        if (!empty($item['content'])): ?>
                            <div class="can-ask-for__item-des"><?php echo $item['content']; ?></div>
                        <?php endif;
                        if (!empty($image['url'])): ?>
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo !empty($image['alt']) ? $image['alt'] : ''; ?>" class="can-ask-for__item-img" loading="lazy">
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>