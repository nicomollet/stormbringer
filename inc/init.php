<?php

function stormbringer_support() {

	add_theme_support( 'automatic-feed-links' ); // rss thingy
	add_theme_support( 'post-thumbnails' );
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
		add_theme_support( 'woocommerce' );
	}

	locate_template( 'inc/front/secure.php', true );           // Secure Wordpress
	locate_template( 'inc/front/thumbnails.php', true );       // Thumbnails for Bootstrap
	locate_template( 'inc/admin/profile.php', true );          // Profile fields

	// Admin only
	if ( is_admin() ) {
		locate_template( 'inc/admin/cleanup.php', true );        // Clean admin
		locate_template( 'inc/admin/htmleditor.php', true );     // HTML editor Bootstrap styles
		locate_template( 'inc/admin/htaccess.php', true );       // HTML5 Boilerplate htaccess for Apache
	}

	// Front only
	if ( ! is_admin() ) {
		if ( defined( 'GOOGLE_ANALYTICS' ) &&
		     GOOGLE_ANALYTICS != '' ) {                          // Analytics tracking code
			locate_template( 'inc/front/analytics.php', true );
		}

		locate_template( 'inc/front/preprocessor.php', true );   // Load Bootstrap LESS or CSS
		locate_template( 'inc/front/libraries.php', true );      // JS & CSS libraries

		locate_template( 'inc/front/carousel.php', true );       // Load Carousel shortcode
		locate_template( 'inc/front/cleanup.php', true );        // Cleanup frontend
		locate_template( 'inc/front/bodyclass.php', true );      // Body classes
		locate_template( 'inc/front/breadcrumb.php', true );     // Breadcrumb
		locate_template( 'inc/front/comments.php', true );       // Comments function

		if ( current_theme_supports('google-webfonts')) {        // Google Web fonts
			locate_template( 'inc/front/googlewebfonts.php', true );
		}
		locate_template( 'inc/front/shortcodes.php', true );     // Shortcodes for Bootstrap: alert, badge, label, button, gallery
	  //locate_template('inc/library/lessphp.php',true);      // Lessphp library
		locate_template( 'inc/library/lessphp-oyejorge.php', true );      // Lessphp-Oyejorge library
		locate_template( 'inc/front/menu.php', true );           // Menu walker for Bootstrap nav
		locate_template( 'inc/front/pagination.php', true );     // Pagination for Boostrap
		locate_template( 'inc/front/widgets.php', true );        // Widgets cleanup

	}

	// Plugins
	if ( class_exists( 'RGForms' ) ) {// Gravity Forms compatibility with Boostrap
		locate_template( 'inc/plugins/gravityforms.php', true );
	}
	if ( function_exists( 'icl_object_id' ) && ! is_admin() ) {// WPML switcher for Boostrap + cleanup styles
		locate_template( 'inc/plugins/wpml.php', true );
	}
	if ( class_exists( 'Theme_My_Login' ) && ! is_admin() && current_theme_supports('thememylogin') ) {// Theme My Login custom titles and custom pages
		locate_template( 'inc/plugins/thememylogin.php', true );
	}
	if (current_theme_supports('woocommerce')) {// Woocommerce custom titles and custom pages
		locate_template( 'inc/plugins/woocommerce.php', true );
	}

	load_theme_textdomain( 'stormbringer', get_template_directory() . '/lang' );

	$locale      = get_locale();
	$locale_file = get_template_directory() . "/lang/$locale.php";
	if ( is_readable( $locale_file ) ) {
		require_once( $locale_file );
	}

	stormbringer_register_menus();            // wp menus
}
add_action( 'after_setup_theme', 'stormbringer_support' );


function custom_register_sidebars() {

	register_sidebar(array(
		'id' => 'sidebar_main',
		'name' => 'Main Sidebar',
		'description' => 'Left sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'id' => 'footer_widgets',
		'name' => 'Footer Widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'id' => 'sidebar_blog',
		'name' => 'Blog Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'id' => 'sidebar_home',
		'name' => 'Home Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

}
add_action('widgets_init', 'custom_register_sidebars' );


function stormbringer_register_menus() {

	register_nav_menus(
		array(
			'main_nav' => 'The Main Menu',    // main nav in header
			'footer_links' => 'Footer Links', // secondary nav in footer
		)
	);

}