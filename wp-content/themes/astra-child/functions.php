<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0');

/**
 * Enqueue scripts & styles
 */
function child_enqueue_styles()
{

    wp_enqueue_style('astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all');
    wp_enqueue_style('astra-nick-dev-css', get_stylesheet_directory_uri() . '/assets/nick-dev.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all');
    wp_enqueue_style('slick-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all');
    wp_enqueue_style('fetured-content-plugin-css', get_stylesheet_directory_uri() . '/assets/featured-content-plugin.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all');
    wp_enqueue_style('postx-builder-plugin-css', get_stylesheet_directory_uri() . '/assets/postx-builder-plugin.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all');

    wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'));
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/assets/custom.js', array('jquery'));

}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);


/**
 * CPT People
 */



add_action('init', 'koa_health_register_cpt');

function koa_health_register_cpt()
{

    $args = array(
        'labels' => array(
            'menu_name' => 'Koa Health',
            'name' => 'Koa Health'
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'author', 'page-attribute', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
        'has_archive' => true,
        'archives' => 'Koa Health'
    );
    register_post_type('koa_health', $args);
}

add_action('init', 'koa_health_category_register_taxonomy');

function koa_health_category_register_taxonomy()
{

    $args = array(
        'labels' => array(
            'menu_name' => 'Koa Health Categories'
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true
    );
    register_taxonomy('koa_health_category', 'koa_health', $args);
}


add_action('init', 'site_begin_register_cpt');

function site_begin_register_cpt()
{

    $args = array(
        'labels' => array(
            'menu_name' => 'Begin Minisite',
            'name' => 'Begin Minisite'
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'author', 'page-attribute', 'thumbnail','excerpt'),
        'show_in_rest' => true,
        'has_archive' => true,
        'archives' => 'Begin Minisite'
    );
    register_post_type('site_begin', $args);
}

add_action('init', 'site_begin_category_register_taxonomy');

function site_begin_category_register_taxonomy()
{

    $args = array(
        'labels' => array(
            'menu_name' => 'Begin Minisite Categories'
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true
    );
    register_taxonomy('site_begin_category', 'site_begin', $args);
}




/**
 * Breadcrumbs
 */
function the_breadcrumb()
{
    global $post;
    $currentTerm = get_queried_object();


    if (is_singular('koa_health')) {

        $taxonomy = 'koa_health_category';

        $category = get_the_terms($post->ID, $taxonomy);
        $categoryID = $category[0]->term_id;

        if ($category) {
            $parentTerms = get_term_parents_list($categoryID, $taxonomy, array(
                'separator' => '<span class="breadcrumbs-separator"> > </span>',
            ));
            $topParentTerm = get_term_top_most_parent($categoryID, $taxonomy);
            $topParentTermColor = get_term_meta($topParentTerm->term_id, 'ultp_category_color', true);
        }

        if (!$topParentTermColor || $topParentTermColor === '') {
            $topParentTermColor = '#ffffff';
        }

        echo '<div class="custom-breadcrumbs" style="background: ' . $topParentTermColor . '">';
        echo '<div class="custom-breadcrumbs__container block-paddings">';
        echo '<a href="/koa_health">Koa Health</a>';
        echo '<span class="breadcrumbs-separator"> > </span>';

        if ($parentTerms) {
            echo $parentTerms;
        }

        echo '<span class="breadcrumbs-current-page">' . get_the_title() . '</span>';
        echo '</div>';
        echo '</div>';

    } elseif ($currentTerm->taxonomy == 'koa_health_category') {

        $parentTerms = get_term_parents_list($currentTerm->term_id, $currentTerm->taxonomy, array(
            'separator' => '<span class="breadcrumbs-separator"> > </span>',
            'inclusive' => false,
        ));
        $topParentTerm = get_term_top_most_parent($currentTerm->term_id, $currentTerm->taxonomy);
        $topParentTermColor = get_term_meta($topParentTerm->term_id, 'ultp_category_color', true);

        if (!$topParentTermColor || $topParentTermColor === '') {
            $topParentTermColor = '#ffffff';
        }

        echo '<div class="custom-breadcrumbs" style="background: ' . $topParentTermColor . '">';
        echo '<div class="custom-breadcrumbs__container block-paddings">';
        echo '<a href="/koa_health">Koa Health</a>';
        echo '<span class="breadcrumbs-separator"> > </span>';

        if ($parentTerms) {
            echo $parentTerms;
        }

        echo '<span class="breadcrumbs-current-page">' . $currentTerm->name . '</span>';
        echo '</div>';
        echo '</div>';

    } 


    if (is_singular('site_begin')) {

        $taxonomy = 'site_begin_category';

        $category = get_the_terms($post->ID, $taxonomy);
        $categoryID = $category[0]->term_id;

        if ($category) {
            $parentTerms = get_term_parents_list($categoryID, $taxonomy, array(
                'separator' => '<span class="breadcrumbs-separator"> > </span>',
            ));
            $topParentTerm = get_term_top_most_parent($categoryID, $taxonomy);
            $topParentTermColor = get_term_meta($topParentTerm->term_id, 'ultp_category_color', true);
        }

        if (!$topParentTermColor || $topParentTermColor === '') {
            $topParentTermColor = '#ffffff';
        }

        echo '<div class="custom-breadcrumbs" style="background: ' . $topParentTermColor . '">';
        echo '<div class="custom-breadcrumbs__container block-paddings">';
        echo '<a href="/site_begin">Begin</a>';
        echo '<span class="breadcrumbs-separator"> > </span>';

        if ($parentTerms) {
            echo $parentTerms;
        }

        echo '<span class="breadcrumbs-current-page">' . get_the_title() . '</span>';
        echo '</div>';
        echo '</div>';

    } elseif ($currentTerm->taxonomy == 'site_begin_category') {

        $parentTerms = get_term_parents_list($currentTerm->term_id, $currentTerm->taxonomy, array(
            'separator' => '<span class="breadcrumbs-separator"> > </span>',
            'inclusive' => false,
        ));
        $topParentTerm = get_term_top_most_parent($currentTerm->term_id, $currentTerm->taxonomy);
        $topParentTermColor = get_term_meta($topParentTerm->term_id, 'ultp_category_color', true);

        if (!$topParentTermColor || $topParentTermColor === '') {
            $topParentTermColor = '#ffffff';
        }

        echo '<div class="custom-breadcrumbs" style="background: ' . $topParentTermColor . '">';
        echo '<div class="custom-breadcrumbs__container block-paddings">';
        echo '<a href="/site_begin">Begin</a>';
        echo '<span class="breadcrumbs-separator"> > </span>';

        if ($parentTerms) {
            echo $parentTerms;
        }

        echo '<span class="breadcrumbs-current-page">' . $currentTerm->name . '</span>';
        echo '</div>';
        echo '</div>';

    } 







}





// Determine the top-most parent of a term
function get_term_top_most_parent($term, $taxonomy)
{
    // Start from the current term
    $parent = get_term($term, $taxonomy);
    // Climb up the hierarchy until we reach a term with parent = '0'
    while ($parent->parent != '0') {
        $term_id = $parent->parent;
        $parent = get_term($term_id, $taxonomy);
    }
    return $parent;
}



the_excerpt();
