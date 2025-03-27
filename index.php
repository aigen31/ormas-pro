<?php
get_header();

get_template_part('template-parts/about');

get_template_part('template-parts/greeting');

get_template_part('template-parts/services');

get_template_part('template-parts/consultation');

get_template_part('template-parts/useful');

get_template_part('template-parts/party');

get_template_part('template-parts/reviews');

if (is_home()) {
		get_template_part('template-parts/posts');
}

get_template_part('template-parts/certificates');

get_footer();
?>
