<?php

namespace App;

define(__NAMESPACE__ . '\TAXONOMY_NAME',  'topic');
define(__NAMESPACE__ . '\WEB_ROOT_DIR', ABSPATH . '..');

// Use default_template_data for all page types
add_filter('sage/template/page/data', 'App\\default_template_data');
add_filter('sage/template/single/data', 'App\\default_template_data');
add_filter('sage/template/tax-topic/data', 'App\\default_template_data');
add_filter('sage/template/error404/data', 'App\\default_template_data');
add_filter('sage/template/home/data', 'App\\default_template_data');

// HOME page
add_filter('sage/template/home/data', 'App\\home_page_data');

// CONTACT page
add_filter('sage/template/kontakt/data', 'App\\contact_page_data');

// NOVINKY page
add_filter('sage/template/novinky/data', 'App\\novinky_page_data');

// taxonomy TOPIC page
add_filter('sage/template/tax-topic/data', 'App\\topic_page_data');

// Single POST
add_filter('sage/template/single/data', 'App\\single_data');

function default_template_data($data) {
    $data['topics'] = get_topics();

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

function contact_page_data($data) {
    $data['map'] = get_field('map');
    $data['map_height'] = get_field('map_height');
    $data['map_zoom'] = get_field_object('map')['zoom'];
    $data['addresses'] = get_field('addresses');

    return $data;
}

function topic_page_data($data) {
    $topics = get_topics();
    $topic = get_queried_object();
    $term_id = TAXONOMY_NAME . '_' . $topic->term_id;
    $cover_photo = get_field('topic_cover_photo', $term_id);
    $video_iframe = get_field('topic_video', $term_id);

    $data['topic'] = (object)[
        'name' => $topic->name,
        'url' => get_term_link($topic->slug, TAXONOMY_NAME),
        'cover_photo' => $cover_photo,
        'subtitle' => get_field('topic_subtitle', $term_id),
        'description' => get_field('topic_description', $term_id),
        'links' => get_field('topic_links', $term_id),
        'video' => null
    ];

    $video_metadata = get_video_metadata($video_iframe);
    if ($video_metadata) {
        $data['topic']->video =  (object)[
            'title' => get_field('video_title', $term_id),
            'description' => get_field('video_description', $term_id),
            'thumbnail_url' => $video_metadata->thumbnail_url,
            'src' => $video_metadata->url . '&autoplay=1',
            'iframe' => $video_iframe,
        ];
    }

    $data['topics_count'] = sprintf('%02d', count($topics));
    $data['topic_index'] = get_topic_index($topics, $topic->term_id);
    $data['previous'] = get_previous_topic($topics, $topic->term_id);
    $data['next'] = get_next_topic($topics, $topic->term_id);

    $data['articles'] = get_posts([
        'topic' => $topic->slug,
    ]);

    return $data;
}

function novinky_page_data($data) {
    $data['topics_list'] = [];
    foreach ($data['topics'] as $key => $topic) {
        $term_id = TAXONOMY_NAME . '_' . $topic->term_id;

        $posts = get_posts([
            'topic' => $topic->slug,
        ]);

        $data['topics_list'][] = (object)[
            'name' => $topic->name,
            'url' => get_term_link($topic->slug, TAXONOMY_NAME),
            'posts' => $posts
        ];
    }

    return $data;
}

function single_data($data) {
    global $post;

    $data['featured_img'] = (object)[
        'thumbnail_url' => get_the_post_thumbnail_url($post, 'full'),
        'srcset' => wp_get_attachment_image_srcset(get_post_thumbnail_id(), 'full'),
        'sizes' => wp_get_attachment_image_sizes(get_post_thumbnail_id()),
    ];

    $data['get_image_data'] = function($img, $size) {
        $id = $img['id'];
        $src = wp_get_attachment_image_src($id, $size)[0];
        $image_meta = wp_get_attachment_metadata($id);
        $sizes = [
            $image_meta['sizes'][$size]['width'],
            $image_meta['sizes'][$size]['height'],
        ];

        $srcset = wp_calculate_image_srcset( $sizes, $src, $image_meta, $id );
        $sizes = wp_calculate_image_sizes( $sizes, $src, $image_meta, $id );

        return [
            'src' => $src,
            'srcset' => $srcset,
            'sizes' => $sizes,
        ];
    }; // Function

    return $data;
}

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

function get_previous_topic($topics, $term_id) {
    $this_topic_key = 0;

    foreach ($topics as $key => $topic) {
        if ($topic->term_id === $term_id) {
            $this_topic_key = $key;
        }
    }

    $previous_topic = $this_topic_key === 0
        ? null
        : $topics[$this_topic_key - 1];

    return $previous_topic
        ? (object)[
            'title' => $previous_topic->name,
            'url' => get_term_link($previous_topic->slug, TAXONOMY_NAME),
            'cover_photo' => get_field('topic_cover_photo', TAXONOMY_NAME . '_' . $previous_topic->term_id)
        ]
        : null;
}

function get_next_topic($topics, $term_id) {
    $this_topic_key = count($topics);
    $last_key = count($topics) - 1;

    foreach ($topics as $key => $topic) {
        if ($topic->term_id === $term_id) {
            $this_topic_key = $key;
        }
    }

    $next_topic = $this_topic_key === $last_key
        ? null
        : $topics[$this_topic_key + 1];

    return $next_topic
        ? (object)[
            'title' => $next_topic->name,
            'url' => get_term_link($next_topic->slug, TAXONOMY_NAME),
            'cover_photo' => get_field('topic_cover_photo', TAXONOMY_NAME . '_' . $next_topic->term_id)
        ]
        : null;
}

function get_video_src($iframe) {
    preg_match('/src="(.+?)"/', $iframe, $matches);

    return count($matches) > 1
        ? $matches[1]
        : '';
}

function get_video_metadata($iframe) {
    $video_src = get_video_src($iframe);
    $data = null;

    if (strlen($video_src) > 0) {
        $url = 'https://noembed.com/embed?url=' . $video_src;

        $json = file_get_contents($url);
        $data = json_decode($json);
    }

    return $data;
}
