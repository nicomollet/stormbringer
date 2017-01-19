<?php
/**
 * Favicon
 *
 * @package StormBringer
 */

/*
 * Favicon in head
 */
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
    echo '<link rel="apple-touch-icon" href="' . $function().$folder. '/apple-touch-icon.png'.'" sizes="180x180"/>' . "\n";
    echo '<link rel="icon" type="image/png" href="' . $function().$folder. '/favicon-32x32.png'.'" sizes="32x32"/>' . "\n";
    echo '<link rel="icon" type="image/png" href="' . $function().$folder. '/favicon-16x16.png'.'" sizes="16x16"/>' . "\n";
    echo '<link rel="manifest" href="' . $function().$folder. '/manifest.json'.'"/>' . "\n";
    echo '<link rel="shortcut icon" href="' . $function().$folder. '/favicon.ico'.'"/>' . "\n";

    if($maskcolor != '') echo '<link rel="mask-icon" href="' . $function().$folder. '/safari-pinned-tab.svg'.'" color="'.$maskcolor.'"/>' . "\n";
    if($themecolor !='') echo '<meta name="theme-color" content="'.$themecolor.'"/>'. "\n";

    if($applicationname !='') echo '<meta name="application-name" content="'.$applicationname.'"/>'. "\n";
    if($applicationname != '') echo '<meta name="apple-mobile-web-app-title" content="'.$applicationname.'"/>'. "\n";
    //echo '<meta name="msapplication-config" content="' . $function().$folder. '/browserconfig.xml'.'"/>' . "\n";

    echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
    echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
}

add_action( 'wp_head', 'stormbringer_favicon', 100 );