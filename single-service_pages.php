<?php
get_header();
switch ($post->post_name) {
  case 'neuropsychology':
    get_template_part('templates/neuropsychology');
    break;
  case 'psychological-support':
    get_template_part('templates/psychological-support');
    break;
  case 'logoped-defektolog':
    get_template_part('templates/speech');
    break;
  case 'bos-therapy':
    get_template_part('templates/bos-therapy');
    break;
  case 'nejrokorrekcziya':
    get_template_part('templates/neurocorrecrion');
    break;
  case 'nejropsihologicheskaya-diagnostika':
    get_template_part('templates/neuro-diagnostic');
    break;
  case 'our-services':
    get_template_part('templates/our-services');
    break;
  case 'launch-speech':
    get_template_part('templates/launch-speech');
    break;
  default:
    break;
}
get_footer(); ?>