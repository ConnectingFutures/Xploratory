<?php
/**
 * Callback function for featured content block
 * @param $attribites
 * @return string
 */

function riad_our_explorations_block($attribites)
{
    $response = '';
    $posts_per_page = 9;

    $query_posts = get_posts(array(
        'post_type' => 'post',
        'posts_per_page' => $posts_per_page,
        'post_status' => 'publish',
    ));

    if (count($query_posts) === 0) {
        $response = 'No posts';
    }

    if ($query_posts) {
        $response = '<div class="our_explorations__block-wrapper">';
        $response .= '<h3>OUR EXPLORATIONS</h3>';
        $response .= include(FC_PLUGIN_DIR . 'template-parts/our-explorations-filters.php');
        $response .= '<div class="our_explorations_content-wrapper">';

        foreach ($query_posts as $post) {
            setup_postdata($post);
            $cats = get_the_category($post->ID);

            $response .= '<div class="article-item">';
            $response .= '<a href="' . get_the_permalink($post->ID) . '"><img src=' . get_the_post_thumbnail_url($post->ID) . '></a>';
            $response .= '<div class="article-item-category"><a href="' . get_category_link($cats[0]->cat_ID) . '">' . $cats[0]->name . '</a></div>';
            $response .= '<a href="' . get_the_permalink($post->ID) . '"><h4>' . get_the_title($post->ID) . '</h4></a>';
            $response .= '<span class="article-item-description">' . get_the_excerpt($post->ID) . '</span>';
            $response .= '</div>';

        }
        $response .= '</div>';
        $response .= '</div>';

        wp_reset_postdata();
    }

    return $response;

}

/**
 * Ajax load more
 */
add_action('wp_ajax_nopriv_filter-explorations', 'ajax_filter_explorations');
add_action('wp_ajax_filter-explorations', 'ajax_filter_explorations');
function ajax_filter_explorations()
{

    if (isset($_POST['cat_id'])) {
        $cat_id = $_POST['cat_id'];
    }

    $args = array(
        'suppress_filters' => true,
        'post_type' => 'post',
        'posts_per_page' => -1,
        'cat' => $cat_id,
    );

    $loop = new WP_Query($args);

    $articles = '';

    if ($loop->have_posts()) {
        while ($loop->have_posts()) : $loop->the_post();
            $post_id = get_the_ID();
            $cats = get_the_category($post_id);

            $articles .= '<div class="article-item">';
            $articles .= '<a href="' . get_the_permalink($post_id) . '"><img src=' . get_the_post_thumbnail_url($post_id) . '></a>';
            $articles .= '<div class="article-item-category"><a href="' . get_category_link($cats[0]->cat_ID) . '">' . $cats[0]->name . '</a></div>';
            $articles .= '<a href="' . get_the_permalink($post_id) . '"><h4>' . get_the_title($post_id) . '</h4></a>';
            $articles .= '<span class="article-item-description">' . get_the_excerpt($post_id) . '</span>';
            $articles .= '</div>';

        endwhile;
    } else {
        $articles = 'No more posts';
    }
    $response['articles'] = $articles;

    $result = json_encode($response);

    wp_reset_postdata();
    die($result);
}
