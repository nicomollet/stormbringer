<?php
// Favicon in head
function stormbringer_favicon() {

	$themecolor = '';
	$tilecolor = '';
	$maskcolor = '';
	$applicationname = '';
	$faviconfolder = 'root';

	$themecolor = get_theme_mod('favicon_theme_color');
	$maskcolor = get_theme_mod('favicon_mask_color');
	$tilecolor = get_theme_mod('favicon_tile_color');
	$applicationname = get_theme_mod('favicon_appname');
	$faviconfolder = get_theme_mod('favicon_folder');

	if($faviconfolder == 'theme') :
		$function = 'get_stylesheet_directory_uri';
		$folder = '/img/favicon';
	else :
		$function = 'site_url';
		$folder = '';
	endif;

	echo "\n" . '<!-- Favicon -->' . "\n";
	echo '<link rel="apple-touch-icon" sizes="57x57" href="' . $function().$folder. '/apple-touch-icon-57x57.png'.'"/>' . "\n";
	echo '<link rel="apple-touch-icon" sizes="57x57" href="' . $function().$folder. '/apple-touch-icon-57x57.png'.'"/>' . "\n";
	echo '<link rel="apple-touch-icon" sizes="60x60" href="' . $function().$folder. '/apple-touch-icon-60x60.png'.'"/>' . "\n";
	echo '<link rel="apple-touch-icon" sizes="72x72" href="' . $function().$folder. '/apple-touch-icon-72x72.png'.'"/>' . "\n";
	echo '<link rel="apple-touch-icon" sizes="76x76" href="' . $function().$folder. '/apple-touch-icon-76x76.png'.'"/>' . "\n";
	echo '<link rel="apple-touch-icon" sizes="114x114" href="' . $function().$folder. '/apple-touch-icon-114x114.png'.'"/>' . "\n";
	echo '<link rel="apple-touch-icon" sizes="120x120" href="' . $function().$folder. '/apple-touch-icon-120x120.png'.'"/>' . "\n";
	echo '<link rel="apple-touch-icon" sizes="144x144" href="' . $function().$folder. '/apple-touch-icon-144x144.png'.'"/>' . "\n";
	echo '<link rel="apple-touch-icon" sizes="152x152" href="' . $function().$folder. '/apple-touch-icon-152x152.png'.'"/>' . "\n";
	echo '<link rel="apple-touch-icon" sizes="180x180" href="' . $function().$folder. '/apple-touch-icon-180x180.png'.'"/>' . "\n";
	echo '<link rel="icon" type="image/png" href="' . $function().$folder. '/favicon-32x32.png'.'" sizes="32x32"/>' . "\n";
	echo '<link rel="icon" type="image/png" href="' . $function().$folder. '/android-chrome-192x192.png'.'" sizes="192x192"/>' . "\n";
	echo '<link rel="icon" type="image/png" href="' . $function().$folder. '/favicon-96x96.png'.'" sizes="96x96"/>' . "\n";
	echo '<link rel="icon" type="image/png" href="' . $function().$folder. '/favicon-16x16.png'.'" sizes="16x16"/>' . "\n";
	echo '<link rel="manifest" href="' . $function().$folder. '/manifest.json'.'"/>' . "\n";
	echo '<meta name="msapplication-TileImage" content="' . $function().$folder. '/mstile-144x144.png'.'"/>' . "\n";
	echo '<meta name="msapplication-config" content="' . $function().$folder. '/browserconfig.xml'.'"/>' . "\n";

	if($maskcolor != '') echo '<link rel="mask-icon" href="' . $function().$folder. '/safari-pinned-tab.svg'.'" color="'.$maskcolor.'"/>' . "\n";
	if($tilecolor != '') echo '<meta name="msapplication-TileColor" content="'.$tilecolor.'"/>'. "\n";
	if($themecolor != '') echo '<meta name="theme-color" content="'.$themecolor.'"/>'. "\n";
	if($applicationname != '') echo '<meta name="apple-mobile-web-app-title" content="'.$applicationname.'"/>'. "\n";
	if($applicationname !='') echo '<meta name="application-name" content="'.$applicationname.'"/>'. "\n";

}

add_action( 'wp_head', 'stormbringer_favicon', 100 );