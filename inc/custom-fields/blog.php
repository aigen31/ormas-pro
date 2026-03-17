<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function get_team_members_for_select() {
    $specialists = [];
    $team_members = get_posts([
        'post_type' => 'team',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC'
    ]);

    foreach ($team_members as $member) {
        $specialists[$member->ID] = get_the_title($member->ID);
    }
    
    return $specialists;
}

Container::make('post_meta', 'Автор статьи')
    ->where('post_type', '=', 'post')
    ->add_fields([
        Field::make('select', 'article_author', 'Выберите автора')
            ->add_options([
                '' => '— Выберите автора —',
            ] + get_team_members_for_select())
            ->set_help_text('Выберите специалиста из списка')
    ]);