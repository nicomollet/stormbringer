<?php

/**
 * Cleaning up the Wordpress Head - Thanks to Roots Theme (Thanks to Roots Theme (http://www.rootstheme.com))
 */
function stormbringer_head_cleanup() {

	add_action( 'wp_head', 'stormbringer_staging_noindex' );
	add_action( 'wp_head', 'stormbringer_remove_recent_comments_style', 1 );
	add_filter( 'use_default_gallery_style', '__return_false' );
	add_filter( 'the_category', 'stormbringer_remove_rel_category' );
	add_filter( 'excerpt_length', 'stormbringer_excerpt_length' );
	add_filter( 'excerpt_more', 'mc_auto_excerpt_more' );
	add_filter( 'get_the_excerpt', 'stormbringer_excerpt_more', 500 );
	add_filter( 'wpseo_next_rel_link', 'wpseo_disable_rel_next_home' );

}

add_action( 'init', 'stormbringer_head_cleanup' );


// staging: noindex
function stormbringer_staging_noindex() {
	if ( get_option( 'blog_public' ) === '0' ) {
		echo '<meta name="robots" content="noindex,nofollow,noarchive,nosnippet">', "\n";
	}
}

// Favicon in head
function favicon() {

if(current_theme_supports('themecolor')){
	if(get_theme_support('themecolor')[0]){
		$themecolor = get_theme_support('themecolor')[0];
	}
}

if(current_theme_supports('tilecolor')){
	if(get_theme_support('tilecolor')[0]){
		$tilecolor = get_theme_support('tilecolor')[0];
	}
}
if(current_theme_supports('applicationname')){
	if(get_theme_support('applicationname')[0]){
		$applicationname = get_theme_support('applicationname')[0];
	}
}
if(current_theme_supports('faviconfolder')){
	if(get_theme_support('faviconfolder')[0]){
		$faviconfolder = get_theme_support('faviconfolder')[0];
	}
}
if($faviconfolder == 'theme') :
	$function = 'get_template_directory_uri';
	$folder = '/img/favicon';
else :
	$function = 'site_url';
	$folder = '';
endif;

echo "\n" . '<!-- Favicon -->' . "\n";
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
if($tilecolor) echo '<meta name="msapplication-TileColor" content="'.$tilecolor.'"/>'. "\n";
if($themecolor) echo '<meta name="theme-color" content="'.$themecolor.'"/>'. "\n";
if($applicationname) echo '<meta name="apple-mobile-web-app-title" content="'.$applicationname.'"/>'. "\n";
if($applicationname) echo '<meta name="application-name" content="'.$applicationname.'"/>'. "\n";

}

add_action( 'wp_head', 'favicon', 100 );


// remove rel=category tag
function stormbringer_remove_rel_category( $text ) {
	$text = str_replace( 'rel="category tag"', "", $text );

	return $text;
}


/**
 * Remove CSS from recent comments widget - Thanks to Roots Theme (http://www.rootstheme.com)
 */
function stormbringer_remove_recent_comments_style() {
	global $wp_widget_factory;
	if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
		remove_action( 'wp_head', array(
				$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
				'recent_comments_style'
			) );
	}
}

/**
 * Excerpt length
 */
function stormbringer_excerpt_length( $length ) {
	$excerptlength = 150;
	if(current_theme_supports('excerpt-length')){
		if(get_theme_support('excerpt-length')[0]){
			$excerptlength = get_theme_support('excerpt-length')[0];
		}
	}
	return $excerptlength;
}


function mc_auto_excerpt_more( $more ) {
	return ' (&hellip;) ' . stormbringer_more_link();
}


function stormbringer_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output = '<p class="entry-excerpt">' . $output . stormbringer_more_link() . '</p>';
	} else {
		$output = '<p class="entry-excerpt">' . $output . '</p>';
	}

	return $output;
}

function stormbringer_more_link() {
	return ' <span class="excerpt-more"><a href="' . get_permalink() . '">' . __( 'Read&nbsp;more&hellip;', 'stormbringer' ) . '</a></span>';
}

// returns WordPress subdirectory if applicable
function wp_base_dir() {
	preg_match( '!(https?://[^/|"]+)([^"]+)?!', site_url(), $matches );
	if ( count( $matches ) === 3 ) {
		return end( $matches );
	} else {
		return '';
	}
}

// opposite of built in WP functions for trailing slashes
function leadingslashit( $string ) {
	return '/' . unleadingslashit( $string );
}

function unleadingslashit( $string ) {
	return ltrim( $string, '/' );
}

function add_filters( $tags, $function ) {
	foreach ( $tags as $tag ) {
		add_filter( $tag, $function );
	}
}

function is_element_empty( $element ) {
	$element = trim( $element );

	return empty( $element ) ? false : true;
}

// Disable rel=next on home
function wpseo_disable_rel_next_home( $link ) {
	if ( is_home() ) {
		return false;
	}
}

function paragraph_to_unorderedlist( $text, $class = '', $multi = false ) {
	if ( $text == '' ) {
		return '';
	}
	$text = nl2br( $text );
	$lines = explode( '<br />', $text );
	$text = '<ul' . ( $class ? ' class="' . $class . '"' : '' ) . '>';
	$start = false;
	foreach ( $lines as $line ) :
		if ( $multi == true ) {
			if ( substr( trim( $line ), 0, 2 ) != '- ' ) {
				if ( $start == true ) {
					$text .= '</li>';
					$start = true;
				}
				$text .= '<li>' . '<span>' . $line . '</span>' . '';
			} else {
				$start = true;
				$text .= '<br/>' . $line . '';
			}

		} else {
			$text .= '<li>' . $line . '</li>';
		}

	endforeach;
	$text .= '</ul>';

	return $text;
}


/**
 * Wrap embedded media as suggested by Readability
 *
 * @link https://gist.github.com/965956
 * @link http://www.readability.com/publishers/guidelines#publisher
 */
function stormbringer_embed_wrap( $cache, $url, $attr = '', $post_ID = '' ) {
	return '<div class="embed">' . $cache . '</div>';
}
add_filter( 'embed_oembed_html', 'stormbringer_embed_wrap', 10, 4 );
add_filter( 'embed_googlevideo', 'stormbringer_embed_wrap', 10, 2 );



function change_embed_size() {
	return array('width' => 600, 'height' => 300);
}
add_filter( 'embed_defaults', 'change_embed_size' );


// -------------------------------------------------------
// Other

function meta() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1">' . "\n";
}

add_action( 'wp_head', 'meta', 1 );

function ietweaks() {
	echo '<meta http-equiv="imagetoolbar" content="no">' . "\n";
	echo '<meta name="MSSmartTagsPreventParsing" content="true">' . "\n";
}

//add_action('wp_head', 'ietweaks',100);

// show admin bar only for admins and editors
if ( ! current_user_can( 'edit_posts' ) ) {
	add_filter( 'show_admin_bar', '__return_false' );
}

// Disable the emoji's
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

// Filter function used to remove the tinymce emoji plugin
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

// Remove category/tag term name in the title
function stormbringer_the_archive_title($title){
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'stormbringer_the_archive_title');
