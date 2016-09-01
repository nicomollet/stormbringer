<?php

// Jetpack: remove sharing filters
function stormbringer_jetpack_remove_share() {

	remove_filter( 'the_content', 'sharing_display',19 );
	remove_filter( 'the_excerpt', 'sharing_display',19 );

	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30 );
	}
}
add_action( 'loop_start', 'stormbringer_jetpack_remove_share' );

//Remove Jetpack Sharing
function minify_jetpack_sharing_js() {
    if ( function_exists( 'sharing_display' ) ) {
        remove_action( 'wp_footer', 'sharing_add_footer' );
        add_action( 'wp_footer', 'sharing_add_footer', 100 );
    }
}
add_action( 'wp_footer', 'minify_jetpack_sharing_js', 5 );

// Remove Jetpack modules
function stormbringer_jetpack_remove_modules ( $modules ) {
    unset( $modules['contact-form'] );
    unset( $modules['markdown'] );
    unset( $modules['verification-tools'] );
    unset( $modules['custom-content-types'] );
    unset( $modules['minileven'] );
    unset( $modules['gravatar-hovercards'] );
    unset( $modules['shortlinks'] );
    unset( $modules['videopress'] );
    unset( $modules['vaultpress'] );
    unset( $modules['subscriptions'] );
    unset( $modules['after-the-deadline'] );
    unset( $modules['sso'] );
    unset( $modules['post-by-email'] );
    unset( $modules['site-icon'] );
    unset( $modules['custom-css'] );
    unset( $modules['holiday-snow'] );

    return $modules;
}
add_filter( 'jetpack_get_available_modules', 'stormbringer_jetpack_remove_modules' );

// Jetpack disable all default modules
add_filter( 'jetpack_get_default_modules', '__return_empty_array' );

// Disable Jetpack Javascript
function stormbringer_jetpack_dequeue_scripts() {
    wp_dequeue_script( 'devicepx' );
    wp_dequeue_script( 'wp_rp_edit_related_posts_js' );

    wp_deregister_script( 'jquery.spin' );
    wp_deregister_script( 'spin' );
    // Jetpack Jquery spin if carousel ou infinitescroll
    if ( class_exists('Jetpack_Carousel') || class_exists('The_Neverending_Home_Page')) :
        wp_register_script( 'spin', plugins_url( 'jetpack/_inc/spin.js', 'jetpack' ), false, null, true );
        wp_register_script( 'jquery.spin', plugins_url( 'jetpack/_inc/jquery.spin.js', 'jetpack' ) , array( 'jquery', 'spin' ), null, true );
    endif;

    // Jetpack Tiled Gallery
    wp_dequeue_script( 'tiled-gallery' );
    if ( class_exists('Jetpack_Tiled_Gallery') && get_option( 'tiled_galleries' )) :
        wp_enqueue_script( 'tiled-gallery', plugins_url( 'jetpack/modules/tiled-gallery/tiled-gallery/tiled-gallery.js', 'jetpack' ), array( 'jquery' ), null, true );
    endif;

    // Jetpack Carousel
    wp_dequeue_script( 'jetpack-carousel' );
    if ( class_exists('Jetpack_Carousel')) :
        wp_enqueue_script( 'jetpack-carousel', plugins_url( 'jetpack/modules/carousel/jetpack-carousel.js', 'jetpack' ), array( 'jquery.spin' ), null, true );
    endif;

}
add_action( 'wp_enqueue_scripts', 'stormbringer_jetpack_dequeue_scripts', 20 );

// Disable Jetpack Styles
function stormbringer_jetpack_dequeue_styles() {
    wp_dequeue_script( 'wp_rp_edit_related_posts_css' );
}
add_action( 'wp_enqueue_styles', 'stormbringer_jetpack_dequeue_styles', 20 );

// Disable Jetpack Tiled Galery JS
function stormbringer_kill_spin() {
    wp_deregister_script( 'jquery.spin' );
    wp_deregister_script( 'spin' );
}
add_action( 'wp_loaded', 'stormbringer_kill_spin', 11 );