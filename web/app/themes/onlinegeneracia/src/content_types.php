<?php

namespace App;

// Options page
acf_add_options_sub_page([
    'page_title' => 'Nastavenia stránky',
    'menu_title' => 'Nastavenia stránky',
    'menu_slug' => 'acf-nastavenia-stranky',
    'parent_slug' => 'themes.php',
]);

// Options page fields
add_action('acf/init', function() {
    acf_add_local_field_group([
        'key' => 'nastavenia_temy',
        'title' => 'Nastavenia temy',
        'fields' => [
            [
                'key' => 'footer_nenasli_ste_temu_text',
                'label' => 'Text odkazu v pätičke',
                'name' => 'footer_nenasli_ste_temu_text',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Nenašli ste vhodnú tému?',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ], [
                'key' => 'footer_nenasli_ste_temu_link',
                'label' => 'Odkaz v pätičke',
                'name' => 'footer_nenasli_ste_temu_link',
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
            ]
        ],
        'location' => [[[
            'param' => 'options_page',
            'operator' => '==',
            'value' => 'acf-nastavenia-stranky',
        ],],],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ]);
});

//
// Register custom taxonomy 'topic'
//
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
        'key' => 'topic_field_group',
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
                'new_lines' => 'wpautop', // also 'wpautop' for paragraphs or 'br' for <br />
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
                'key' => 'topic_articles',
                'label' => 'Články',
                'name' => 'articles',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'collapsed' => 'article_title',
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => '',
                'sub_fields' => [
                    [
                        'key' => 'article_title',
                        'label' => 'Nadpis',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
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
                    ],
                    [
                        'key' => 'article_description',
                        'label' => 'Krátky popis',
                        'name' => 'description',
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
                        'key' => 'article_link',
                        'label' => 'Odkaz',
                        'name' => 'link',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 1,
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
                'collapsed' => 'fun_link_title',
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

    acf_add_local_field_group([
        'key' => 'article_custom_fields',
        'title' => 'Text článku',
        'fields' => [
            [
                'key' => 'article_layout_block',
                'label' => 'Odstavec',
                'name' => 'layout_block',
                'type' => 'flexible_content',
                'instructions' => 'Je možné vybrať buď blok s textom alebo s videom.
    Pri textovom bloku je možné rozloženie s jedným alebo dvomi stĺpcami textu. Ak je vybraný 1 stĺpec, je možné ešte pridať 1 obrázok napravo od neho.
    Pri oboch voľbách je možné pridať podnadpis a citát, ktoré budú umiestnené v prvom stĺpci naľavo.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'button_label' => 'Pridaj sekciu',
                'min' => '',
                'max' => '',
                'layouts' => [
                    [
                        'key' => '58a84dc6d6b44',
                        'name' => 'text',
                        'label' => 'Text',
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => 'field_58a9d3e142603',
                                'label' => 'Rozloženie obsahu',
                                'name' => 'layout',
                                'type' => 'select',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => [
                                    'width' => '25',
                                    'class' => '',
                                    'id' => '',
                                ],
                                'choices' => [
                                    1 => '1 stĺpec textu (+ volitelný obrázok napravo)',
                                    2 => '2 stĺpce textu',
                                ],
                                'default_value' => [
                                    0 => 1,
                                ],
                                'allow_null' => 0,
                                'multiple' => 0,
                                'ui' => 0,
                                'ajax' => 0,
                                'return_format' => 'value',
                                'placeholder' => '',
                            ],
                            [
                                'key' => 'field_58a93a551512c',
                                'label' => 'Podnadpis',
                                'name' => 'subtitle',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => [
                                    'width' => '37.5',
                                    'class' => '',
                                    'id' => '',
                                ],
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ],
                            [
                                'key' => 'field_58a937d615128',
                                'label' => 'Citát',
                                'name' => 'quote',
                                'type' => 'textarea',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => [
                                    'width' => '37.5',
                                    'class' => '',
                                    'id' => '',
                                ],
                                'default_value' => '',
                                'placeholder' => '',
                                'maxlength' => '',
                                'rows' => 5,
                                'new_lines' => 'br',
                            ],
                            [
                                'key' => 'field_58a937f615129',
                                'label' => 'Stĺpec 1',
                                'name' => 'column_1',
                                'type' => 'wysiwyg',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => [
                                    'width' => '50',
                                    'class' => '',
                                    'id' => '',
                                ],
                                'default_value' => '',
                                'tabs' => 'all',
                                'toolbar' => 'full',
                                'media_upload' => 1,
                                'delay' => 0,
                            ],
                            [
                                'key' => 'field_58a939fe1512a',
                                'label' => 'Stĺpec 2',
                                'name' => 'column_2',
                                'type' => 'wysiwyg',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => [
                                    [
                                        [
                                            'field' => 'field_58a9d3e142603',
                                            'operator' => '==',
                                            'value' => '2',
                                        ],
                                    ],
                                ],
                                'wrapper' => [
                                    'width' => '50',
                                    'class' => '',
                                    'id' => '',
                                ],
                                'default_value' => '',
                                'tabs' => 'all',
                                'toolbar' => 'full',
                                'media_upload' => 1,
                                'delay' => 0,
                            ],
                            [
                                'key' => 'field_58a9d4dc42604',
                                'label' => 'Obrázok',
                                'name' => 'image',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => [
                                    [
                                        [
                                            'field' => 'field_58a9d3e142603',
                                            'operator' => '==',
                                            'value' => '1',
                                        ],
                                    ],
                                ],
                                'wrapper' => [
                                    'width' => '50',
                                    'class' => '',
                                    'id' => '',
                                ],
                                'return_format' => 'array',
                                'preview_size' => 'medium',
                                'library' => 'all',
                                'min_width' => '',
                                'min_height' => '',
                                'min_size' => '',
                                'max_width' => '',
                                'max_height' => '',
                                'max_size' => '',
                                'mime_types' => '',
                            ],
                        ],
                        'min' => '',
                        'max' => '',
                    ],
                    [
                        'key' => '58a9cd50244d1',
                        'name' => 'video',
                        'label' => 'Video',
                        'display' => 'block',
                        'sub_fields' => [
                            [
                                'key' => 'field_58a9cd5b244d2',
                                'label' => 'Nadpis videa',
                                'name' => 'video_title',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
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
                            ],
                            [
                                'key' => 'field_58a9cd6c244d3',
                                'label' => 'Video',
                                'name' => 'video',
                                'type' => 'oembed',
                                'instructions' => '',
                                'required' => 1,
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
                        'min' => '',
                        'max' => '',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ]);
});
