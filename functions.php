<?php

// Stormbringer initialization
require_once locate_template('/inc/init.php');


// ********************************************
// Configuration
// ********************************************


if ( ! isset( $content_width ) )
	$content_width = 940; // Content width, in pixels


// ********************************************
// Libraries
// ********************************************

add_theme_support('libraries',
	array(
		'html5shiv'            => '3.7.3',
		'respond'              => '1.4.2',
		'lessjs'               => '4.1.2',
		'selectivizr'          => '1.0.2',
		'animatecss'           => '4.1.1',
		'bootstrap'            => '3.3.7',
		'bootstrap-select'     => '1.13.18',
		'bootstrap-datepicker' => '1.9.0',
		'jquery'               => '1.12.4',
		'jquery-cycle'         => '3.03',
		'jquery-easing'        => '1.3',
		'jquery-mousewheel'    => '3.1.12',
		'jquery-validate'      => '1.19.3',
		'jquery-cookie'        => '1.4.1',
		'jquery-lazyload'      => '1.9.7',
		'jquery-waypoints'     => '4.0.1',
		'jquery-touchswipe'    => '1.6.19',
		'jquery-owlcarousel'   => '2.3.4',
	)
);
