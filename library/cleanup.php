<?php

/**
 * Cleaning up the Wordpress Head - Thanks to Roots Theme (Thanks to Roots Theme (http://www.rootstheme.com))
 */
function stormbringer_head_cleanup() {
	// remove header links
	remove_action( 'wp_head', 'feed_links_extra', 3 );                    // Category Feeds
	remove_action( 'wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
	remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' );                       // Windows Live Writer
	remove_action( 'wp_head', 'index_rel_link' );                         // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
	remove_action( 'wp_head', 'wp_generator' );                           // WP version
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  remove_action('wp_head', 'noindex', 1);
  add_action('wp_head', 'stormbringer_staging_noindex');
  add_action('wp_head', 'stormbringer_remove_recent_comments_style', 1);
  add_filter('use_default_gallery_style', '__return_false');
  add_filter('the_generator', 'stormbringer_rss_version');
  add_filter( 'the_category', 'stormbringer_remove_rel_category' );
	if (!is_admin()) {
		wp_deregister_script('jquery');                                   // De-Register jQuery
		wp_register_script('jquery', '', '', '', true);
	}
  if(false === get_option("medium_crop")) {
      add_option("medium_crop", "1");
  } else {
      update_option("medium_crop", "1");
  }

}
add_action('init', 'stormbringer_head_cleanup');

// staging: noindex
function stormbringer_staging_noindex() {
  if (get_option('blog_public') === '0') {
    echo '<meta name="robots" content="noindex,nofollow,noarchive,nosnippet">', "\n";
  }
}

// remove WP version from RSS
function stormbringer_rss_version() { return ''; }


// remove rel=”category tag”
function stormbringer_remove_rel_category( $text ) {
  $text = str_replace('rel="category tag"', "", $text); return $text;
}

// root relative URLs for everything
// inspired by http://www.456bereastreet.com/archive/201010/how_to_make_wordpress_urls_root_relative/
// thanks to Scott Walkinshaw (scottwalkinshaw.com)
function roots_root_relative_url($input) {
  $output = preg_replace_callback(
    '!(https?://[^/|"]+)([^"]+)?!',
    create_function(
      '$matches',
      // if full URL is site_url, return a slash for relative root
      'if (isset($matches[0]) && $matches[0] === site_url()) { return "/";' .
      // if domain is equal to site_url, then make URL relative
      '} elseif (isset($matches[0]) && strpos($matches[0], site_url()) !== false) { return $matches[2];' .
      // if domain is not equal to site_url, do not make external link relative
      '} else { return $matches[0]; };'
    ),
    $input
  );
  return $output;
}

// Terrible workaround to remove the duplicate subfolder in the src of JS/CSS tags
// Example: /subfolder/subfolder/css/style.css
function roots_fix_duplicate_subfolder_urls($input) {
  $output = roots_root_relative_url($input);
  preg_match_all('!([^/]+)/([^/]+)!', $output, $matches);
  if (isset($matches[1]) && isset($matches[2])) {
    if ($matches[1][0] === $matches[2][0]) {
      $output = substr($output, strlen($matches[1][0]) + 1);
    }
  }
  return $output;
}

if (!is_admin() && !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))) {
  add_filter('bloginfo_url', 'roots_root_relative_url');
  add_filter('theme_root_uri', 'roots_root_relative_url');
  add_filter('stylesheet_directory_uri', 'roots_root_relative_url');
  add_filter('template_directory_uri', 'roots_root_relative_url');
  //add_filter('script_loader_src', 'roots_fix_duplicate_subfolder_urls');
  //add_filter('style_loader_src', 'roots_fix_duplicate_subfolder_urls');
  add_filter('plugins_url', 'roots_root_relative_url');
  add_filter('the_permalink', 'roots_root_relative_url');
  add_filter('wp_list_pages', 'roots_root_relative_url');
  add_filter('wp_list_categories', 'roots_root_relative_url');
  add_filter('wp_nav_menu', 'roots_root_relative_url');
  add_filter('the_content_more_link', 'roots_root_relative_url');
  add_filter('the_tags', 'roots_root_relative_url');
  add_filter('get_pagenum_link', 'roots_root_relative_url');
  add_filter('get_comment_link', 'roots_root_relative_url');
  add_filter('month_link', 'roots_root_relative_url');
  add_filter('day_link', 'roots_root_relative_url');
  add_filter('year_link', 'roots_root_relative_url');
  add_filter('tag_link', 'roots_root_relative_url');
  add_filter('the_author_posts_link', 'roots_root_relative_url');
}

// remove root relative URLs on any attachments in the feed
function roots_root_relative_attachment_urls() {
  if (!is_feed()) {
    add_filter('wp_get_attachment_url', 'roots_root_relative_url');
    add_filter('wp_get_attachment_link', 'roots_root_relative_url');
  }
}
add_action('pre_get_posts', 'roots_root_relative_attachment_urls');

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

function stormbringer_excerpt_more($more) {
  return ' [&hellip;] <a href="' . get_permalink() . '">' . __( 'Read more&hellip;', 'roots' ) . '</a>';
}

add_filter('excerpt_length', 'stormbringer_excerpt_length');
add_filter('excerpt_more', 'stormbringer_excerpt_more');