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
 * Show an admin notice if .htaccess isn't writable
 */
function stormbringer_htaccess_writable() {
  if (defined('H5BP_HTACCESS') && H5BP_HTACCESS==true) {
    if (!is_writable(get_home_path() . '.htaccess')) {
      if (current_user_can('administrator')) {
      add_action('admin_notices', create_function('', "echo '<div class=\"error\"><p>" . sprintf(__('Please make sure your <a href="%s">.htaccess</a> file is writable ', 'roots'), admin_url('options-permalink.php')) . "</p></div>';"));
    }
    }
  }
}
add_action('admin_init', 'stormbringer_htaccess_writable');

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

/**
 * Remove unnecessary dashboard widgets
 *
 * @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
 */
function stormbringer_remove_dashboard_widgets() {
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'normal');
  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
}
add_action('admin_init', 'stormbringer_remove_dashboard_widgets');

/**
 * Don't return the default description in the RSS feed if it hasn't been changed
 */
function roots_remove_default_description($bloginfo) {
  $default_tagline = 'Just another WordPress site';
  return ($bloginfo === $default_tagline) ? '' : $bloginfo;
}
add_filter('get_bloginfo_rss', 'roots_remove_default_description');