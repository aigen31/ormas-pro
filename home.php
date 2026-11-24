<?php
get_header();

ormas_medical_organization_schema();

?>
<div class="v8-hero-band">
<?php
get_template_part('template-parts/v8/hero');

get_template_part('template-parts/v8/advantages');
?>
</div>
<?php

get_template_part('template-parts/services');

get_template_part('template-parts/consultation');

get_template_part('template-parts/useful');

get_template_part('template-parts/party');

get_template_part('template-parts/reviews');

if (is_home()) {
	get_template_part('template-parts/posts');
}

get_template_part('template-parts/certificates');

get_template_part('template-parts/home-faq');

get_footer();
