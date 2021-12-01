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
 * CPT Koa Health
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


/**
 * CPT Begin
 */


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
    register_taxonomy('site_begin_category', array('site_begin'), $args);
}



/**
 * CPT People
 */


add_action('init', 'staff_people_register_cpt');

function staff_people_register_cpt()
{

    $args = array(
        'labels' => array(
            'menu_name' => 'Staff',
            'name' => 'Staff People'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'supports' => array('title', 'editor', 'author', 'page-attribute', 'thumbnail','excerpt','custom-fields'),
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite' => true,
    );
    register_post_type('staff_people', $args);
}


add_action('init', 'partners_people_register_cpt');

function partners_people_register_cpt()
{

    $args = array(
        'labels' => array(
            'menu_name' => 'Partners',
            'name' => 'Partners People'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'supports' => array('title', 'editor', 'author', 'page-attribute', 'thumbnail','excerpt','custom-fields'),
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite' => true,
    );
    register_post_type('partners_people', $args);
}


add_action('init', 'students_people_register_cpt');

function students_people_register_cpt()
{

    $args = array(
        'labels' => array(
            'menu_name' => 'Students',
            'name' => 'Students People'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'supports' => array('title', 'editor', 'author', 'page-attribute', 'thumbnail','excerpt','custom-fields'),
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite' => true,
    );
    register_post_type('students_people', $args);
}


/**
 * test
 */

add_action( 'add_meta_boxes', 'true_add_metabox' );
 
function true_add_metabox() {
 
    add_meta_box(
        'seo_metabox', // ID нашего метабокса
        'SEO настройки поста', // заголовок
        'seo_metabox_callback', // функция, которая будет выводить поля в мета боксе
        'students_people', // типы постов, для которых его подключим
        'normal', // расположение (normal, side, advanced)
        'default' // приоритет (default, low, high, core)
    );
 
}


function seo_metabox_callback( $post ) {
 
    // сначала получаем значения этих полей
    // заголовок
    $seo_title = get_post_meta( $post->ID, 'seo_title', true );
    // скрытие от поисковиков
    $seo_robots = get_post_meta( $post->ID, 'seo_robots', true );
 
    // одноразовые числа, кстати тут нет супер-большой необходимости их использовать
    wp_nonce_field( 'seopostsettingsupdate-' . $post->ID, '_truenonce' );
 
    echo '<table class="form-table">
        <tbody>
            <tr>
                <th><label for="seo_title">SEO-заголовок</label></th>
                <td><input type="text" id="seo_title" name="seo_title" value="' . esc_attr( $seo_title ) . '" class="regular-text"></td>
            </tr>
            <tr>
                <th>Скрыть из поисковиков</th>
                <td>
                    <label><input type="checkbox" name="seo_robots" ' . checked( 'yes', $seo_robots, false ) . ' /> Да</label>
                </td>
            </tr>
        </tbody>
    </table>';
 
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


/**
 * Featured content section shortcode
 * @param $atts
 * @return string
 */
function featured_block_function( $atts ) {

    $params = shortcode_atts(
        array(
            'post_type' => 'post',
            'taxonomy' => 'category',
            'terms_id' => '',
        ),
        $atts
    );

    $response = '';

    $query_posts = get_posts(array(
        'post_type' => $params[ 'post_type' ],
        'posts_per_page' => 8,
        'post_status' => 'publish',
    ));

    if (count($query_posts) === 0) {
        $response = 'No posts';
    }

    if ($query_posts) {
        $response = '<div id="shortcode-featured" class="featured-content__block-wrapper">';
        //$response .= '<h3>Featured content</h3>';
        ob_start();
        get_template_part( 'template-parts/featured-content', 'filters', $params );
        $response .= ob_get_contents();
        ob_end_clean();
        $response .= '<div class="featured-content-wrapper">';

        foreach ($query_posts as $post) {
            setup_postdata($post);

            $response .= '<div class="article-item">';
            $response .= '<a href="' . get_the_permalink($post->ID) . '"><img src=' . get_the_post_thumbnail_url($post->ID) . '></a>';
            $response .= '<h4>' . get_the_title($post->ID) . '</h4>';
            $response .= '<div class="article-excerpt">' . mb_substr( get_the_excerpt($post), 0, 150 ) . ' ...</div>';
            $response .= '<a href="' . get_the_permalink($post->ID) . '" class="wp-block-button__link has-ast-global-color-1-color has-ast-global-color-0-background-color has-text-color has-background">Read more</a>';
            $response .= '</div>';

        }
        $response .= '</div>';
        $response .= '</div>';

        wp_reset_postdata();
    }

    return $response;
}

add_shortcode( 'featured_block', 'featured_block_function' );


/**
 * Ajax filter featured content backend
 */
add_action('wp_ajax_nopriv_sc-block-post-filter', 'block_featured_post_filter');
add_action('wp_ajax_sc-block-post-filter', 'block_featured_post_filter');
function block_featured_post_filter()
{

    $cat_id = '';
    $response = '';

    if (isset($_POST['cat_id'])) {
        $cat_id = $_POST['cat_id'];
    }

    if ($cat_id !== '') {

        $query_posts = get_posts(array(
            'post_type' => 'koa_health',
            'posts_per_page' => 8,
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'koa_health_category',
                    'field' => 'id',
                    'terms' => $cat_id,
                ),
            ),
        ));

        if (count($query_posts) === 0) {
            $response = 'No posts';
        }

        if ($query_posts) {

            foreach ($query_posts as $post) {
                setup_postdata($post);

                $response .= '<div class="article-item">';
                $response .= '<a href="' . get_the_permalink($post->ID) . '"><img src=' . get_the_post_thumbnail_url($post->ID) . '></a>';
                $response .= '<h4>' . get_the_title($post->ID) . '</h4>';
                $response .= '<div class="article-excerpt">' . mb_substr( get_the_excerpt($post), 0, 150 ) . ' ...</div>';
                $response .= '<a href="' . get_the_permalink($post->ID) . '" class="wp-block-button__link has-ast-global-color-1-color has-ast-global-color-0-background-color has-text-color has-background">Read more</a>';
                $response .= '</div>';

            }

            wp_reset_postdata();
        }

    }
    echo $response;

    wp_die();
}
