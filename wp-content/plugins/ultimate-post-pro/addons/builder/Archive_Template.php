<?php
defined( 'ABSPATH' ) || exit;

get_header();

do_action( 'ultp_before_content' );

$page_id = ultimate_post_pro()->conditions('return');

$width = get_post_meta($page_id, '__container_width', true);

if ($width) {
    echo '<div class="ultp-builder-container" style="max-width: '.$width.'px;">';
}

if ($page_id) {
    ultimate_post_pro()->content($page_id);
}

if ($width) {
    echo '</div>';
}

do_action( 'ultp_after_content' );

get_footer();