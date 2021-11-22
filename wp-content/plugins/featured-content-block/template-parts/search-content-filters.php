<?php
$terms = get_terms(array(
        'hide_empty' => true,
        'taxonomy' => 'category',
    )
);

if ($terms && !is_wp_error($terms)) {
    $terms_response = '<div class="search-content-filter-wrapper"><ul>';
    foreach ($terms as $term) {
        $terms_response .= '<li class="filter-category-item" data-term-id="' . $term->term_id . '">' . $term->name . '</li>';

    }
    $terms_response .= '</ul>';
    $terms_response .= '<div class="filtered-content-search-wrapper">';
    $terms_response .= '<label for="filtered_post_search">Search:</label>
                        <input type="search" id="filtered_post_search" name="q" aria-label="Search through posts">
                        <button id="search_btn_filterd">Search</button>';
    $terms_response .= '</div>';
    $terms_response .= '</div>';
}
return $terms_response;