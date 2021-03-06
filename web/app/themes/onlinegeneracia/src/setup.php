<?php

namespace App;

use Illuminate\Contracts\Container\Container as ContainerContract;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Config;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    $google_maps_script_url = "https://maps.googleapis.com/maps/api/js?key=" . env('GOOGLE_MAPS_API_KEY');

    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/googlemaps', $google_maps_script_url, false, null, true);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), false, null, true);
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    // add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');
    // Disable asset versioning
    add_theme_support('soil-disable-asset-versioning');
    // Disable trackbacks
    add_theme_support('soil-disable-trackbacks');
    // Google Analytics (more info: https://github.com/roots/soil/wiki/Google-Analytics)
    // add_theme_support('soil-google-analytics', 'UA-XXXXX-Y');

    // More info: https://developer.wordpress.org/themes/functionality/custom-logo/
    // https://codex.wordpress.org/Theme_Logo
    add_theme_support('custom-logo' /*, [
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ]*/);

    // Add custom image size for progressive loading
    add_image_size('placeholder', 50);

    if (get_option('thumbnail_size_w') != 360) {
        update_option('thumbnail_size_w', 360);
        update_option('thumbnail_size_h', 360);
    }
    if (get_option('medium_size_w') != 768) {
        update_option('medium_size_w', 768);
        update_option('medium_size_h', 768);
    }
    if (get_option('medium_large_size_w') != 1024) {
        update_option('medium_large_size_w', 1024);
        update_option('medium_large_size_h', 1024);
    }
    if (get_option('large_size_w') != 1440) {
        update_option('large_size_w', 1440);
        update_option('large_size_h', 1440);
    }

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'social_navigation' => __('Social Networks Navigation', 'sage'),
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Sage config
     */
    $paths = [
        'dir.stylesheet' => get_stylesheet_directory(),
        'dir.template'   => get_template_directory(),
        'dir.upload'     => wp_upload_dir()['basedir'],
        'uri.stylesheet' => get_stylesheet_directory_uri(),
        'uri.template'   => get_template_directory_uri(),
    ];
    $viewPaths = collect(preg_replace('%[\/]?(templates)?[\/.]*?$%', '', [STYLESHEETPATH, TEMPLATEPATH]))
        ->flatMap(function ($path) {
            return ["{$path}/templates", $path];
        })->unique()->toArray();
    config([
        'assets.manifest' => "{$paths['dir.stylesheet']}/dist/assets.json",
        'assets.uri'      => "{$paths['uri.stylesheet']}/dist",
        'view.compiled'   => "{$paths['dir.upload']}/cache/compiled",
        'view.namespaces' => ['App' => WP_CONTENT_DIR],
        'view.paths'      => $viewPaths,
    ] + $paths);

    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (ContainerContract $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view'], $app);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return '<?= App\\asset_path(\''.trim($asset, '\'"').'\'); ?>';
    });
});

/**
 * Remove main content editor for posts
 **/
add_action('admin_init', function() {
  remove_post_type_support('post', 'editor');
});

/**
 * Move post excerpt field to the top of the form
 **/
add_action( 'admin_menu', function() {
   remove_meta_box('postexcerpt', 'post', 'normal' );
   add_meta_box('postexcerpt', __('Excerpt'), 'post_excerpt_meta_box', 'post', 'normal', 'high');
});

/**
 * Register Google maps api key to display map on contact page
 */
add_action('acf/init', function() {
    acf_update_setting('google_api_key', env('GOOGLE_MAPS_API_KEY'));
});

/**
 * Init config
 */
sage()->bindIf('config', Config::class, true);
