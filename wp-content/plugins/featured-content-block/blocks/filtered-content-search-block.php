<?php
/**
 * Callback function for featured content block
 * @param $attribites
 * @return string
 */

function riad_filtered_content_search_block($attribites)
{
    $response = '';
    $posts_per_page = 4;

    $query_posts = get_posts(array(
        'post_type' => 'post',
        'posts_per_page' => $posts_per_page,
        'post_status' => 'publish',
    ));

    if (count($query_posts) === 0) {
        $response = 'No posts';
    }

    if ($query_posts) {
        $response = '<div class="filtered_content_search__block-wrapper">';
        $response .= '<h3>FILTER YOUR SEARCH</h3>';
        $response .= include(FC_PLUGIN_DIR . 'template-parts/search-content-filters.php');
        $response .= '<div class="filtered_content_search-wrapper">';

        foreach ($query_posts as $post) {
            setup_postdata($post);
            $cats = get_the_category($post->ID);

            $response .= '<div class="article-item">';
            $response .= '<a href="' . get_the_permalink($post->ID) . '"><img src=' . get_the_post_thumbnail_url($post->ID) . '></a>';
            $response .= '<div class="article-item-category"><a href="' . get_category_link($cats[0]->cat_ID) . '">' . $cats[0]->name . '</a></div>';
            $response .= '<h4>' . get_the_title($post->ID) . '</h4>';
            $response .= '<a href="' . get_the_permalink($post->ID) . '" class="wp-block-button__link has-ast-global-color-1-color has-ast-global-color-0-background-color has-text-color has-background">Read more</a>';
            $response .= '</div>';

        }
        $response .= '</div>';
        $response .= '<div class="filtered_content_search__load-more">
<button id="more_filtered_posts" class="wp-block-button__link" data-per-page="' . $posts_per_page . '" data-category="0" data-search="" data-page-number="1">Load more</button>
</div>';
        $response .= '</div>';

        wp_reset_postdata();
    }

    return $response;

}

/**
 * Ajax load more
 */
add_action('wp_ajax_nopriv_more-filtered-posts', 'more_filtered_posts');
add_action('wp_ajax_more-filtered-posts', 'more_filtered_posts');
function more_filtered_posts()
{

    if (isset($_POST['cat_id'])) {
        $cat_id = $_POST['cat_id'];
    }
    if (isset($_POST['per_page'])) {
        $per_page = $_POST['per_page'];
    }
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
    }
    if (isset($_POST['page_num'])) {
        $paged = $_POST['page_num'];
    }

    $args = array(
        'suppress_filters' => true,
        'post_type' => 'post',
        'posts_per_page' => $per_page,
        'cat' => $cat_id,
        'paged' => $paged,
    );

    if ($search) {
        $args['s'] = $search;
    }

    $loop = new WP_Query($args);

    //var_dump($loop);

    $articles = '';

    if ($loop->have_posts()) {
        while ($loop->have_posts()) : $loop->the_post();
            $post_id = get_the_ID();
            $cats = get_the_category($post_id);

            $articles .= '<div class="article-item">';
            $articles .= '<a href="' . get_the_permalink($post_id) . '"><img src=' . get_the_post_thumbnail_url($post_id) . '></a>';
            $articles .= '<div class="article-item-category"><a href="' . get_category_link($cats[0]->cat_ID) . '">' . $cats[0]->name . '</a></div>';
            $articles .= '<h4>' . get_the_title($post_id) . '</h4>';
            $articles .= '<a href="' . get_the_permalink($post_id) . '" class="wp-block-button__link has-ast-global-color-1-color has-ast-global-color-0-background-color has-text-color has-background">Read more</a>';
            $articles .= '</div>';

        endwhile;
    } else {
        $articles = 'No more posts';
    }
    $response['articles'] = $articles;

    // Check if there are any more pages to query and pass the boolean value in response
    $response['more_pages'] = ( ( $loop->max_num_pages - $paged ) > 0 ) ? true : false;

    $result = json_encode($response);

    wp_reset_postdata();
    die($result);
}
