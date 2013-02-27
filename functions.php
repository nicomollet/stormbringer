<?php

// Adding WP 3+ Functions & Theme Support
function stormbringer_support() {

  locate_template('inc/admin/secure.php',true);
  locate_template('inc/front/thumbnails.php',true);

  // Admin only
  if(is_admin()){
    locate_template('inc/admin/htmleditor.php',true);
    locate_template('inc/admin/profile.php',true);
  }

  // Front only
  locate_template('inc/front/bootstrap.php',true);
  locate_template('inc/front/addthis.php',true);
  locate_template('inc/front/fancybox.php',true);
  locate_template('inc/plugins/gravityforms.php',true);
  locate_template('inc/front/cleanup.php',true);
  locate_template('inc/front/bodyclass.php',true);
  locate_template('inc/front/breadcrumb.php',true);
  locate_template('inc/front/comments.php',true);
  locate_template('inc/front/favicon.php',true);
  locate_template('inc/front/googlewebfonts.php',true);
  locate_template('inc/front/shortcodes.php',true);
  locate_template('inc/library/lessc.inc.php',true);
  locate_template('inc/front/menu.php',true);
  locate_template('inc/front/pagination.php',true);
  locate_template('inc/front/widgets.php',true);
  locate_template('inc/front/tags.php',true);

  // Plugins
  if (class_exists('RGForms') && !is_admin()) locate_template('inc/plugins/wpml.php',true);
  if(function_exists('icl_object_id') && !is_admin()) locate_template('inc/plugins/wpml.php',true);

  load_theme_textdomain( 'stormbringer', get_template_directory() . '/lang' );

  $locale = get_locale();
  $locale_file = get_template_directory() . "/lang/$locale.php";
  if ( is_readable( $locale_file ) )
    require_once( $locale_file );

	add_theme_support('automatic-feed-links'); // rss thingy
  add_theme_support( 'post-thumbnails' );
	stormbringer_register_menus();            // wp menus
}
add_action('after_setup_theme','stormbringer_support');
add_action('widgets_init', 'custom_register_sidebars' );

// ********************************************
// Variables
// ********************************************


define('BOOTSTRAP_RESPONSIVE', true);

define("POST_EXCERPT_LENGTH", 100);

define("JQUERY_VERSION", "1.7.1");
//define("ADDTHIS_PROFILE", "ra-502e8ca67b06ffb4");

define("FANCYBOX", true);

define("GOOGLE_WEBFONTS", serialize(array('Montserrat:400','Dancing Script:400')));


// ********************************************
// Thumbnails
// ********************************************
//add_image_size( 'mini', 80, 80 );

// ********************************************
// Breadcrumb
// ********************************************
function custom_breadcrumb_trail_args(){
  $args = array(
    'separator' => '›',
    'before' => '' ,
    'after' => false,
    'front_page' => true,
    'show_home' => __( 'Accueil', "stormbringer" ),
    'echo' => true
  );
  return $args;
}
add_filter('breadcrumb_trail_args', 'custom_breadcrumb_trail_args');


// ********************************************
// Sidebars
// ********************************************
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


// ********************************************
// Menus
// ********************************************
function stormbringer_register_menus() {
	register_nav_menus(                      // wp3+ menus
		array(
			'main_nav' => 'The Main Menu',   // main nav in header
			'footer_links' => 'Footer Links', // secondary nav in footer
		)
	);
}



// ********************************************
// JS footer
// ********************************************
function custom_js_footer() {
  wp_enqueue_script('jquery.cycle.js', get_template_directory_uri().'/js/jquery.cycle.js', array(),false, true );
  wp_enqueue_script('jquery.easing.js', get_template_directory_uri().'/js/jquery.easing.js', array(),false, true );
  //wp_enqueue_script('jquery.slideleft.js', get_template_directory_uri().'/js/jquery.slideleft.js', array(),false, true );
  //wp_enqueue_script('jquery.mousewheel.js', get_template_directory_uri().'/js/jquery.mousewheel.js', array(),false, true );
  //wp_enqueue_script('jquery.validate.js', get_template_directory_uri().'/js/jquery.validate.js', array(),false, true );
  //wp_enqueue_script('curvycorners.js', get_template_directory_uri().'/js/curvycorners.js', array(),false, true );
  //wp_enqueue_script('selectivizr.js', get_template_directory_uri().'/js/selectivizr.js', array(),false, true );
}
add_action('wp_enqueue_scripts', 'custom_js_footer',300);

// ********************************************
// HTML editor styles
// ********************************************
function custom_tinymce_styles( $settings ) {

    $style_formats_original = json_decode($settings['style_formats']);
    $style_formats = array(
        array(
        	'title' => 'Color Red',
        	'inline' => 'span',
        	'classes' => 'red',
        ),
        array(
        	'title' => 'Color Blue',
        	'inline' => 'span',
        	'classes' => 'blue',
        ),

    );

    $settings['style_formats'] = json_encode( array_merge($style_formats,$style_formats_original) );

    return $settings;

}
add_filter( 'tiny_mce_before_init', 'custom_tinymce_styles',100 );

// ********************************************
// Content container classes
// ********************************************

function custom_sidebar_container_class($class){
    $class = 'span3';
  return $class;
}
add_filter( 'stormbringer_sidebar_container_class', 'custom_sidebar_container_class',100 );

function custom_content_container_class($class){
  $class = 'span9';
  return $class;
}
add_filter( 'stormbringer_content_container_class', 'custom_content_container_class',100 );


// ********************************************
// SEO Title
// ********************************************

function stormbringer_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() )
    return $title;

  // Add the site name.
  $title .= get_bloginfo( 'name' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 )
    $title = "$title $sep " . sprintf( __( 'Page %s', 'stormbringer' ), max( $paged, $page ) );

  return $title;
}
add_filter( 'wp_title', 'stormbringer_wp_title', 10, 2 );

// ********************************************
// Addthis
// ********************************************
add_action( 'stormbringer_content_after', 'share_addthis', 10, 2 );
function share_addthis(){
  if((!is_home() && is_singular('post')) || is_category() || is_archive()){
    echo  '
    <div class="addthis_toolbox addthis_default_style"><a class="addthis_button_facebook"></a><a class="addthis_button_twitter"></a><a class="addthis_button_compact"></a><a class="addthis_button_email"></a>
    </div>
    ';
  }
}
