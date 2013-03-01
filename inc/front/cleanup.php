<?php

/**
 * Cleaning up the Wordpress Head - Thanks to Roots Theme (Thanks to Roots Theme (http://www.rootstheme.com))
 */
function stormbringer_head_cleanup() {

  add_action('wp_head', 'stormbringer_staging_noindex');
  add_action('wp_head', 'stormbringer_remove_recent_comments_style', 1);
  add_filter('use_default_gallery_style', '__return_false');
  add_filter( 'the_category', 'stormbringer_remove_rel_category' );
  add_filter('excerpt_length', 'stormbringer_excerpt_length');
  add_filter( 'excerpt_more', 'mc_auto_excerpt_more' );
  add_filter( 'get_the_excerpt', 'stormbringer_excerpt_more',500 );
  add_filter( 'wpseo_next_rel_link', 'wpseo_disable_rel_next_home' );


}
add_action('init', 'stormbringer_head_cleanup');



// staging: noindex
function stormbringer_staging_noindex() {
  if (get_option('blog_public') === '0') {
    echo '<meta name="robots" content="noindex,nofollow,noarchive,nosnippet">', "\n";
  }
}

// Favicon in head
function favicon() {
  echo "\n". '<!-- Favicon -->' . "\n";
  echo '<link rel="icon" href="/favicon.ico" type="image/x-icon"/>' . "\n";
  echo '<link rel="Shortcut Icon" href="/favicon.ico" type="image/x-icon"/>' . "\n";
  echo '<link rel="apple-touch-icon" href="/apple-touch-icon.png"/>' . "\n";
  echo '<link rel="apple-touch-icon-precomposed" href="/apple-touch-icon.png"/>  ' . "\n";
}
add_action('wp_head', 'favicon',100);


// remove rel=category tag
function stormbringer_remove_rel_category( $text ) {
  $text = str_replace('rel="category tag"', "", $text); return $text;
}



/**
 * Remove CSS from recent comments widget - Thanks to Roots Theme (http://www.rootstheme.com)
 */
function stormbringer_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

/**
 * Excerpt - Thanks to Roots Theme (http://www.rootstheme.com)
 */
function stormbringer_excerpt_length($length) {
  return POST_EXCERPT_LENGTH;
}



function mc_auto_excerpt_more( $more ) {
	return ' (&hellip;) ' . stormbringer_more_link();
}


function stormbringer_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output = '<p class="entry-excerpt">'.$output.stormbringer_more_link().'</p>';
	}
  else{
    $output = '<p class="entry-excerpt">'.$output.'</p>';
  }
	return $output;
}

function stormbringer_more_link(){
	return ' <span class="excerpt-more"><a href="'. get_permalink() . '">' . __( 'Lire la suite &rarr;','stormbringer') . '</a></span>';
}

// returns WordPress subdirectory if applicable
function wp_base_dir() {
  preg_match('!(https?://[^/|"]+)([^"]+)?!', site_url(), $matches);
  if (count($matches) === 3) {
    return end($matches);
  } else {
    return '';
  }
}

// opposite of built in WP functions for trailing slashes
function leadingslashit($string) {
  return '/' . unleadingslashit($string);
}

function unleadingslashit($string) {
  return ltrim($string, '/');
}

function add_filters($tags, $function) {
  foreach($tags as $tag) {
    add_filter($tag, $function);
  }
}

function is_element_empty($element) {
  $element = trim($element);
  return empty($element) ? false : true;
}

// Disable rel=next on home
function wpseo_disable_rel_next_home( $link ) {
  if ( is_home() ) {
    return false;
  }
}

function paragraph_to_unorderedlist($text, $class = '',$multi=false)
{
  if($text=='')return '';
  $text = nl2br($text);
  $lines = explode('<br />', $text);
  $text = '<ul' . ($class ? ' class="' . $class . '"' : '') . '>';
  $start=false;
  foreach ($lines as $line) :
    if($multi==true){
      if(substr(trim($line),0,2)!='- '){
        if($start==true){
          $text .= '</li>';
          $start=true;
        }
        $text .= '<li>' . '<span>'.$line . '</span>'. '';
      }
      else{
        $start=true;
        $text .= '<br/>' . $line . '';
      }

    }
    else{
      $text .= '<li>' . $line . '</li>';
    }

  endforeach;
  $text .= '</ul>';
  return $text;
}


// ********************************************
// SEO Title
// ********************************************

function stormbringer_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() )
    return $title;

  // Add the site name.
  $title .= get_bloginfo( 'name' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 )
    $title = "$title $sep " . sprintf( __( 'Page %s', 'stormbringer' ), max( $paged, $page ) );

  return $title;
}
add_filter( 'wp_title', 'stormbringer_wp_title', 10, 2 );



/**
 * Wrap embedded media as suggested by Readability
 *
 * @link https://gist.github.com/965956
 * @link http://www.readability.com/publishers/guidelines#publisher
 */
function stormbringer_embed_wrap($cache, $url, $attr = '', $post_ID = '') {
  return '<div class="embed">' . $cache . '</div>';
}
add_filter('embed_oembed_html', 'stormbringer_embed_wrap', 10, 4);
add_filter('embed_googlevideo', 'stormbringer_embed_wrap', 10, 2);

// -------------------------------------------------------
// Other

function meta() {
  //echo "\n". '<!-- compat -->' . "\n";
  echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
}
add_action('wp_head', 'meta',1);

function ietweaks() {
  //echo "\n". '<!-- ie tweaks -->' . "\n";
  echo '<meta http-equiv="imagetoolbar" content="no">' . "\n";
  echo '<meta name="MSSmartTagsPreventParsing" content="true">' . "\n";
}
//add_action('wp_head', 'ietweaks',100);
