<?php
/**
 * Plugin Name: New block plugin
 * Author: DreamDev
 * Version: 1.0.0
 */


defined( 'ABSPATH' ) || exit;

/**
 * Load all translations for our plugin from the MO file.
 */
add_action( 'init', 'gutenberg_examples_04_load_textdomain' );

function gutenberg_examples_04_load_textdomain() {
    load_plugin_textdomain( 'gutenberg-examples', false, basename( __DIR__ ) . '/languages' );
}

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * Passes translations to JavaScript.
 */
function gutenberg_examples_04_register_block() {

    if ( ! function_exists( 'register_block_type' ) ) {
        // Gutenberg is not active.
        return;
    }

    // Register the block by passing the path to it's block.json file.
    register_block_type( __DIR__ );

    if ( function_exists( 'wp_set_script_translations' ) ) {
        /**
         * May be extended to wp_set_script_translations( 'my-handle', 'my-domain',
         * plugin_dir_path( MY_PLUGIN ) . 'languages' ) ). For details see
         * https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
         */
        wp_set_script_translations( 'gutenberg-examples-04', 'gutenberg-examples' );
    }

}
add_action( 'init', 'gutenberg_examples_04_register_block' );
