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
