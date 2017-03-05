<?php

namespace App;

function default_template_data($data) {
    $taxonomy_name = 'topic';

    $data['navigation_topics'] = array_map(
        function($term) use ($taxonomy_name) {
            return [
                'url' => get_term_link($term, $taxonomy_name),
                'name' => $term->name
            ];
        }, get_terms([
            'taxonomy' => $taxonomy_name,
            'hide_empty' => false,
        ])
    );

    $data['footer_nenasli_ste_temu'] = [
        'link' => get_field('footer_nenasli_ste_temu_link', 'option'),
        'text' => get_field('footer_nenasli_ste_temu_text', 'option'),
    ];

    return $data;
}

// Use default_template_data for all page types
add_filter('sage/template/home/data', 'App\\default_template_data');
add_filter('sage/template/page/data', 'App\\default_template_data');
add_filter('sage/template/single/data', 'App\\default_template_data');
