<?php

namespace App;

/**
 * Register custom taxonomy 'topic'
 */
add_action('init', function () {
    register_taxonomy('topic', 'post', [
        'label' => 'Témy',
        'labels' => [
            'singular_name' => 'Téma',
            'view_item' => 'Zobraz tému',
            'edit_item' => 'Uprav nastavenia témy',
            'add_new_item' => 'Pridaj novú tému'
        ],
        'hierarchical' => false,
        'rewrite' => ['slug' => 'tema']
    ]);
});

// Define custom fields for "Topic" taxonomy
add_action('acf/init', function() {
    acf_add_local_field_group([
        'key' => 'group_58a3a9f47d196',
        'title' => 'Téma - custom fields',
        'fields' => [
            [
                'key' => 'topic_subtitle',
                'label' => 'Podnadpis',
                'name' => 'subtitle',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ], [
                'key' => 'topic_description',
                'label' => 'Popis',
                'name' => 'description',
                'type' => 'textarea',
                'instructions' => '',
                'new_lines' => 'br', // also 'wpautop' for paragraphs
                'required' => 0,
                'rows' => 5,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ], [
                'key' => 'topic_cover_photo',
                'label' => 'Titulný obrázok',
                'name' => 'cover_photo',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => 'jpg, jpeg',
            ], [
                'key' => 'topic_fun_links',
                'label' => 'Zábava (odkazy)',
                'name' => 'fun_links',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'collapsed' => 'field_58a418859a857',
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Pridaj odkaz',
                'sub_fields' => [
                    [
                        'key' => 'fun_link_title',
                        'label' => 'Nadpis',
                        'name' => 'link_title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ], [
                        'key' => 'fun_link_description',
                        'label' => 'Popis',
                        'name' => 'link_description',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'maxlength' => '',
                        'rows' => 5,
                        'new_lines' => 'br',
                    ], [
                        'key' => 'fun_link_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                    ],
                ],
            ], [
                'key' => 'topic_video',
                'label' => 'Video',
                'name' => 'video',
                'type' => 'oembed',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'width' => '',
                'height' => '',
            ],
        ],
        'location' => [[[
            'param' => 'taxonomy',
            'operator' => '==',
            'value' => 'topic',
        ]]],
        'menu_order' => 0,
        'position' => 'acf_after_title',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => ''
    ]);
});
