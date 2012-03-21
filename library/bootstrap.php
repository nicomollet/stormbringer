<?php


function bootstrap_js_footer() {
    if (!is_admin()) {
      echo "\n". '<!-- bootstrap js -->' . "\n";
      echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/'.JQUERY_VERSION.'/jquery.min.js"></script>' . "\n";
      echo '<script>window.jQuery || document.write(\'<script src="'.get_template_directory_uri().'/js/jquery.min.js"><\/script>\')</script>' . "\n";
      echo '<script src="'.get_template_directory_uri().'/js/bootstrap.js"></script>' . "\n";
      echo '<script src="'.get_template_directory_uri().'/js/common.js"></script>' . "\n";
      echo '<script src="'.get_template_directory_uri().'/js/app.js"></script>' . "\n";
    }
}

function bootstrap_js_header() {
    if (!is_admin()) {
      echo "\n". '<!-- bootstrap js -->' . "\n";
      echo '<script src="'.get_template_directory_uri().'/js/modernizr.full.min.js"></script>' . "\n";
    }
}

function bootstrap_css() {

    echo "\n". '<!-- bootstrap css -->' . "\n";

    // less.js for admin
    if ( current_user_can('administrator') ) {
      echo '<link rel="stylesheet/less" href="'.get_template_directory_uri().'/less/_application.less" media="screen,projection"/>' . "\n";
      echo '<link rel="stylesheet/less" href="'.get_template_directory_uri().'/less/responsive.less" media="screen,projection"/>' . "\n";
      echo '<script src="'.get_template_directory_uri().'/js/less.js"></script>' . "\n";
      echo "<script>/* Provisory for dev environment: */ localStorage.clear(); less = { env: 'development' };</script>" . "\n";
    }
    // compile with lessphp http://leafo.net/lessphp/ for users
    else{
      try {
          lessc::ccompile(STYLESHEETPATH.'/less/_application.less', STYLESHEETPATH.'/css/application.css');
          lessc::ccompile(STYLESHEETPATH.'/less/responsive.less', STYLESHEETPATH.'/css/responsive.css');
      } catch (exception $ex) {
          exit('lessc fatal error:<br />'.$ex->getMessage());
      }
      echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/application.css" media="screen,projection"/>' . "\n";
      if(BOOTSTRAP_RESPONSIVE==true)echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/responsive.css" media="screen,projection"/>' . "\n";
    }
    // echo in header

	  //echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/common.css" media="screen,projection"/>' . "\n";
	  echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/print.css" media="print"/>' . "\n";
}

add_action('wp_head', 'bootstrap_js_header',30);
add_action('wp_footer', 'bootstrap_js_footer',1);
add_action('wp_head', 'bootstrap_css',1);




