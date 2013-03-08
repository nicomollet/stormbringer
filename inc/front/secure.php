<?php

/* Secure : prend le code du plugin Secure-Wordpress http://wordpress.org/extend/plugins/secure-wordpress/ */

if ( !class_exists('SecureWP') ){

/**
* @package Secure WordPress
* @author WebsiteDefender
* @desc Secure WordPress beefs up the security of your WordPress installation
* by removing error information on login pages, adds index.html to plugin directories,
* hides the WordPress version and much more.
*/
class SecureWP
{
var $wpversion;

public function __construct()
{
global $wp_version;

$this->wpversion = $wp_version;

/**
* remove WP version
*/
add_action( 'init', array(&$this, 'replace_wp_version'), 1 );

/**
* remove core update for non admins
* @link: rights: http://codex.wordpress.org/Roles_and_Capabilities
*/
add_action( 'init', array(&$this, 'remove_core_update'), 1 );

/**
* remove plugin update for non admins
* @link: rights: http://codex.wordpress.org/Roles_and_Capabilities
*/
add_action( 'init', array(&$this, 'remove_plugin_update'), 1 );

/**
* remove theme update for non admins
* @link: rights: http://codex.wordpress.org/Roles_and_Capabilities
*/
add_action( 'init', array(&$this, 'remove_theme_update'), 1 );

/**
* remove WP version on backend
*/
add_action( 'init', array(&$this, 'remove_wp_version_on_admin'), 1 );

add_action( 'init', array(&$this, 'on_init'), 1 );
}


/**
* init functions; check rights and options; load external resources
*
* @package Secure WordPress
*/
public function on_init()
{
global $wp_version;



/**
* remove Error-information
*/
  if(!class_exists( 'Theme_My_Login')) // disable hiding errors with Theme My Login, if not errors won't be displayed to user
    add_filter( 'login_errors', create_function( '$a', "return null;" ) );


/**
* remove rdf
*/
remove_action('wp_head', 'rsd_link');


/**
* remove wlf
*/
remove_action('wp_head', 'wlwmanifest_link');

/**
* add wp-scanner
* @link http://blogsecurity.net/wordpress/tools/wp-scanner
*/
add_filter( 'script_loader_src', array(&$this, 'filter_script_loader') );
add_filter( 'style_loader_src', array(&$this, 'filter_script_loader') );

/**
* block bad queries
* @link http://perishablepress.com/press/2009/12/22/protect-wordpress-against-malicious-url-requests/
*/
add_action( 'init', array(&$this, 'wp_against_malicious_url_request') );
}


/**
* Replace the WP-version with a random string &lt; WP 2.4
* and eliminate WP-version &gt; WP 2.4
* @link http://bueltge.de/wordpress-version-verschleiern-plugin/602/
*
* @package Secure WordPress
*/
public function replace_wp_version()
{
if ( !is_admin() )
{
global $wp_version;

// random values
$v = intval( rand(0, 9999) );
$d = intval( rand(9999, 99999) );
$m = intval( rand(99999, 999999) );
$t = intval( rand(999999, 9999999) );

if ( function_exists('the_generator') )
{
// eliminate version for wordpress >= 2.4
remove_filter( 'wp_head', 'wp_generator' );
$actions = array( 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head' );
foreach ( $actions as $action ) {
remove_action( $action, 'the_generator' );
}

// for vars
$wp_version = $v;
$wp_db_version = $d;
$manifest_version = $m;
$tinymce_version = $t;
}
else {
// for wordpress < 2.4
add_filter( "bloginfo_rss('version')", create_function('$a', "return $v;") );

// for rdf and rss v0.92
$wp_version = $v;
$wp_db_version = $d;
$manifest_version = $m;
$tinymce_version = $t;
}
}
}

/**
* remove WP Version-Information on Dashboard
*
* @package Secure WordPress
*/
public function remove_wp_version_on_admin()
{
if ( !current_user_can('update_plugins') && is_admin() ) {
remove_action( 'update_footer', 'core_update_footer' );
}
}

/**
* remove core-Update-Information
*
* @package Secure WordPress
*/
public function remove_core_update()
{
if ( !current_user_can('update_plugins') )
{
add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_notices', 'maintenance_nag' );" ) );
add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_notices', 'update_nag', 3 );" ) );
add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_init', '_maybe_update_core' );" ) );
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ) );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
remove_action( 'wp_version_check', 'wp_version_check' );
remove_action( 'admin_init', '_maybe_update_core' );
add_filter( 'pre_transient_update_core', create_function( '$a', "return null;" ) );
// 3.0
add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );
//wp_clear_scheduled_hook( 'wp_version_check' );
}
}

