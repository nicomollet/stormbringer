<?php

// Menu icon for iThemes Security
function security_menu_icon(){

	print '<style type="text/css">';
	print '#toplevel_page_itsec div.wp-menu-image:before, .it-icon-itsec:before {';
	print ' content: "\f332" !important;';
	print ' font-family: "dashicons" !important;';
	print '}';
	print '</style>';
}
add_action( 'admin_head', 'security_menu_icon',30 );