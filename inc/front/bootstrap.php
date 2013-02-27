<?php




// -------------------------------------------------------
// CSS

function stormbringer_bootstrap_css() {


// less.js for admin (developemet only)
if ( current_user_can('administrator') && (ENVIRONMENT == "dev" || ENVIRONMENT == "local")) {
  echo '<!-- Less -->' . "\n";
  echo '<link rel="stylesheet/less" href="'.get_template_directory_uri().'/less/_application.less" media="screen,projection"/>' . "\n";
  if(BOOTSTRAP_RESPONSIVE==true)echo '<link rel="stylesheet/less" href="'.get_template_directory_uri().'/less/responsive.less" media="screen,projection"/>' . "\n";
  echo '<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.3.3/less.min.js"></script>' . "\n";
  echo "<script type='text/javascript'>less.env = 'development';less.async = true;less.poll = 100;less.watch();</script>" . "\n";
}
// compile with lessphp http://leafo.net/lessphp/ for users
else{
  try {
      lessc::ccompile(STYLESHEETPATH.'/less/_application.less', STYLESHEETPATH.'/css/application.css');
      if(BOOTSTRAP_RESPONSIVE==true)lessc::ccompile(STYLESHEETPATH.'/less/responsive.less', STYLESHEETPATH.'/css/responsive.css');
  } catch (exception $ex) {
      exit('Lessc fatal error:<br />'.$ex->getMessage());
  }
  wp_register_style ('stormbringer-app',  get_template_directory_uri() . '/css/application.css',   array(), null,    'screen,projection' );
  wp_enqueue_style  ('stormbringer-app');
  if(BOOTSTRAP_RESPONSIVE==true){
    wp_register_style ('stormbringer-responsive',  get_template_directory_uri() . '/css/responsive.css',   array(), null,    'screen,projection' );
    wp_enqueue_style  ('stormbringer-responsive');
  }
}

wp_register_style( 'stormbringer-print',  get_template_directory_uri() . '/css/print.css',   array(), null,    'print' );
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
