<?php

// Menu icon for Backwpup
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