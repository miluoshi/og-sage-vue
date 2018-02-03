<?php

namespace App;

if (function_exists('acf_add_local_field_group')) {
    add_action('acf/init', function() {
        acf_add_local_field_group(array(
            'key' => 'group_5a72112becce3',
            'title' => 'kontakt',
            'fields' => array(
                array(
                    'key' => 'field_5a721143c94a9',
                    'label' => 'Adresy',
                    'name' => 'addresses',
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
                    'layout' => 'table',
                    'button_label' => '',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_5a721197c94aa',
                            'label' => 'Názov',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Názov pobočky, alebo rola kontaktnej osoby',
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
                            'key' => 'field_5a72121dc94ab',
                            'label' => 'Kontaktné údaje',
                            'name' => 'contact_details',
                            'type' => 'textarea',
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
                            'maxlength' => '',
                            'rows' => 5,
                            'new_lines' => 'br',
                        ),
                    ),
                ),
                array(
                    'key' => 'field_5a72126ac94ac',
                    'label' => 'Mapa',
                    'name' => 'map',
                    'type' => 'google_map',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'center_lat' => '48.1465866',
                    'center_lng' => '17.1101308',
                    'zoom' => 16,
                    'height' => 440,
                ),
                array(
                    'key' => 'field_5a73695c0876f',
                    'label' => 'Výška mapy',
                    'name' => 'map_height',
                    'type' => 'number',
                    'instructions' => 'v pixeloch',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 400,
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => 250,
                    'max' => 900,
                    'step' => 10,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page',
                        'operator' => '==',
                        'value' => '4',
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
