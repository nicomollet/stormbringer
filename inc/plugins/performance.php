<?php

// Menu icon for W3TC
function w3tc_menu_icon(){

	print '<style type="text/css">';
	print '#adminmenu #toplevel_page_w3tc_dashboard .dashicons-before img{display:none}';
	print '#adminmenu #toplevel_page_w3tc_dashboard .wp-menu-image:before {';
	print ' content: "\f308" !important;';
	print '}';
	print '#adminmenu #toplevel_page_w3tc_dashboard .wp-menu-image {';
	print ' background: none !important;';
	print '}';
	print '</style>';
}
add_action( 'admin_head', 'w3tc_menu_icon',30 );

// WP Rocket defered scripts are too low in the wp_footer queue
add_action( 'wp_footer', '__rocket_insert_minify_js_in_footer', 20 );
remove_action( 'wp_footer', '__rocket_insert_minify_js_in_footer', PHP_INT_MAX );