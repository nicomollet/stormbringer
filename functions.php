<?php

// Stormbringer initialization
require_once locate_template('/inc/init.php');           // Load theme functions


// ********************************************
// Configuration
// ********************************************

add_theme_support('thememylogin');          // Theme My Login compatibility
add_theme_support('preprocessor', 'scss');  // Preprocessor: less or scss
add_theme_support('h5bp-htaccess');         // HTML5 boilerplate htaccess (for Apache only)
add_theme_support('excerpt-length', 100);   // Length of excerpt
add_theme_support('lightbox', 'tbmodal');   // Lightbox style: tbmodal or fancybox
add_theme_support('google-webfonts', '' );  // Example: serialize(array('Montserrat:400','Dancing Script:400'))
add_theme_support('addthis', '' );          // ID of Addthis profile

if ( ! isset( $content_width ) )
	$content_width = 940; // Pixels


// ********************************************
// Libraries (comment line to remove a library)
// ********************************************

add_theme_support('libraries',
	array(
		'modernizr' => '2.8.3',
		'html5shiv' => '3.7.2',
		'respond' => '1.4.2',
		'lessjs' => '1.6.2',
		'selectivizr' => '1.0.2',
		'bootstrap' => '3.3.1',
		'bootstrap-select' => '1.6.2',
		'jquery' => '1.11.1',
		//'jquery-cycle' => '3.03',
		//'jquery-easing' => '1.3',
		//'jquery-mousewheel' => '3.1.11',
		//'jquery-validate' => '1.11.1',
		//'jquery-cookie' => '1.4.1',
	)
);


// ********************************************
// Custom
// ********************************************

