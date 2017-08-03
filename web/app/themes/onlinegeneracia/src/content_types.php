<?php

namespace App;

require_once __DIR__.'/setup_taxonomy_topic.php';

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
