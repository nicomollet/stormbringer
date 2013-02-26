<?php
// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}



// Add thumbnail class to thumbnail links
function add_class_attachment_link($html){
    if(FANCYBOX==true){
      $html = str_replace('<a','<a class="fancybox"',$html);
    }

    return $html;
}
add_filter('wp_get_attachment_link','add_class_attachment_link',10,1);


function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){

  if(FANCYBOX==true)
  {
    $classes = 'fancybox';
    // check if there are already classes assigned to the anchor
    if ( preg_match('/<a.*? class=".*?">/', $html) ) {
      $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
    } else {
      $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
    }
  } // separated by spaces, e.g. 'img image-link'
  $html = str_replace("wp-image","thumbnail wp-image",$html);
  $html = str_replace("<a","<a title=\"".$title."\"",$html);

  return $html;
}
add_filter('image_send_to_editor','give_linked_images_class',11,8);