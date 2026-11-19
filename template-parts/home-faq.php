<?php
$main_page_id = get_option('page_for_posts');
$faq_items = carbon_get_post_meta($main_page_id, 'service_faq');
$faq_schema_entities = [];

if (!empty($faq_items)) {
    foreach ($faq_items as $item) {
        $question = trim(wp_strip_all_tags((string) ($item['question'] ?? '')));
        $answer = trim(wp_strip_all_tags((string) ($item['answer'] ?? '')));

        if ($question === '' || $answer === '') {
            continue;
        }

        $faq_schema_entities[] = [
            '@type' => 'Question',
            'name' => $question,
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $answer,
            ],
        ];
    }
}

if (!empty($faq_schema_entities)) {
    $faq_schema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        '@id' => home_url('/#faq'),
        'mainEntity' => $faq_schema_entities,
    ];

    echo '<script type="application/ld+json">' . wp_json_encode($faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
?>
<div class="faq-home neuropsychology-page" id="faq">
    <div class="container">
        <div class="faq__wrapper">
            <h2 class="site-title faq__title">Вопрос и ответ</h2>
            <div class="frequent-questions__list">
                <?php
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
