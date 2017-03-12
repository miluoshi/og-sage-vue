<?php

namespace App;

define('App\TAXONOMY_NAME',  'topic');

function default_template_data($data) {
    $data['topics'] = get_terms([
        'taxonomy' => TAXONOMY_NAME,
        'hide_empty' => false,
    ]);

    $data['missing_topic'] = [
        'link' => get_field('footer_nenasli_ste_temu_link', 'option'),
        'text' => get_field('footer_nenasli_ste_temu_text', 'option'),
    ];

    // Site logo
    $theme_logo_id = get_theme_mod('custom_logo');
    $data['theme_logo'] = wp_get_attachment_image_src($theme_logo_id, 'full');

    return $data;
}

function home_page_data($data) {
    $topics = get_terms([
        'taxonomy' => TAXONOMY_NAME,
        'hide_empty' => false,
    ]);

    $data['topics_cards'] = [];
    foreach ($topics as $key => $topic) {
        $term_id = TAXONOMY_NAME . '_' . $topic->term_id;
        $data['topics_cards'][] = (object)[
            'index' => $key + 1,
            'name' => $topic->name,
            'url' => get_term_link($topic->slug, TAXONOMY_NAME),
            'cover_photo' => get_field('topic_cover_photo', $term_id),
            'description' => get_field('topic_description', $term_id),
        ];
    }

    return $data;
}

// Use default_template_data for all page types
add_filter('sage/template/page/data', 'App\\default_template_data');
add_filter('sage/template/single/data', 'App\\default_template_data');
add_filter('sage/template/tax-topic/data', 'App\\default_template_data');
add_filter('sage/template/error404/data', 'App\\default_template_data');
add_filter('sage/template/home/data', 'App\\default_template_data');

// HOME page
add_filter('sage/template/home/data', 'App\\home_page_data');
