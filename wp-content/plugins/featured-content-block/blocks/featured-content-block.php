<?php
/**
 * Callback function for featured content block
 * @param $attribites
 * @return string
 */

function riad_featured_content_block($attribites)
{
    $response = '';

    $query_posts = get_posts(array(
        'post_type' => 'koa_health',
        'posts_per_page' => 8,
        'post_status' => 'publish',
    ));

    if (count($query_posts) === 0) {
        $response = 'No posts';
    }

    if ($query_posts) {
        $response = '<div class="featured-content__block-wrapper">';
        $response .= '<h3>Featured content</h3>';
        $response .= include ( FC_PLUGIN_DIR . 'template-parts/featured-content-filters.php');
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

/**
 * Ajax filter backend
 */
add_action('wp_ajax_nopriv_block-post-filter', 'block_post_filter');
add_action('wp_ajax_block-post-filter', 'block_post_filter');
function block_post_filter()
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
