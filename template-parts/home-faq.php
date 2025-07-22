<div class="faq-home neuropsychology-page" id="faq">
    <div class="container">
        <div class="faq__wrapper">
            <h2 class="site-title faq__title">Вопрос и ответ</h2>
            <div class="frequent-questions__list">
                <?php
                $main_page_id = get_option('page_for_posts');
                $faq_items = carbon_get_post_meta($main_page_id, 'service_faq');
                if (!empty($faq_items)) :
                    foreach ($faq_items as $item) :
                ?>
                        <li class="frequent-questions__item">
                            <details class="frequent-questions__details">
                                <summary class="frequent-questions__summary">
                                    <p class="frequent-questions__summary-name"><?php echo esc_html($item['question']); ?></p>
                                    <p class="frequent-questions__summary-cross"></p>
                                </summary>
                                <div class="frequent-questions__details-text"><?php echo $item['answer']; ?></div>
                            </details>
                        </li>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
</div>