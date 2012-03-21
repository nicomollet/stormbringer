<?php

if(FANCYBOX==TRUE){
  function fancybox_js() {
      if (!is_admin()) {
        echo "\n". '<!-- fancybox js -->' . "\n";
        echo '<script src="'.get_template_directory_uri().'/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>' . "\n";
      }
  }
  

  function fancybox_css() {
      echo "\n". '<!-- fancybox css -->' . "\n";
      echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/js/fancybox/jquery.fancybox-1.3.4.css" media="screen,projection"/>' . "\n";
  }

  add_action('wp_footer', 'fancybox_js',20);
  add_action('wp_head', 'fancybox_css',20);
}
