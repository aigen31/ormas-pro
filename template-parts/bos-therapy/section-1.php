<?php
$paragraph = carbon_get_post_meta($post->ID, 'bos_about_method');
if (!empty($paragraph)) :
?>
    <div class="about_method">
        <div class="container">
            <div class="site-title how-work__title">О методе</div>

            <div class="method_block">
                <div class="method_left">
                    <img class="about_method_image" src="<?php bloginfo('template_directory') ?>/assets/img/general/about_method.png">
                </div>
                <div class="method_right">
                    <p><?php echo $paragraph; ?></p>
                </div>
            </div>
        </div>
        <img class="about_method__bird" src="<?php bloginfo('template_directory') ?>/assets/img/general/bird-how-work.svg">
    </div>
<?php endif;
$advantages = carbon_get_post_meta($post->ID, 'bos_advantages');
if (!empty($advantages)) :
?>
    <div class="bos_advantages">
        <img class="wave-nine" src="<?php bloginfo('template_directory') ?>/assets/img/general/wave-9.svg">

        <div class="container">
            <div class="site-title how-work__title">Основные преимущества БОС-терапии</div>

            <div class="bos_advantages_block">
                <?php
                foreach ($advantages as $advantage): ?>
                    <div class="bos_advantage">
                        <div class="bos_advantage_image"><img src="<?php bloginfo('template_directory') ?>/assets/img/general/mark.svg"></div>
                        <?php if (!empty($advantage['title'])): ?>
                            <div class="bos_advantage_title"><?php echo $advantage['title']; ?></div>
                        <?php endif;
                        if (!empty($advantage['text'])): ?>
                            <div class="bos_advantage_text"><?php echo $advantage['text']; ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<style media="screen">
    .about_method {
        background: #f5f3fb;
        padding: 60px 0;
        position: relative;
    }

    @media screen and (max-width: 1024px) {
        .about_method {
            padding: 40px 0 16px;
        }
    }

    .method_block {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
        gap: 40px;
        background: #fff;
        padding: 10px 70px;
        border-radius: 4px;
    }

    .method_right {
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        gap: 40px;
    }

    .method_right p {
        font-size: 16px;
        line-height: 24px;
        margin: 0;
    }

    img.about_method__bird {
        position: absolute;
        right: 7%;
        z-index: 2;
        bottom: -23%;
    }

    .bos_advantages {
        background: #f5f3fb;
        padding: 60px 0;
        position: relative;
        z-index: 1;
    }

    .bos_advantages .container {
        position: relative;
    }

    .bos_advantages img.wave-nine {
        bottom: 0;
        position: absolute;
        z-index: 0;
        width: 100%;
    }

    .bos_advantages_block {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: stretch;
        gap: 30px;
        margin-top: 70px;
    }

    .bos_advantage {
        padding: 65px 35px 35px;
        position: relative;
        background: #fff;
        width: 33.33%;
    }

    .bos_advantage_image {
        width: max-content;
        position: absolute;
        top: -35px;
        left: 50%;
        transform: translate(-50%, 0);
    }

    .bos_advantage_title {
        font-family: Nunito;
        font-size: 24px;
        font-weight: 700;
        line-height: 32px;
        text-align: center;
        margin-bottom: 40px;
    }

    .bos_advantage_text {
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        text-align: left;
    }

    @media (max-width: 1400px) {
        img.about_method__bird {
            display: none;
        }
    }

    @media screen and (max-width: 1024px) {
        .method_block {
            padding: 20px 35px;
        }
    }

    @media (max-width: 900px) {
        .bos_advantages_block {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            align-items: stretch;
            gap: 65px;
        }

        .bos_advantage {
            padding: 65px 35px 35px;
            position: relative;
            background: #fff;
            width: 100%;
        }

        .bos_advantage_text {
            text-align: center;
        }
    }

    @media (max-width: 768px) {
        .method_block {
            flex-direction: column-reverse;
            flex-wrap: nowrap;
            justify-content: center;
            align-items: center;
        }
    }
</style>