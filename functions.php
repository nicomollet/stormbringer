<?php

add_theme_support( 'woocommerce' );

// ********************************************
// Variables
// ********************************************

define('H5BP_HTACCESS', true);
define('BOOTSTRAP_RESPONSIVE', true);
define("POST_EXCERPT_LENGTH", 100);
define("ADDTHIS_PROFILE", '');
define("LIGHTBOX", 'tbmodal'); // tbmodal or fancybox
define("GOOGLE_ANALYTICS", '');
define("GOOGLE_WEBFONTS", serialize(array('Montserrat:400','Dancing Script:400')));
define('WP_POST_REVISIONS', 2); // Keep only 2 revisions (including the autosave)
define('AUTOSAVE_INTERVAL', 900 ); // Autosave every 15 minutes


// ********************************************
// Theme Support
// ********************************************
function stormbringer_support() {

  locate_template('inc/front/secure.php',true);           // Secure Wordpress
  locate_template('inc/front/thumbnails.php',true);       // Thumbnails for Bootstrap
  locate_template('inc/admin/profile.php',true);          // Profile fields
  locate_template('inc/front/twitter.php',true);          // Twitter widget

  // Admin only
  if(is_admin()){
    locate_template('inc/admin/cleanup.php',true);        // Clean admin
    locate_template('inc/admin/htmleditor.php',true);     // HTML editor Bootstrap styles
    locate_template('inc/admin/htaccess.php',true);       // HTML%Boilerplate htaccess for Apache
  }

  // Front only
  if(!is_admin()){
    if(defined('GOOGLE_ANALYTICS') && GOOGLE_ANALYTICS!='')
      locate_template('inc/front/analytics.php',true);    // Analytics tracking code
    locate_template('inc/front/bootstrap.php',true);      // Load Bootstrap LESS or CSS
    locate_template('inc/front/carousel.php',true);       // Load Carousel shortcode

    locate_template('inc/front/addthis.php',true);        // Sharing with Addthis
    locate_template('inc/front/cleanup.php',true);        // Cleanup frontend
    locate_template('inc/front/bodyclass.php',true);      // Body classes
    locate_template('inc/front/breadcrumb.php',true);     // Breadcrumb
    locate_template('inc/front/comments.php',true);       // Comments function
    locate_template('inc/front/googlewebfonts.php',true); // Google Web fonts
    locate_template('inc/front/shortcodes.php',true);     // Shortcodes for Bootstrap: alert, badge, label, button, gallery
    locate_template('inc/library/lessphp.php',true);      // LessCss library
    locate_template('inc/front/menu.php',true);           // Menu walker for Bootstrap nav
    locate_template('inc/front/pagination.php',true);     // Pagination for Boostrap
    locate_template('inc/front/widgets.php',true);        // Widgets cleanup

  }

  // Plugins
  if(class_exists('RGForms') && !is_admin()) locate_template('inc/plugins/gravityforms.php',true); // Gravity Forms compatibility with Boostrap
  if(function_exists('icl_object_id') && !is_admin()) locate_template('inc/plugins/wpml.php',true); // WPML switcher for Boostrap + cleanup styles
  if(class_exists( 'Theme_My_Login') && !is_admin()) locate_template('inc/plugins/thememylogin.php',true); // Theme My Login custom titles and custom pages

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
// Thumbnails
// ********************************************
//add_image_size( 'mini', 80, 80 );

// ********************************************
// Breadcrumb
// ********************************************
function custom_breadcrumb_trail_args(){
  $args = array(
    'separator' => '›', //Separator text
    'before' => '' , // HTML displayed before
    'after' => false, // HTML displayed after
    'front_page' => true, // Display the homepage link
    'show_home' => __( 'Accueil', "stormbringer" ), // Homepage text link
    'echo' => true // Echo or not
  );
  return $args;
}
add_filter('breadcrumb_trail_args', 'custom_breadcrumb_trail_args');

// ********************************************
// Carousel
// ********************************************
function custom_bootstrap_carousel_shortcode_atts(){
  $args = array(
    'order'             => 'ASC', // Order
    'orderby'           => 'ID', // Orderby
    'width'             => '100%', // Carousel width
    'image_size'        => 'large', // Image size
    'rel'               => '', // Rel attribute
    'file'              => 0, // Link image to attachement page
    'comments'          => 0, // Display attachment comments link
    'interval'          => 4000, // Interval delay
    'pause'             => 'hover', // Pause on hover
    'start'             => 1, // Autostart carousel*/
  );
  return $args;
}
add_filter('stormbringer_bootstrap_carousel_shortcode_atts', 'custom_bootstrap_carousel_shortcode_atts');

// ********************************************
// Theme My Login
// ********************************************
function custom_thememylogin_options(){
  $args = array(
    'action_login' => __( 'Identification', "stormbringer" ),
    'action_lostpassword' => __( 'Mot de passe oublié', "stormbringer" ),
    'action_retrievepassword' => __( 'Mot de passe oublié', "stormbringer" ),
    'action_resetpass' => __( 'Mot de passe oublié', "stormbringer" ),
    'action_register' => __( 'Créer un compte', "stormbringer" ),
    'action_profile' => __( 'Votre compte', "stormbringer" ),
    'message_error' => __( 'Erreur', "stormbringer" ),
    'message_info' => __( 'Info', "stormbringer" ),
    'message_success' => __( 'Succès', "stormbringer" ),
    'menu_login' => __( 'S\'identifier', "stormbringer" ),
    'menu_logout' => __( 'Se déconnecter', "stormbringer" ),
  );
  return $args;
}
add_filter('thememylogin_options', 'custom_thememylogin_options');


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
// JS/CSS
// ********************************************

function stormbringer_js_header() {
  if (!is_admin()) {
    wp_deregister_script('jquery');

  wp_enqueue_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js', array(),null, false );
  wp_enqueue_script('modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(),null, false );

  }
}
add_action('wp_enqueue_scripts', 'stormbringer_js_header',50);

function stormbringer_js_footer() {

  /* Disable comments to load/unload scripts */

  //wp_enqueue_script('jquery-cycle','//cdnjs.cloudflare.com/ajax/libs/jquery.cycle/2.9999.8/jquery.cycle.all.min.js', array('jquery'), null, true);
  //wp_enqueue_script('jquery-easing','//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', array('jquery'), null, true);
  //wp_enqueue_script('jquery-mousewheel','//cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.0.6/jquery.mousewheel.min.js', array('jquery'), null, true);
  //wp_enqueue_script('jquery-validate','//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.10.0/jquery.validate.min.js', array('jquery'), null, true);
  //wp_enqueue_script('jquery-easing','//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', array('jquery'), null, true);

  wp_enqueue_script('selectivizr','//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js', array(), null, true);
  //wp_enqueue_script('addthis','//s7.addthis.com/js/300/addthis_widget.js'.(defined('ADDTHIS_PROFILE')?'#pubid='.ADDTHIS_PROFILE:''), array(), null, true);

  wp_enqueue_script('bootstrap','//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.0/js/bootstrap.min.js', array(), null, true);
  //wp_enqueue_script('bootstrap-datepicker','//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.0.0/js/bootstrap-datepicker.min.js', array('bootstrap'), null, true);
  //wp_enqueue_script('bootstrap-growl','//cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js', array('bootstrap'), null, true);

  if(LIGHTBOX==='fancybox'){
    wp_enqueue_script('jquery-fancybox', get_template_directory_uri().'/js/fancybox/jquery.fancybox-1.3.4_patch.js', array('jquery'),null, true );
    wp_enqueue_script('fancybox-open', get_template_directory_uri().'/js/fancybox/fancybox-open.js', array('jquery'),null, true );
  }

  if(LIGHTBOX==='tbmodal'){
    wp_enqueue_script('bootstrap-loadimage', get_template_directory_uri().'/js/bootstrap-loadimage.js', array('bootstrap','jquery'),null, true );
    wp_enqueue_script('bootstrap-modalgallery', get_template_directory_uri().'/js/bootstrap-modalgallery.js', array('bootstrap','jquery'),null, true );
    wp_enqueue_script('bootstrap-modalopen', get_template_directory_uri().'/js/bootstrap-modalopen.js', array('bootstrap','jquery'),null, true );
  }
  wp_enqueue_script('common.js', get_template_directory_uri().'/js/common.js', array('jquery'),null, true );
  wp_enqueue_script('app.js', get_template_directory_uri().'/js/app.js', array('jquery'),null, true );

}
add_action('wp_enqueue_scripts', 'stormbringer_js_footer',300);

function stormbringer_css() {
  if(LIGHTBOX=='fancybox'){
    wp_register_style('fancybox',  get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css', array(), null, 'screen,projection' );
    wp_enqueue_style('fancybox' );
  }
}
add_action('wp_enqueue_scripts', 'stormbringer_css',0);

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
// Addthis
// ********************************************

function share_addthis(){
  if((!is_home() && is_singular('post')) || is_category() || is_archive()){
    echo  '
    <div class="addthis_toolbox addthis_default_style"><a class="addthis_button_facebook"></a><a class="addthis_button_twitter"></a><a class="addthis_button_compact"></a><a class="addthis_button_email"></a>
    </div>
    ';
  }
}
add_action( 'stormbringer_content_after', 'share_addthis', 10, 2 );

