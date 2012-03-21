<?php

define('NAVBAR_SITENAME', true);
define('NAVBAR_SEARCH', false);
define('NAVBAR_LOGIN', true);


define('BREADCRUMB_ACTIVE', true);
define('BREADCRUMB_SEPARATOR', '/');
define('BREADCRUMB_HOME', __( 'Accueil', "stormbringer" ));
define('BREADCRUMB_BEFORE', __( 'You are here:', "stormbringer" ));

define('WRAP_CLASSES', 'container');
define("CONTAINER_CLASSES", "row");
define("MAIN_CLASSES", "span8");
define("SIDEBAR_CLASSES", "span4");
define("GALLERY_THUMBNAIL_CLASSES", "span2");
define("GALLERY_MEDIUM_CLASSES", "span4");
define("GALLERY_LARGE_CLASSES", "span6");
define("GALLERY_CLASSES", "span2");
define('BOOTSTRAP_RESPONSIVE', true);

define("POST_EXCERPT_LENGTH", 40);

define("JQUERY_VERSION", "1.7.1");

define("FANCYBOX", true);

define("GOOGLE_WEBFONTS", serialize(array('Marvel:700')));


/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function stormbringer_register_sidebars() {
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

} // don't remove this bracket!

// Sidebars & Widgetizes Areas
function stormbringer_register_menus() {
	register_nav_menus(                      // wp3+ menus
		array(
			'main_nav' => 'The Main Menu',   // main nav in header
			'footer_links' => 'Footer Links' // secondary nav in footer
		)
	);
}


// Adding WP 3+ Functions & Theme Support
function stormbringer_support() {
  require_once locate_template('library/bodyclass.php');
  require_once locate_template('library/bootstrap.php');
  require_once locate_template('library/breadcrumb.php');
  require_once locate_template('library/cleanup.php');
  require_once locate_template('library/comments.php');
  require_once locate_template('library/fancybox.php');
  require_once locate_template('library/favicon.php');
  require_once locate_template('library/googlewebfonts.php');
  require_once locate_template('library/gravityforms.php');
  require_once locate_template('library/htmleditor.php');
  require_once locate_template('library/lessc.inc.php');
  require_once locate_template('library/menu.php');
  require_once locate_template('library/pagination.php');
  require_once locate_template('library/password.php');
  require_once locate_template('library/profile.php');
  require_once locate_template('library/shortcodes.php');
  require_once locate_template('library/tags.php');
  require_once locate_template('library/thumbnails.php');
  require_once locate_template('library/widgets.php');
  require_once locate_template('library/wpml.php');

  load_theme_textdomain( 'stormbringer', get_template_directory() . '/languages' );

  $locale = get_locale();
  $locale_file = get_template_directory() . "/languages/$locale.php";
  if ( is_readable( $locale_file ) )
    require_once( $locale_file );

	add_theme_support('automatic-feed-links'); // rss thingy
  add_theme_support( 'post-thumbnails' );
	stormbringer_register_menus();            // wp menus
  add_action('wp_head', 'staging_noindex');
}

// launching this stuff after theme setup
add_action('after_setup_theme','stormbringer_support');
// adding sidebars to Wordpress (these are created in functions.php)
add_action( 'widgets_init', 'stormbringer_register_sidebars' );


?>