<?php
/**
 * Plugin Name: Featured content custom gutenberg block
 * Author: DreamDev
 * Version: 1.0.0
 */

define('FC_PLUGIN_DIR', plugin_dir_path(__FILE__));

add_action('wp_enqueue_scripts', 'my_scripts_method');
function my_scripts_method()
{
    $script_url = plugins_url('/js/ajax-functions.js', __FILE__);
    wp_enqueue_script('ajax-script', $script_url, array('jquery'));

    wp_localize_script('ajax-script', 'myajax',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );
}

add_action('init', 'gutenberg_block_register_block');

function gutenberg_block_register_block()
{
    include(FC_PLUGIN_DIR . 'blocks/featured-content-block.php');
    include(FC_PLUGIN_DIR . 'blocks/filtered-content-search-block.php');
    include(FC_PLUGIN_DIR . 'blocks/our-explorations-block.php');

    register_block_type('riad/featured-content-block', array(
        'render_callback' => 'riad_featured_content_block',
    ));

    register_block_type('riad/filtered-content-search-block', array(
        'render_callback' => 'riad_filtered_content_search_block',
    ));
    register_block_type('riad/our-explorations-block', array(
        'render_callback' => 'riad_our_explorations_block',
    ));

}

function loadMyBlock()
{
    $dependencies = array(
        'wp-blocks',    // Provides useful functions and components for extending the editor
        'wp-i18n',      // Provides localization functions
        'wp-element',   // Provides React.Component
        'wp-components' // Provides many prebuilt components and controls
    );

    wp_enqueue_script(
        'featured-content-block',
        plugin_dir_url(__FILE__) . 'blocks/featured-content-block.js',
        $dependencies,
        true
    );
    wp_enqueue_script(
        'filtered-content-search-block',
        plugin_dir_url(__FILE__) . 'blocks/filtered-content-search-block.js',
        array('wp-blocks', 'wp-editor'),
        true
    );
    wp_enqueue_script(
        'our-explorations-block',
        plugin_dir_url(__FILE__) . 'blocks/our-explorations-block.js',
        array('wp-blocks', 'wp-editor'),
        true
    );
}

add_action('enqueue_block_editor_assets', 'loadMyBlock');
