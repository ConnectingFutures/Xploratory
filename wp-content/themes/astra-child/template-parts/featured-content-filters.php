<?php
$terms = get_terms(array(
        'hide_empty' => true,
        'taxonomy' => $args[ 'taxonomy' ],
        'include' => $args[ 'terms_id' ],
    )
);

if ($terms && !is_wp_error($terms)) {
    $terms_response = '<div class="featured-content-filter-wrapper"><ul>';
    foreach ($terms as $term) {
        $terms_response .= '<li class="filter-term-item" data-term-id="' . $term->term_id . '">' . $term->name . '</li>';

    }
    $terms_response .= '</ul></div>';
}
echo $terms_response;