<?php

// -------------------------------------------------------
// CSS

function stormbringer_bootstrap_css()
{

  if (PREPROCESSOR == 'less') {
    if (!is_admin()) {
      // less.js for admin (development only)
      //if ( current_user_can('administrator') && (ENVIRONMENT == "dev" || ENVIRONMENT == "local")) {
      if (current_user_can('administrator') && $_GET['lesscompile'] != '1') {
        echo '<!-- Less -->' . "\n";
        echo '<link rel="stylesheet/less" href="' . get_template_directory_uri() . '/less/_application.less" media="screen,projection"/>' . "\n";
        echo '<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.6.2/less.min.js"></script>' . "\n";
        echo "<script type='text/javascript'>less.env = 'development';less.async = true;less.poll = 600;less.watch();</script>" . "\n";
      } // compile with lessphp http://leafo.net/lessphp/ for users
      else {
        $to_cache = array(STYLESHEETPATH . '/less/_application.less' => '');
        Less_Cache::$cache_dir = STYLESHEETPATH . '/css/';
        $css_file_name = Less_Cache::Get($to_cache);
        wp_register_style('stormbringer-app', get_template_directory_uri() . '/css/application.css', array(), null, 'screen,projection');
        wp_enqueue_style('stormbringer-app');
      }

      wp_register_style('stormbringer-print', get_template_directory_uri() . '/css/print.css', array(), null, 'print');
      wp_enqueue_style('stormbringer-print');
    }
  }

  if (PREPROCESSOR == 'scss') {



    if (!is_admin()) {
      if (current_user_can('administrator') && $_GET['lesscompile'] != '1') {
        echo '<script src="'.get_bloginfo('url').':8080/livereload.js"></script>' . "\n";
        wp_register_style('stormbringer-app', get_template_directory_uri() . '/css/application.css', array(), null, 'screen,projection');
        wp_enqueue_style('stormbringer-app');
      }
      else{
        wp_register_style('stormbringer-app', get_template_directory_uri() . '/css/application.min.css', array(), null, 'screen,projection');
        wp_enqueue_style('stormbringer-app');
      }
    }

    wp_register_style('stormbringer-print', get_template_directory_uri() . '/css/print.css', array(), null, 'print');
    wp_enqueue_style('stormbringer-print');
  }

}
add_action('wp_enqueue_scripts', 'stormbringer_bootstrap_css',10);

