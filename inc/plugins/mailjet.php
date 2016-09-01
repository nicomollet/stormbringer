<?php
// Menu icon for Mailjet
function mailjet_menu_icon(){

	print '<style type="text/css">';
	print '#toplevel_page_wp_mailjet_options_top_menu div.wp-menu-image img {display:none}';
	print '#toplevel_page_wp_mailjet_options_top_menu div.wp-menu-image:before {';
	print ' content: "\f466" !important;';
	print ' font-family: "dashicons" !important;';
	print '}';
	print '</style>';
}
add_action( 'admin_head', 'mailjet_menu_icon',30 );
