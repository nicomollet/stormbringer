<?php


/**
 * Bottom description
 */
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
//add_action( 'init', 'stormbringer_meta');

/**
 * Stormbringer support
 */
function stormbringer_support() {

	locate_template( 'inc/front/thumbnails.php', true );       // Thumbnails for Bootstrap
	locate_template( 'inc/admin/customizer.php', true );       // Customizer

	locate_template( 'inc/front/owlcarousel.php', true );    // Load OwlCarousel shortcode

	// Admin only
	if ( is_admin() ) {
		locate_template( 'inc/admin/htmleditor.php', true );     // HTML editor Bootstrap styles
	}

	// Front only
	if ( ! is_admin() ) {
		locate_template( 'inc/front/gruntassets.php', true );    // Grunt Assets
		locate_template( 'inc/front/styles.php', true );         // Load CSS
		locate_template( 'inc/front/scripts.php', true );        // Load BJS
		locate_template( 'inc/front/carousel.php', true );       // Load Carousel shortcode

		locate_template( 'inc/front/helpers.php', true );        // Helpers
		locate_template( 'inc/front/password.php', true );       // Password
		locate_template( 'inc/front/bodyclass.php', true );      // Body classes
		locate_template( 'inc/front/comments.php', true );       // Comments function
		locate_template( 'inc/front/favicon.php', true );        // Favicon
		locate_template( 'inc/front/webfonts.php', true );
		locate_template( 'inc/front/addthis.php', true );
		locate_template( 'inc/front/shortcodes.php', true );     // Shortcodes for Bootstrap: alert, badge, label, button, gallery


		locate_template( 'inc/front/menu.php', true );           // Menu walker for Bootstrap nav
	}

	// Plugins
	if ( class_exists( 'RGForms' ) ) {// Gravity Forms compatibility with Boostrap
		locate_template( 'inc/plugins/gravityforms.php', true );
	}
	if ( class_exists( 'Theme_My_Login' ) ) {// Theme My Login custom titles and custom pages
		locate_template( 'inc/plugins/thememylogin.php', true );
	}
	if ( class_exists( 'WooCommerce' ) ) {// Woocommerce
		add_theme_support('woocommerce');
		locate_template( 'inc/plugins/woocommerce.php', true );
	}
    
	// Cuztom
    if(get_theme_mod('cuztom')){
        locate_template( 'inc/library/cuztom/cuztom.php', true );
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
	    // Next 4 comments remove for WP Rocket compatibility. WP Rocket needs to find $wp_scripts->in_footer in order to automaticly place minified JS
		//remove_action('wp_head', 'wp_print_scripts');
		//remove_action('wp_head', 'wp_print_head_scripts', 9);
		//add_action('wp_footer', 'wp_print_scripts', 5);
		//add_action('wp_footer', 'wp_enqueue_scripts', 5);
	}

}
add_action( 'after_setup_theme', 'stormbringer_support' );

/**
 * Sidebars
 */
