<?php


// -------------------------------------------------------
// JS header

function stormbringer_modernizr_js_header() {
  wp_enqueue_script('modernizr.js', get_template_directory_uri().'/js/modernizr.js', array(),false, false );

}
add_action('wp_enqueue_scripts', 'stormbringer_modernizr_js_header',50);



// -------------------------------------------------------
// JS footer

function stormbringer_jquery_js_header() {
    if (!is_admin()) {
      echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/'.JQUERY_VERSION.'/jquery.min.js"></script>' . "\n";
      echo '<script>window.jQuery || document.write(\'<script src="'.get_template_directory_uri().'/js/jquery.js"><\/script>\')</script>' . "\n";

    }
}
add_action('wp_head', 'stormbringer_jquery_js_header',0);


function stormbringer_bootstrap_js_footer() {
  wp_enqueue_script('bootstrap.min.js', get_template_directory_uri().'/js/bootstrap.js', array('jquery'),'2.03', true );
  wp_enqueue_script('common.js', get_template_directory_uri().'/js/common.js', array('jquery'),false, true );
  wp_enqueue_script('app.js', get_template_directory_uri().'/js/app.js', array('jquery'),false, true );

}
add_action('wp_enqueue_scripts', 'stormbringer_bootstrap_js_footer',100);


// -------------------------------------------------------
// CSS

function stormbringer_bootstrap_css() {


    // less.js for admin (developemet only)
    if ( current_user_can('administrator') && (ENVIRONMENT == "dev" || ENVIRONMENT == "local")) {
      echo '<link rel="stylesheet/less" href="'.get_template_directory_uri().'/less/_application.less" media="screen,projection"/>' . "\n";
      if(BOOTSTRAP_RESPONSIVE==true)echo '<link rel="stylesheet/less" href="'.get_template_directory_uri().'/less/responsive.less" media="screen,projection"/>' . "\n";
      echo '<script src="'.get_template_directory_uri().'/js/less.js"></script>' . "\n";
      echo "<script>less.env = 'development'; less.watch();</script>" . "\n";
    }
    // compile with lessphp http://leafo.net/lessphp/ for users
    else{
      try {
          lessc::ccompile(STYLESHEETPATH.'/less/_application.less', STYLESHEETPATH.'/css/application.css');
          if(BOOTSTRAP_RESPONSIVE==true)lessc::ccompile(STYLESHEETPATH.'/less/responsive.less', STYLESHEETPATH.'/css/responsive.css');
      } catch (exception $ex) {
          exit('Lessc fatal error:<br />'.$ex->getMessage());
      }
      wp_register_style ('stormbringer-app',  get_template_directory_uri() . '/css/application.css',   array(), false,    'screen,projection' );
      wp_enqueue_style  ('stormbringer-app');
      if(BOOTSTRAP_RESPONSIVE==true){
        wp_register_style ('stormbringer-responsive',  get_template_directory_uri() . '/css/responsive.css',   array(), false,    'screen,projection' );
        wp_enqueue_style  ('stormbringer-responsive');
      }
    }

    wp_register_style( 'stormbringer-print',  get_template_directory_uri() . '/css/print.css',   array(), false,    'print' );
    wp_enqueue_style( 'stormbringer-print' );
}
add_action('wp_enqueue_scripts', 'stormbringer_bootstrap_css',10);

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
