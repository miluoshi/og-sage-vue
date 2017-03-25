<?php

namespace App;

define('App\TAXONOMY_NAME',  'topic');
define('App\WEB_ROOT_DIR', ABSPATH . '..');

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
        $cover_photo = get_field('topic_cover_photo', $term_id);
        $placeholder_uri = getBlurredPlaceholderUri(
            WEB_ROOT_DIR . $cover_photo['sizes']['placeholder'],
            $cover_photo['width'],
            $cover_photo['height']
        );

        // var_dump(get_field('topic_cover_photo', $term_id));
        $data['topics_cards'][] = (object)[
            'index' => $key + 1,
            'name' => $topic->name,
            'url' => get_term_link($topic->slug, TAXONOMY_NAME),
            'cover_photo' => $cover_photo,
            'description' => get_field('topic_description', $term_id),
            'placeholder_uri' => $placeholder_uri,
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

// https://css-tricks.com/the-blur-up-technique-for-loading-background-images/
function getBlurredPlaceholderUri($placeholderPath, $width, $height) {
    $imageData = base64_encode(file_get_contents($placeholderPath));
    $imageUri = 'data: ' . mime_content_type($placeholderPath).';base64,' . $imageData;

    $svg = '<svg xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        width="'. $width .'" height="'. $height .'"
        viewBox="0 0 '. $width .' '. $height .'">
    <filter id="blur" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
        <feGaussianBlur stdDeviation="20 20" edgeMode="duplicate" />
        <feComponentTransfer>
        <feFuncA type="discrete" tableValues="1 1" />
        </feComponentTransfer>
    </filter>
    <image filter="url(#blur)"
            xlink:href="' . $imageUri . '"
            x="0" y="0"
            height="100%" width="100%"/>
    </svg>';

    $svgData = base64_encode($svg);

    return 'data:image/svg+xml;base64,' . $svgData;
}
