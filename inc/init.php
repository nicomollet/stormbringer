<?php

// Cuztom
add_action( 'init', 'stormbringer_meta');
function stormbringer_meta() {

    $cuztom = get_theme_mod('cuztom');
    if($cuztom){
        $taxonomy = new Cuztom_Taxonomy( 'Category', ['post']);

        $taxonomy->add_term_meta(
            [
                [
                    'name'  => 'bottom_description',
                    'label' => 'Bottom description',
                    'type'  => 'wysiwyg',
                    'args'  => ['editor_height' => 300],
                ],
                [
                    'id'    => 'featured_image',
                    'type'  => 'image',
                    'label' => 'Image à la Une',
                ]
            ]
        );

    }
}

// Support
function stormbringer_support() {

	add_theme_support( 'automatic-feed-links' );               // RSS feeds
	add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );

    // Cuztom
    $cuztom = get_theme_mod('cuztom');
	if($cuztom){
		locate_template( 'inc/library/cuztom/cuztom.php', true );         // Cuztom library
        /*$taxonomy = new Cuztom_Taxonomy( 'Category', 'post');
        $taxonomy->add_term_meta (
            array(
                array(
                    'name'        => 'bottom_description',
                    'label'       => 'Bottom description',
                    'type'        => 'wysiwyg',
                    'args'        => ['editor_height' => 500],
                )
            )
        );*/
	}

	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
		add_theme_support( 'woocommerce' );
	}

	locate_template( 'inc/front/thumbnails.php', true );       // Thumbnails for Bootstrap
	locate_template( 'inc/admin/profile.php', true );          // Profile fields
	locate_template( 'inc/admin/customizer.php', true );       // Customizer

	locate_template( 'inc/front/owlcarousel.php', true );    // Load OwlCarousel shortcode

	// Admin only
	if ( is_admin() ) {
		locate_template( 'inc/admin/cleanup.php', true );        // Clean admin
		locate_template( 'inc/admin/htmleditor.php', true );     // HTML editor Bootstrap styles
		locate_template( 'inc/admin/humility.php', true );       // Menu Humility: reorders admin menus
	}

	// Front only
	if ( ! is_admin() ) {
		locate_template( 'inc/front/gruntassets.php', true );    // Grunt Assets
		locate_template( 'inc/front/styles.php', true );         // Load CSS
		locate_template( 'inc/front/scripts.php', true );        // Load BJS
		locate_template( 'inc/front/carousel.php', true );       // Load Carousel shortcode

		locate_template( 'inc/front/cleanup.php', true );        // Cleanup frontend
		locate_template( 'inc/front/bodyclass.php', true );      // Body classes
		locate_template( 'inc/front/comments.php', true );       // Comments function
		locate_template( 'inc/front/favicon.php', true );        // Favicon
		locate_template( 'inc/front/webfonts.php', true );
		locate_template( 'inc/front/addthis.php', true );

		locate_template( 'inc/front/shortcodes.php', true );     // Shortcodes for Bootstrap: alert, badge, label, button, gallery
		$preprocessor = get_theme_mod('bootstrap_preprocessor', true);
		if($preprocessor === 'less'){
			locate_template( 'inc/library/lessphp-oyejorge.php', true ); // Lessphp-Oyejorge library
		}

		locate_template( 'inc/front/menu.php', true );           // Menu walker for Bootstrap nav
		locate_template( 'inc/front/widgets.php', true );        // Widgets cleanup

	}

	// Plugins
	if ( class_exists( 'RGForms' ) ) {// Gravity Forms compatibility with Boostrap
		locate_template( 'inc/plugins/gravityforms.php', true );
	}
	if ( function_exists( 'icl_object_id' ) && ! is_admin() ) {// WPML switcher for Boostrap + cleanup styles
		locate_template( 'inc/plugins/wpml.php', true );
	}
	if ( class_exists( 'Theme_My_Login' ) ) {// Theme My Login custom titles and custom pages
		locate_template( 'inc/plugins/thememylogin.php', true );
	}
	if (current_theme_supports('woocommerce')) {// Woocommerce custom titles and custom pages
		locate_template( 'inc/plugins/woocommerce.php', true );
	}
	if (class_exists( 'JetPack' )) {// Jetpack cleanup
		locate_template( 'inc/plugins/jetpack.php', true );
	}
	if (class_exists( 'BackWPup' )) {// Backwpup cleanup
		locate_template( 'inc/plugins/backwpup.php', true );
	}
	if (class_exists( 'ITSEC_Core' )) {// iThemes Security cleanup
		locate_template( 'inc/plugins/security.php', true );
	}
	if (class_exists( 'WPSEO_Admin' )) {// SEO cleanup
		locate_template( 'inc/plugins/seo.php', true );
	}
	if (class_exists( 'W3_Root' )) {// Cache cleanup
		locate_template( 'inc/plugins/performance.php', true );
	}

	load_theme_textdomain( 'stormbringer', get_template_directory() . '/lang' );

	$locale      = get_locale();
	$locale_file = get_template_directory() . "/lang/$locale.php";
	if ( is_readable( $locale_file ) ) {
		require_once( $locale_file );
	}

	stormbringer_register_menus();            // WP menus

	// Force JS to load in the footer
	if ( !is_admin() ) {
		//remove_action('wp_head', 'wp_print_scripts');
		//remove_action('wp_head', 'wp_print_head_scripts', 9);
		//add_action('wp_footer', 'wp_print_scripts', 5);
		//add_action('wp_footer', 'wp_enqueue_scripts', 5);
	}

}
add_action( 'after_setup_theme', 'stormbringer_support' );

// Sidebars
function stormbringer_register_sidebars() {

	register_sidebar(array(
		'id' => 'sidebar_main',
		'name' => 'Main Sidebar',
		'description' => 'Left sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'id' => 'footer_widgets',
		'name' => 'Footer Widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'id' => 'sidebar_blog',
		'name' => 'Blog Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'id' => 'sidebar_home',
		'name' => 'Home Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

}
add_action('widgets_init', 'stormbringer_register_sidebars' );

// Menus
function stormbringer_register_menus() {

	register_nav_menus(
		array(
			'main_nav' => 'The Main Menu',    // main nav in header
			'footer_links' => 'Footer Links', // secondary nav in footer
		)
	);

}