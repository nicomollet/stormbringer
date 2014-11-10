<?php

// Menu icon for Backwpup
function seo_menu_icon(){

	print '<style type="text/css">';
	print '#adminmenu #toplevel_page_wpseo_dashboard .dashicons-before img{display:none}';
	print '#adminmenu #toplevel_page_wpseo_dashboard .wp-has-submenu div.wp-menu-image:before {';
	print ' content: "\f239" !important;';
	print ' background: none';
	print ' font-family: "dashicons" !important;';
	print ' font-size: 20px;';
	print '}';
	print '#adminmenu #toplevel_page_yst_ga_dashboard .dashicons-before img{display:none}';
	print '#adminmenu #toplevel_page_yst_ga_dashboard .wp-has-submenu div.wp-menu-image:before {';
	print ' content: "\f239" !important;';
	print ' background: none';
	print ' font-family: "dashicons" !important;';
	print ' font-size: 20px;';
	print '}';
	print '</style>';

}
add_action( 'admin_head', 'seo_menu_icon',30 );

function seo_menu_icon_script(){

	print '<script>';
	print 'jQuery(function($) {';
	print '$("#toplevel_page_wpseo_dashboard .wp-menu-image").css("background","none");';
	print '$("#toplevel_page_wpseo_dashboard .wp-menu-image").addClass("dashicons-before");';
	print '$("#toplevel_page_yst_ga_dashboard .wp-menu-image").css("background","none");';
	print '$("#toplevel_page_yst_ga_dashboard .wp-menu-image").addClass("dashicons-before");';
	print '});';
	print '</script>';

}
add_action( 'admin_footer', 'seo_menu_icon_script',30 );