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
    $topics = get_topics();

    $data['topics_count'] = sprintf('%02d', count($topics));
    $data['topics_cards'] = [];
    foreach ($topics as $key => $topic) {
        $term_id = TAXONOMY_NAME . '_' . $topic->term_id;
        $cover_photo = get_field('topic_cover_photo', $term_id);
        $placeholder_uri = getBlurredPlaceholderUri(
            WEB_ROOT_DIR . $cover_photo['sizes']['placeholder'],
            $cover_photo['width'],
            $cover_photo['height']
        );

        $data['topics_cards'][] = (object)[
            'index' => sprintf('%02d', $key + 1),
            'name' => $topic->name,
            'url' => get_term_link($topic->slug, TAXONOMY_NAME),
            'cover_photo' => $cover_photo,
            'description' => wp_trim_words(get_field('topic_description', $term_id), 30),
            'placeholder_uri' => $placeholder_uri,
        ];
    }

    $data['image_sizes'] = ['small', 'medium', 'large', 'original'];

    return $data;
}

function topic_page_data($data) {
    $topics = get_topics();
    $topic = get_queried_object();
    $term_id = TAXONOMY_NAME . '_' . $topic->term_id;

    $cover_photo = get_field('topic_cover_photo', $term_id);

    $data['topic'] = (object)[
        'name' => $topic->name,
        'url' => get_term_link($topic->slug, TAXONOMY_NAME),
        'cover_photo' => $cover_photo,
        'subtitle' => get_field('topic_subtitle', $term_id),
        'description' => get_field('topic_description', $term_id),
    ];

    $data['topics_count'] = sprintf('%02d', count($topics));
    $data['topic_index'] = get_topic_index($topics, $topic->term_id);

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

// taxonomy TOPIC page
add_filter('sage/template/tax-topic/data', 'App\\topic_page_data');

// https://css-tricks.com/the-blur-up-technique-for-loading-background-images/
function getBlurredPlaceholderUri($placeholderPath, $width, $height) {
    $imageData = base64_encode(file_get_contents($placeholderPath));
    $imageUri = 'data: ' . mime_content_type($placeholderPath).';base64,' . $imageData;

    $toBeEncodedChars = str_split("\"#<>[]^{|}\n");
    $encodedChars = [
        '%22',
        '%23',
        '%3C',
        '%3E',
        '%5B',
        '%5D',
        '%5E',
        '%7B',
        '%7C',
        '%7D',
        '%0A',
    ];

    $svg_part_1 = '<svg xmlns="http://www.w3.org/2000/svg"
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
            xlink:href="';
    $svg_part_2 = '" x="0" y="0" height="100%" width="100%"/></svg>';

    $svgData = str_replace($toBeEncodedChars, $encodedChars, $svg_part_1)
        . $imageUri
        . str_replace($toBeEncodedChars, $encodedChars, $svg_part_2);

    return 'data:image/svg+xml;charset=utf-8,' . $svgData;
}

function get_topics() {
    return get_terms([
        'taxonomy' => TAXONOMY_NAME,
        'hide_empty' => false,
        'orderby' => 'term_id',
        'order' => 'ASC'
    ]);
}

function get_topic_index($topics, $term_id) {
    foreach ($topics as $key => $topic) {
        if ($topic->term_id === $term_id) {
            return sprintf('%02d', $key + 1);
        }
    }

    // Default value if not found
    return "01";
}
