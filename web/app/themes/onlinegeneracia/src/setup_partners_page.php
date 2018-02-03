<?php

namespace App;

if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', function() {
        acf_add_local_field_group(array(
            'key' => 'group_5a75eb64b3b0a',
            'title' => 'Partneri',
            'fields' => array(
                array(
                    'key' => 'field_5a75eb8dbad4f',
                    'label' => 'Skupina partnerov',
                    'name' => 'partner-group',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'collapsed' => '',
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'block',
                    'button_label' => 'Pridať skupinu',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_5a75eba4bad50',
                            'label' => 'Nadpis',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'field_5a75ebb5bad51',
                            'label' => 'Zoznam partnerov',
                            'name' => 'partner-list',
                            'type' => 'repeater',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'collapsed' => '',
                            'min' => 0,
                            'max' => 0,
                            'layout' => 'row',
                            'button_label' => 'Pridať partnera',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_5a75ebd0bad52',
                                    'label' => 'Logo',
                                    'name' => 'logo',
                                    'type' => 'image',
                                    'instructions' => '',
                                    'required' => 1,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'return_format' => 'array',
                                    'preview_size' => 'medium',
                                    'library' => 'all',
                                    'min_width' => 320,
                                    'min_height' => 120,
                                    'min_size' => '',
                                    'max_width' => '',
                                    'max_height' => '',
                                    'max_size' => '',
                                    'mime_types' => '',
                                ),
                                array(
                                    'key' => 'field_5a75ebf0bad53',
                                    'label' => 'Odkaz',
                                    'name' => 'link',
                                    'type' => 'url',
                                    'instructions' => '',
                                    'required' => 1,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => '',
                                    'placeholder' => '',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page',
                        'operator' => '==',
                        'value' => '146',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'acf_after_title',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' =>  array(
                0 => 'the_content',
                1 => 'excerpt',
                2 => 'discussion',
                3 => 'comments',
            ),
            'active' => 1,
            'description' => '',
        ));
    });
}
