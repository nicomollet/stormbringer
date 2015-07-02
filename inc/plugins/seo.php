<?php

// Menu icon for Backwpup
function seo_menu_icon() {

	print '<style type="text/css">';
	print '#adminmenu #toplevel_page_wpseo_dashboard .dashicons-before img{display:none}';
	print '#adminmenu #toplevel_page_wpseo_dashboard div.wp-menu-image.svg {';
	print ' background-size: 0 !important;';
	print '}';
	print '#adminmenu #toplevel_page_wpseo_dashboard .wp-has-submenu div.wp-menu-image:before {';
	print ' content: "\f239" !important;';
	print ' font-family: "dashicons" !important;';
	print ' font-size: 20px;';
	print ' display: inline-block;';
	print '}';
	print '#adminmenu #toplevel_page_yst_ga_dashboard .dashicons-before img{display:none}';
	print '#adminmenu #toplevel_page_yst_ga_dashboard div.wp-menu-image.svg {';
	print ' background-size: 0 !important;';
	print '}';
	print '#adminmenu #toplevel_page_yst_ga_dashboard .wp-has-submenu div.wp-menu-image:before {';
	print ' content: "\f239" !important;';
	print ' font-family: "dashicons" !important;';
	print ' font-size: 20px;';
	print ' display: inline-block;';
	print '}';
	print '</style>';

}

add_action( 'admin_head', 'seo_menu_icon', 30 );

/*
function seo_menu_icon_script(){

	print '<script>';
	print 'jQuery(function($) {';
	print '$("#toplevel_page_wpseo_dashboard .wp-menu-image").css("background","none").css("backgroundImage","none").css("backgroundSize","0").css("color","red");';
	print '$("#toplevel_page_wpseo_dashboard .wp-menu-image").addClass("dashicons-before");';
	print '$("#toplevel_page_yst_ga_dashboard .wp-menu-image").css("background","none");';
	print '$("#toplevel_page_yst_ga_dashboard .wp-menu-image").addClass("dashicons-before");';
	print '});';
	print '</script>';

}
add_action( 'admin_footer', 'seo_menu_icon_script',30 );
*/


// Breadcrumb default wrapper
add_filter( 'wpseo_breadcrumb_output_wrapper', 'stormbringer_wpseo_breadcrumb_output_wrapper_filter' );
function stormbringer_wpseo_breadcrumb_output_wrapper_filter() {
	return 'p';
}

//* Change breadcrumb wrapper class to ‘wrap’
add_filter( 'wpseo_breadcrumb_output_class', 'stormbringer_wpseo_bc_output_class_filter' );
function stormbringer_wpseo_bc_output_class_filter() {
	return 'breadcrumb';
}