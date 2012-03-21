<?php
// Cleaning up the Wordpress Head
function bones_head_cleanup() {
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
  add_action('wp_head', 'staging_noindex');
  add_action('wp_head', 'roots_remove_recent_comments_style', 1);
  add_filter('gallery_style', 'roots_gallery_style');
	if (!is_admin()) {
		wp_deregister_script('jquery');                                   // De-Register jQuery
		wp_register_script('jquery', '', '', '', true);                   // It's already in the Header
	}
  if(false === get_option("medium_crop")) {
      add_option("medium_crop", "1");
  } else {
      update_option("medium_crop", "1");
  }

}

// launching operation cleanup
add_action('init', 'bones_head_cleanup');
// remove WP version from RSS
function bones_rss_version() { return ''; }
add_filter('the_generator', 'bones_rss_version');

// staging: noindex
function staging_noindex() {
  if (get_option('blog_public') === '0') {
    echo '<meta name="robots" content="noindex,nofollow,noarchive,nosnippet">', "\n";
  }
}

function ietweaks() {
     echo "\n". '<!-- ie tweaks -->' . "\n";
     echo '<meta http-equiv="imagetoolbar" content="no">' . "\n";
     echo '<meta name="MSSmartTagsPreventParsing" content="true">' . "\n";
}
//add_action('wp_head', 'ietweaks',100);

function meta() {
     echo "\n". '<!-- compat -->' . "\n";
     echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
}
add_action('wp_head', 'meta',1);

// remove rel=”category tag”
function remove_rel_category( $text ) {
$text = str_replace('rel="category tag"', "", $text); return $text;
}
add_filter( 'the_category', 'remove_rel_category' );

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
  add_filter('script_loader_src', 'roots_fix_duplicate_subfolder_urls');
  add_filter('style_loader_src', 'roots_fix_duplicate_subfolder_urls');
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

// remove CSS from recent comments widget
function roots_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove CSS from gallery
function roots_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}


// http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
function roots_caption($output, $attr, $content) {
  /* We're not worried abut captions in feeds, so just return the output here. */
  if ( is_feed()) {
    return $output;
  }

  /* Set up the default arguments. */
  $defaults = array(
    'id' => '',
    'align' => 'alignnone',
    'width' => '',
    'caption' => ''
  );

  /* Merge the defaults with user input. */
  $attr = shortcode_atts($defaults, $attr);

  /* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
  if (1 > $attr['width'] || empty($attr['caption'])) {
    return $content;
  }

  /* Set up the attributes for the caption <div>. */
  $attributes = (!empty($attr['id']) ? ' id="' . esc_attr($attr['id']) . '"' : '' );
  $attributes .= ' class="thumbnail wp-caption ' . esc_attr($attr['align']) . '"';
  $attributes .= ' style="width: ' . esc_attr($attr['width']) . 'px"';

  /* Open the caption <div>. */
  $output = '<div' . $attributes .'>';

  /* Allow shortcodes for the content the caption was created for. */
  $output .= do_shortcode($content);

  /* Append the caption text. */
  $output .= '<div class="caption"><p class="wp-caption-text">' . $attr['caption'] . '</p></div>';

  /* Close the caption </div>. */
  $output .= '</div>';

  /* Return the formatted, clean caption. */
  return $output;
}

add_filter('img_caption_shortcode', 'roots_caption', 10, 3);

// excerpt cleanup
function roots_excerpt_length($length) {
  return POST_EXCERPT_LENGTH;
}

function roots_excerpt_more($more) {
  return ' [&hellip;] <a href="' . get_permalink() . '">' . __( 'Read more&hellip;', 'roots' ) . '</a>';
}

add_filter('excerpt_length', 'roots_excerpt_length');
add_filter('excerpt_more', 'roots_excerpt_more');