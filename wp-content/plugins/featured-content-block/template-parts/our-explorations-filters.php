<?php
$terms = get_terms(array(
        'hide_empty' => true,
        'taxonomy' => 'site_begin_category',
    )
);

if ($terms && !is_wp_error($terms)) {
    $terms_response = '<div class="our-explorations-filter-wrapper"><ul>';
    $terms_response .= '<li class="filter-category-item" data-term-id="0">All</li>';
    foreach ($terms as $term) {
        $terms_response .= '<li class="filter-category-item" data-term-id="' . $term->term_id . '">' . $term->name . '</li>';
    }
    $terms_response .= '</ul>';
    $terms_response .= '</div>';
}
return $terms_response;