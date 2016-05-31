<?php

// Jetpack: remove sharing filters
function jptweak_remove_share() {

	remove_filter( 'the_content', 'sharing_display',19 );
	remove_filter( 'the_excerpt', 'sharing_display',19 );

	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30 );
	}
}
add_action( 'loop_start', 'jptweak_remove_share' );

//Remove Jetpack Sharing
function minify_jetpack_sharing_js() {
    remove_action( 'wp_footer', 'sharing_add_footer' );
    add_action( 'wp_footer', 'sharing_add_footer', 100 );
}
add_action( 'wp_footer', 'minify_jetpack_sharing_js', 5 );

// Remove Jetpack modules
function jetpack_remove_modules ( $modules ) {
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
add_filter( 'jetpack_get_available_modules', 'jetpack_remove_modules' );

// Disable Jetpack Javascript
function jetpack_dequeue_scripts() {
    wp_dequeue_script( 'devicepx' );
    wp_dequeue_script( 'wp_rp_edit_related_posts_js' );
}
add_action( 'wp_enqueue_scripts', 'jetpack_dequeue_scripts', 20 );

// Disable Jetpack Styles
function jetpack_dequeue_styles() {
    wp_dequeue_script( 'wp_rp_edit_related_posts_css' );
}
add_action( 'wp_enqueue_styles', 'jetpack_dequeue_styles', 20 );