/**
* remove plugin-Update-Information
*
* @package Secure WordPress
*/
public function remove_plugin_update()
{
if ( !current_user_can('update_plugins') )
{
add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_init', 'wp_plugin_update_rows' );" ), 2 );
add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_init', '_maybe_update_plugins' );" ), 2 );
add_action( 'admin_menu', create_function( '$a', "remove_action( 'load-plugins.php', 'wp_update_plugins' );" ) );
add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_init', 'wp_update_plugins' );" ), 2 );
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_update_plugins' );" ), 2 );
add_filter( 'pre_option_update_plugins', create_function( '$a', "return null;" ) );
remove_action( 'load-plugins.php', 'wp_update_plugins' );
remove_action( 'load-update.php', 'wp_update_plugins' );
remove_action( 'admin_init', '_maybe_update_plugins' );
remove_action( 'wp_update_plugins', 'wp_update_plugins' );
// 3.0
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_transient_update_plugins', create_function( '$a', "return null;" ) );
//wp_clear_scheduled_hook( 'wp_update_plugins' );
}
}

/**
* remove theme-Update-Information
*
* @package Secure WordPress
*/
public function remove_theme_update()
{
if ( !current_user_can('edit_themes') )
{
remove_action( 'load-themes.php', 'wp_update_themes' );
remove_action( 'load-update.php', 'wp_update_themes' );
remove_action( 'admin_init', '_maybe_update_themes' );
remove_action( 'wp_update_themes', 'wp_update_themes' );
// 3.0
remove_action( 'load-update-core.php', 'wp_update_themes' );
//wp_clear_scheduled_hook( 'wp_update_themes' );
add_filter( 'pre_transient_update_themes', create_function( '$a', "return null;" ) );
}
}

/**
* Removes the version parameter from urls
*
* @param  string $src Original script URI
* @return string
*/
public function filter_script_loader($src)
{
if ( is_admin() ) { return $src; }

// Separate the version parameter.
$src = explode('?ver=' . $this->wpversion, $src);

// Just the URI without the query string.
return $src[0];
}

/**
* block bad queries
*
* @package Secure WordPress
* @see http://perishablepress.com/press/2009/12/22/protect-wordpress-against-malicious-url-requests/
* @author Jeff Starr
*/
public function wp_against_malicious_url_request()
{
global $user_ID;

if ($user_ID)
{
if ( !current_user_can('manage_options') ) {
if (strlen($_SERVER['REQUEST_URI']) > 255 ||
stripos($_SERVER['REQUEST_URI'], "eval(") ||
stripos($_SERVER['REQUEST_URI'], "CONCAT") ||
stripos($_SERVER['REQUEST_URI'], "UNION+SELECT") ||
stripos($_SERVER['REQUEST_URI'], "base64"))
{
if (!headers_sent()) {
header("HTTP/1.1 414 Request-URI Too Long");
header("Status: 414 Request-URI Too Long");
header("Connection: Close");
}
exit;
}
}
}
}

}
/* End class: SecureWP.php */

}
/* End if (!class_exists('SecureWP')) */


$SecureWP = new SecureWP();