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
	if (!is_admin()) {
		wp_deregister_script('jquery');                                   // De-Register jQuery
		wp_register_script('jquery', '', '', '', true);
	}

}
add_action('init', 'stormbringer_head_cleanup');



// staging: noindex
function stormbringer_staging_noindex() {
  if (get_option('blog_public') === '0') {
    echo '<meta name="robots" content="noindex,nofollow,noarchive,nosnippet">', "\n";
  }
}



// remove rel=�category tag�
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

// Disable rel=�next� on home
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

function remove_contactmethods( $contactmethods ) {
  unset($contactmethods['aim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['yim']);
  return $contactmethods;
}
add_filter('user_contactmethods','remove_contactmethods',10,1);