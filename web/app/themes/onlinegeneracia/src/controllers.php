<?php

namespace App;

function default_template_data($data) {
    $taxonomy_name = 'topic';

    $data['topics'] = get_terms([
        'taxonomy' => $taxonomy_name,
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

// Use default_template_data for all page types
add_filter('sage/template/home/data', 'App\\default_template_data');
add_filter('sage/template/page/data', 'App\\default_template_data');
add_filter('sage/template/single/data', 'App\\default_template_data');
add_filter('sage/template/tax-topic/data', 'App\\default_template_data');
add_filter('sage/template/error404/data', 'App\\default_template_data');

// HOME page
add_filter('sage/template/home/data', function($data) {


    return $data;
});
