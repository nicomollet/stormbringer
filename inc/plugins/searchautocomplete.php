<?php

// Redeclare Jquery UI for WP Rocket compatibility
function searchautocomplete_dequeue_scripts() {
    if ( class_exists('SearchAutocomplete')) :
        wp_enqueue_script( 'jquery-ui' );
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script( 'jquery-ui-widget' );
        wp_enqueue_script( 'jquery-ui-menu' );
        wp_enqueue_script( 'jquery-ui-position' );
        wp_enqueue_script( 'jquery-ui-autocomplete' );
        wp_enqueue_script( 'wp-a11y' );
    endif;
}
add_action( 'wp_enqueue_scripts', 'searchautocomplete_dequeue_scripts' );