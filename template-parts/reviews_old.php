<div class="reviews inwork" id="reviews">
    <div class="container">
        <h2 class="site-title reviews__title">Отзывы</h2>
        <div class="reviews__list">
            <?php
            $main_page_id = get_option('page_for_posts');
            $reviews = carbon_get_post_meta($main_page_id, 'reviews_list');
            foreach ($reviews as $review) :
                $image_id = $review['review_image'];
                $image_thumb = get_image_data($image_id, 'thumbnail');
                $image_large = get_image_data($image_id, 'large');
            ?>
                <div class="reviews__list-item" style="width: 100%; display: inline-block;">
                    <div class="reviews__list-item-image hidden">
                        <div class="white-background"></div>
                        <?php if (!empty($review['review_image'])) : ?>
                            <a class="image-popup-vertical-fit" tabindex="0" href="<?php echo $image_large['url']; ?>">
                                <img src="<?php echo $image_thumb['url']; ?>" alt="">
                            </a>
                        <?php endif; ?>
                        <svg class="icon__eye" width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5464 4.27823C18.2917 1.62713 15.445 0 12 0C8.55501 0 5.70827 1.62713 3.45364 4.27823C2.13714 5.82623 1.28881 7.36654 0.857719 8.44183L0.634097 8.99963L0.857461 9.55753C1.28803 10.633 2.13576 12.1734 3.45197 13.7216C5.70601 16.3728 8.55326 18 12 18C15.4467 18 18.294 16.3728 20.548 13.7216C21.8642 12.1734 22.712 10.633 23.1425 9.55753L23.3659 8.99963L23.1423 8.44183C22.7112 7.36654 21.8629 5.82623 20.5464 4.27823ZM18.2611 6.22177C18.8886 6.95963 19.4227 7.75613 19.8609 8.55176C19.9515 8.71619 20.0306 8.86656 20.0983 9.00033C20.0307 9.13404 19.9517 9.28435 19.8612 9.44869C19.4234 10.2442 18.8897 11.0406 18.2624 11.7784C16.5312 13.8147 14.4571 15 12 15C9.54289 15 7.46879 13.8147 5.73759 11.7784C5.11035 11.0406 4.57655 10.2442 4.13876 9.44869C4.04832 9.28435 3.96933 9.13404 3.90174 9.00033C3.96942 8.86656 4.04852 8.71619 4.13908 8.55176C4.57728 7.75613 5.11143 6.95963 5.73895 6.22177C7.4708 4.18537 9.54467 3 12 3C14.4553 3 16.5292 4.18537 18.2611 6.22177ZM12 13.5C9.51472 13.5 7.5 11.4853 7.5 9C7.5 6.51472 9.51472 4.5 12 4.5C14.4853 4.5 16.5 6.51472 16.5 9C16.5 11.4853 14.4853 13.5 12 13.5ZM13.5 9C13.5 9.82843 12.8284 10.5 12 10.5C11.1716 10.5 10.5 9.82843 10.5 9C10.5 8.17157 11.1716 7.5 12 7.5C12.8284 7.5 13.5 8.17157 13.5 9Z" fill="#FC5130" />
                        </svg>
                    </div>
                    <div class="reviews__list-item-text">
                        <img src="<?php echo !$review['review_avatar'] ? get_template_directory_uri() . '/assets/img/general/people.svg' : ''; ?>" loading="lazy">
                        <div class="reviews__list-item-text-name">
                            <svg width="26" height="16" viewBox="0 0 26 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.17592 15.7802C6.97754 15.7802 6.78096 15.7152 6.61685 15.5872L0.342655 10.6277C0.126241 10.4546 0 10.1949 0 9.91896V0.901724C0 0.405776 0.403972 0 0.901724 0H9.91896C10.4167 0 10.8207 0.405776 10.8207 0.901724V9.91896C10.8207 10.4149 10.4167 10.8207 9.91896 10.8207H6.68899L8.02714 14.5755C8.1624 14.9542 8.02895 15.3762 7.70252 15.6106C7.54743 15.7243 7.36348 15.7802 7.17592 15.7802Z" fill="#FC5130" />
                                <path d="M22.3552 15.7802C22.1569 15.7802 21.9603 15.7152 21.7962 15.5872L15.522 10.6277C15.3056 10.4546 15.1793 10.1949 15.1793 9.91896V0.901724C15.1793 0.405776 15.5833 0 16.081 0H25.0983C25.596 0 26 0.405776 26 0.901724V9.91896C26 10.4149 25.596 10.8207 25.0983 10.8207H21.8683L23.2065 14.5755C23.3417 14.9542 23.2083 15.3762 22.8818 15.6106C22.7267 15.7243 22.5428 15.7802 22.3552 15.7802Z" fill="#FC5130" />
                            </svg>
                            <br>
                            <span><?php echo $review['review_name']; ?></span>
                            <br>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="slick-arrows">
            <div class="slick-prev"></div>
            <div class="slick-next"></div>
        </div>
    </div>
</div>