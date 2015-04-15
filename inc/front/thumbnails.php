<?php

// Remove height/width attributes on images so they can be responsive
//add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
//add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}



// Add thumbnail class to thumbnail links
function add_class_attachment_link($html){

  $classes='';

	$lightbox ='';
	if(current_theme_supports('lightbox')){
		$lightbox = get_theme_support('lightbox')[0];
	}

  if($lightbox=='fancybox')$classes='fancybox';
  if($lightbox=='tbmodal')$classes='modal-open-image';

  if($classes!=''){
    $html = str_replace('<a','<a class="'.$classes.'"',$html);
  }

  return $html;
}
add_filter('wp_get_attachment_link','add_class_attachment_link',10,1);


function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){

  $classes='';

	$lightbox ='';
	if(current_theme_supports('lightbox')){
		$lightbox = get_theme_support('lightbox')[0];
	}

  if($lightbox=='fancybox')$classes='fancybox';
  if($lightbox=='tbmodal')$classes='modal-open-image';
  if($classes!='')
  {
    // check if there are already classes assigned to the anchor
    if ( preg_match('/<a.*? class=".*?">/', $html) ) {
      $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
    } else {
      $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
    }
  } // separated by spaces, e.g. 'img image-link'
  $html = str_replace("wp-image","thumbnail wp-image",$html);
  $html = str_replace(    '<a',    '<a data-title="'.$caption.'" title="'.$caption.'"',    $html  );

  return $html;
}
add_filter('image_send_to_editor','give_linked_images_class',11,8);


//Add title attribute back to gallery images
function my_image_titles($atts,$img) {
	$atts['title'] = trim(strip_tags( $img->post_excerpt ));
	return $atts;
}
add_filter('wp_get_attachment_image_attributes','my_image_titles',10,2);

function roots_caption($output, $attr, $content) {
  if (is_feed()) {
    return $output;
  }

  $defaults = array(
    'id'      => '',
    'align'   => 'alignnone',
    'width'   => '',
    'caption' => ''
  );

  $attr = shortcode_atts($defaults, $attr);

  // If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
  if ($attr['width'] < 1 || empty($attr['caption'])) {
    return $content;
  }

  // Set up the attributes for the caption <figure>
  $attributes  = (!empty($attr['id']) ? ' id="' . esc_attr($attr['id']) . '"' : '' );
  $attributes .= ' class="thumbnail wp-caption ' . esc_attr($attr['align']) . '"';
  if($attr['align'] == 'alignright' || $attr['align'] == 'alignleft' )
      $attributes .= ' style="width: ' . esc_attr($attr['width']) . 'px"';

  $output  = '<figure' . $attributes .'>';
  $content = str_replace("thumbnail wp-image","wp-image",$content);
  $output .= do_shortcode($content);
  $output .= '<figcaption class="caption wp-caption-text">' . $attr['caption'] . '</figcaption>';
  $output .= '</figure>';

  return $output;
}
add_filter('img_caption_shortcode', 'roots_caption', 10, 3);


function change_avatar_css($class) {
  $class = str_replace("class='avatar", "class='avatar media-object", $class) ;
  return $class;
}
add_filter('get_avatar','change_avatar_css');
