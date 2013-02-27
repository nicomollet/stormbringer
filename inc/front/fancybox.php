<?php

/**
 * Fancybox - (http://fancybox.net)
 */

function stormbringer_fancybox_js_footer() {
  if(FANCYBOX==true)
    wp_enqueue_script('jquery.fancybox.js', get_template_directory_uri().'/js/fancybox/jquery.fancybox-1.3.4_patch.js', array(),null, true );

}
add_action('wp_enqueue_scripts', 'stormbringer_fancybox_js_footer',50);


function stormbringer_fancybox_css_header() {
  if(FANCYBOX==true){
    wp_register_style( 'stormbringer-fancybox',  get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css',   array(), null,    'screen,projection' );
    wp_enqueue_style( 'stormbringer-fancybox' );
  }

}
add_action('wp_enqueue_scripts', 'stormbringer_fancybox_css_header',0);
