<?php

namespace App;

// Remove editor for posts
add_action('admin_init', function() {
  remove_post_type_support('post', 'editor');
});

// Move post excerpt field to the top of the form
add_action( 'admin_menu', function() {
   remove_meta_box('postexcerpt', 'post', 'normal' );
   add_meta_box('postexcerpt', __('Excerpt'), 'post_excerpt_meta_box', 'post', 'normal', 'high');
});

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
                'key' => 'topic_tab_info',
                'label' => 'Info',
                'name' => 'tab_info',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'left',
                'endpoint' => 0,
            ], [
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
                'key' => 'topic_tab_links',
                'label' => 'Odkazy',
                'name' => 'tab_links',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'left',
                'endpoint' => 0,
            ], [
                'key' => 'topic_links',
                'label' => 'Ďalšie odkazy',
                'name' => 'links',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'collapsed' => 'link',
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Pridaj odkaz',
                'sub_fields' => [
                    [
                        'key' => 'link',
                        'label' => '',
                        'name' => 'link',
                        'type' => 'link',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'return_format' => 'array',
                    ],
                ],
            ], [
                'key' => 'topic_tab_video',
                'label' => 'Video',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'left',
                'endpoint' => 0,
            ], [
                'key' => 'topic_video_title',
                'label' => 'Názov',
                'name' => 'video_title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ], [
                'key' => 'topic_video_description',
                'label' => 'Popis',
                'name' => 'video_description',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => 'wpautop',
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
                'key' => 'article_quote',
                'label' => 'Citát',
                'name' => 'quote',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '100',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => 5,
                'new_lines' => 'br',
            ], [
                'key' => 'article_layout_block',
                'label' => 'Blok odstavcov',
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
                                'key' => 'field_layout',
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
                                    '1_col' => '1 stĺpec textu (+ volitelný obrázok napravo)',
                                    '2_cols' => '2 stĺpce textu',
                                ],
                                'default_value' => [
                                    0 => '1_col',
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
                                            'field' => 'field_layout',
                                            'operator' => '==',
                                            'value' => '2_cols',
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
                                            'field' => 'field_layout',
                                            'operator' => '==',
                                            'value' => '1_col',
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