function stormbringer_register_sidebars() {


	$sidebar_args['sidebar'] = array(
		'name'          => __( 'Sidebar', 'stormbringer' ),
		'id'            => 'sidebar',
		'description'   => ''
	);

	$sidebar_args['navigation_above'] = array(
		'name'          => __( 'Above Navigation', 'stormbringer' ),
		'id'            => 'navigation-above',
		'description'   => ''
	);

	$sidebar_args['navigation_below'] = array(
		'name'          => __( 'Below Navigation', 'stormbringer' ),
		'id'            => 'navigation-below',
		'description'   => ''
	);

	$header_above_widget_regions = apply_filters('stormbringer_footer_above_widget_regions', 1);
	$header_widget_regions       = apply_filters('stormbringer_footer_widget_regions', 1);
	$header_below_widget_regions = apply_filters('stormbringer_footer_below_widget_regions', 1);

	$footer_above_widget_regions = apply_filters('stormbringer_footer_above_widget_regions', 1);
	$footer_widget_regions       = apply_filters('stormbringer_footer_widget_regions', 1);
	$footer_below_widget_regions = apply_filters('stormbringer_footer_below_widget_regions', 1);


	// Above Header
	for ( $i = 1; $i <= intval( $header_above_widget_regions ); $i++ ) {
		$region = sprintf( 'header_above_%d', $i );

		$sidebar_args[ $region ] = array(
			'name'        => sprintf( __( 'Above Header %d', 'stormbringer' ), $i ),
			'id'          => sprintf( 'header-above-%d', $i ),
			'description' => sprintf( __( 'Widgetized Above Header Region %d.', 'stormbringer' ), $i )
		);
	}

	// Header
	for ( $i = 1; $i <= intval( $header_widget_regions ); $i++ ) {
		$region = sprintf( 'header_%d', $i );

		$sidebar_args[ $region ] = array(
			'name'        => sprintf( __( 'Header %d', 'stormbringer' ), $i ),
			'id'          => sprintf( 'header-%d', $i ),
			'description' => sprintf( __( 'Widgetized Header Region %d.', 'stormbringer' ), $i )
		);
	}

	// Below Header
	for ( $i = 1; $i <= intval( $header_below_widget_regions ); $i++ ) {
		$region = sprintf( 'header_below_%d', $i );

		$sidebar_args[ $region ] = array(
			'name'        => sprintf( __( 'Below Header %d', 'stormbringer' ), $i ),
			'id'          => sprintf( 'header-below-%d', $i ),
			'description' => sprintf( __( 'Widgetized Below Header Region %d.', 'stormbringer' ), $i )
		);
	}

	// Above Footer
	for ( $i = 1; $i <= intval( $footer_above_widget_regions ); $i++ ) {
		$region = sprintf( 'footer_above_%d', $i );

		$sidebar_args[ $region ] = array(
			'name'        => sprintf( __( 'Above Footer %d', 'stormbringer' ), $i ),
			'id'          => sprintf( 'footer-above-%d', $i ),
			'description' => sprintf( __( 'Widgetized Above Footer Region %d.', 'stormbringer' ), $i )
		);
	}

	//Footer
	for ( $i = 1; $i <= intval( $footer_widget_regions ); $i++ ) {
		$region = sprintf( 'footer_%d', $i );

		$sidebar_args[ $region ] = array(
			'name'        => sprintf( __( 'Footer %d', 'stormbringer' ), $i ),
			'id'          => sprintf( 'footer-%d', $i ),
			'description' => sprintf( __( 'Widgetized Footer Region %d.', 'stormbringer' ), $i )
		);
	}

	// Below Footer
	for ( $i = 1; $i <= intval( $footer_below_widget_regions ); $i++ ) {
		$region = sprintf( 'footer_below_%d', $i );

		$sidebar_args[ $region ] = array(
			'name'        => sprintf( __( 'Below Footer %d', 'stormbringer' ), $i ),
			'id'          => sprintf( 'footer-below-%d', $i ),
			'description' => sprintf( __( 'Widgetized Below Footer Region %d.', 'stormbringer' ), $i )
		);
	}

	foreach ( $sidebar_args as $sidebar => $args ) {
		$widget_tags = array(
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		);

		/**
		 * Dynamically generated filter hooks. Allow changing widget wrapper and title tags. See the list below.
		 *
		 *
		 * stormbringer_header_above_1_widget_tags
		 * stormbringer_header_above_2_widget_tags
		 * stormbringer_header_above_3_widget_tags
		 * stormbringer_header_above_4_widget_tags
		 *
		 * stormbringer_header_1_widget_tags
		 * stormbringer_header_2_widget_tags
		 * stormbringer_header_3_widget_tags
		 * stormbringer_header_4_widget_tags
		 *
		 * stormbringer_header_below_1_widget_tags
		 * stormbringer_header_below_2_widget_tags
		 * stormbringer_header_below_3_widget_tags
		 * stormbringer_header_below_4_widget_tags
		 *
		 * stormbringer_sidebar_widget_tags
		 *
		 * stormbringer_footer_above_1_widget_tags
		 * stormbringer_footer_above_2_widget_tags
		 * stormbringer_footer_above_3_widget_tags
		 * stormbringer_footer_above_4_widget_tags
		 *
		 * stormbringer_footer_1_widget_tags
		 * stormbringer_footer_2_widget_tags
		 * stormbringer_footer_3_widget_tags
		 * stormbringer_footer_4_widget_tags
		 *
		 * stormbringer_footer_below_1_widget_tags
		 * stormbringer_footer_below_2_widget_tags
		 * stormbringer_footer_below_3_widget_tags
		 * stormbringer_footer_below_4_widget_tags
		 *
		 *
		 */
		$filter_hook = sprintf( 'stormbringer_%s_widget_tags', $sidebar );
		$widget_tags = apply_filters( $filter_hook, $widget_tags );

		if ( is_array( $widget_tags ) ) {
			register_sidebar( $args + $widget_tags );
		}
	}

	/*
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
	));*/

	register_sidebar(array(
		'id' => 'sidebar_shop',
		'name' => 'Shop Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

}
add_action('widgets_init', 'stormbringer_register_sidebars' );


/**
 * Register menus
 */
function stormbringer_register_menus() {

	register_nav_menus(
		array(
			'main_nav' => 'The Main Menu',    // main nav in header
			'footer_links' => 'Footer Links', // secondary nav in footer
		)
	);

}


