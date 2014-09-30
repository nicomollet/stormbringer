<?php

/**
 * Show an admin notice if .htaccess isn't writable
 */
function stormbringer_htaccess_writable() {
  if (current_theme_supports('h5bp-htaccess')) {
    if (!is_writable(get_home_path() . '.htaccess')) {
      if (current_user_can('administrator')) {
        add_action('admin_notices', create_function('', "echo '<div class=\"error\"><p>" . sprintf(__('Please make sure your <a href="%s">.htaccess</a> file is writable ', 'roots'), admin_url('options-permalink.php')) . "</p></div>';"));
      }
    }
  }
}
add_action('admin_init', 'stormbringer_htaccess_writable');

/**
 * Add HTML5 Boilerplate's .htaccess via WordPress
 */
function stormbringer_add_h5bp_htaccess($content) {
  global $wp_rewrite;
  $home_path = function_exists('get_home_path') ? get_home_path() : ABSPATH;
  $htaccess_file = $home_path . '.htaccess';
  $mod_rewrite_enabled = function_exists('got_mod_rewrite') ? got_mod_rewrite() : false;

  if ((!file_exists($htaccess_file) && is_writable($home_path) && $wp_rewrite->using_mod_rewrite_permalinks()) || is_writable($htaccess_file)) {
    if ($mod_rewrite_enabled) {
      $h5bp_rules = extract_from_markers($htaccess_file, 'HTML5 Boilerplate');
      if ($h5bp_rules === array()) {
        $filename = dirname(__FILE__) . '/h5bp-htaccess';
        return insert_with_markers($htaccess_file, 'HTML5 Boilerplate', extract_from_markers($filename, 'HTML5 Boilerplate'));
      }
    }
  }

  return $content;
}

if (current_theme_supports('h5bp-htaccess')) {
  add_action('generate_rewrite_rules', 'stormbringer_add_h5bp_htaccess');
}
