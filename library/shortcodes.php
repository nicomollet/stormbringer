<?php

// Gallery shortcode
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'roots_gallery_shortcode');

// cleanup gallery_shortcode()
function roots_gallery_shortcode($attr) {
  global $post, $wp_locale;

  static $instance = 0;
  $instance++;

  // Allow plugins/themes to override the default gallery template.
  $output = apply_filters('post_gallery', '', $attr);
  if ($output != '') {
    return $output;
  }

  // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
  if (isset($attr['orderby'])) {
    $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
    if (!$attr['orderby']) {
      unset($attr['orderby']);
    }
  }

  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'icontag'    => 'li',
    'excerpttag' => 'p',
    'captiontag' => 'div',
    'titletag' => 'h5',
    'columns'    => 3,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => ''
  ), $attr));

  $id = intval($id);
  if ('RAND' == $order) {
    $orderby = 'none';
  }

  if (!empty($include)) {
    $include = preg_replace( '/[^0-9,]+/', '', $include );
    $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

    $attachments = array();
    foreach ($_attachments as $key => $val) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif (!empty($exclude)) {
    $exclude = preg_replace('/[^0-9,]+/', '', $exclude);
    $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  } else {
    $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  }

  if (empty($attachments)) {
    return '';
  }

  if (is_feed()) {
    $output = "\n";
    foreach ($attachments as $att_id => $attachment)
      $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    return $output;
  }

  $captiontag = tag_escape($captiontag);
  $columns = intval($columns);
  $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
  $float = is_rtl() ? 'right' : 'left';

  $selector = "gallery-{$instance}";

  $gallery_style = $gallery_div = '';
  if (apply_filters('use_default_gallery_style', true)) {
    $gallery_style = "";
  }
  $size_class = sanitize_html_class($size);
  $gallery_div = "<ul id='$selector' class='thumbnails gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
  $output = apply_filters('gallery_style', $gallery_style . "\n\t\t" . $gallery_div);

  $i = 0;
  foreach ($attachments as $id => $attachment) {
    $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

    $class="span2";
    if($size=="thumbnail")$class=GALLERY_THUMBNAIL_CLASSES;
    if($size=="medium")$class=GALLERY_MEDIUM_CLASSES;
    if($size=="large")$class=GALLERY_LARGE_CLASSES;

    $output .= "<{$icontag} class=\"".$class."\"><div class=\"thumbnail\">";

    $output .=  $link;
    if ($captiontag && trim($attachment->post_title)) {
      $output .= "
        <{$captiontag} class=\"caption\">
          <{$titletag}>" . wptexturize($attachment->post_title) . "</{$titletag}>";
       if(trim($attachment->post_excerpt))$output .= "<{$excerpttag}>" . wptexturize($attachment->post_excerpt) . "</{$excerpttag}>";

      $output .= "</{$captiontag}>";
    }

    $output .= "</div></{$icontag}>";
    if ($columns > 0 && ++$i % $columns == 0) {
      $output .= '';
    }
  }

  $output .= "</ul>\n";

  return $output;
}

/* The following shortcodes are from Alien Ship theme by mindctrl https://github.com/mindctrl/alienship

/* =Alerts - Types are 'info', 'error', 'success', and unspecified(which displays a default color). Specify a heading text. See example.
 *  Example: [alert type="success" heading="Congrats!"]You won the lottery![/alert]
----------------------------------------------- */
if ( ! function_exists( 'stormbringer_alert' ) ):
function stormbringer_alert($atts, $content = null) {
   extract(shortcode_atts(array('type' => 'alert', 'heading' => ''), $atts));
   if ($type != "alert") {
   return '<div class="alert alert-'.$type.' fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>'. do_shortcode($heading) .'</strong><p> ' . do_shortcode($content) . '</p></div>';
   } else {
   return '<div class="'.$type.' fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>'. do_shortcode($heading) .'</strong>' . do_shortcode($content) . '</div>';
   }
}
add_shortcode('alert', 'stormbringer_alert');
endif;



/* =Badges
-----------------------------------------------
* [badge] shortcode. Options for type are default, success, warning, error, info, and inverse. If a type of not specified, default is used.
* Example: [badge type="important"]1[/badge] */
if ( ! function_exists( 'stormbringer_badge' ) ):
function stormbringer_badge($atts, $content = null) {
   extract(shortcode_atts(array('type' => 'badge'), $atts));
   if ($type != "badge") {
   return '<span class="badge badge-'.$type.'">' . do_shortcode($content) . '</span>';
   } else {
   return '<span class="'.$type.'">' . do_shortcode($content) . '</span>';
   }
}
add_shortcode('badge', 'stormbringer_badge');
endif;



/* =Buttons
----------------------------------------------- */
/* [button] shortcode. Options for type= are "primary", "info", "success", "warning", "danger", and "inverse".
 * Options for size are mini, small, medium and large. If none is specified it defaults to medium size.
 * Example: [button type="info" size="large" link="http://yourlink.com"]Button Text[/button] */
if ( ! function_exists( 'stormbringer_button' ) ):
function stormbringer_button($atts, $content = null) {
   extract(shortcode_atts(array('link' => '#', 'type' => '', 'size' => 'medium'), $atts));

   if (empty($type)) {
    $type = "btn";
   } else {
    $type = "btn btn-" . $type;
   }

   if ($size == "medium") {
    $size = "";
   } else {
    $size = "btn-" . $size;
   }

   return '<a class="'.$type.' '.$size.'" href="'.$link.'">' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'stormbringer_button');
endif;



/* =Labels
-----------------------------------------------
* [label] shortcode. Options for type= are "default", important", "info", "success", "warning", and "inverse". If a type of not specified, default is used.
* Example: [label type="important"]Label text[/label] */
if ( ! function_exists( 'stormbringer_label' ) ):
function stormbringer_label($atts, $content = null) {
   extract(shortcode_atts(array('type' => 'label'), $atts));
   if ($type != "label") {
   return '<span class="label label-'.$type.'">' . do_shortcode($content) . '</span>';
   } else {
   return '<span class="'.$type.'">' . do_shortcode($content) . '</span>';
   }
}
add_shortcode('label', 'stormbringer_label');
endif;



/* =Panels
-----------------------------------------------
* [panel] shortcode. Columns defaults to 6. You can specify columns in the shortcode.
* Example: [panel columns="4"]Your panel text here.[/panel] */
if ( ! function_exists( 'stormbringer_panel' ) ):
function stormbringer_panel( $atts, $content = null ) {
   extract(shortcode_atts(array('columns' => '6'), $atts));
   $gridsize = '12';
   $span = '"span';
   if ($columns != "12") {
   $span .= ''.$columns.'"';
   $spanfollow = $gridsize - $columns;
   return '<div class="row-fluid"><div class='.$span.'><div class="panel"><p>' . do_shortcode($content) . '</p></div></div><div class="span'.$spanfollow.'">&nbsp;</div></div><div class="clear"></div>'; }
   else {
      $span .= ''.$columns.'"';
      return '<div class="row-fluid"><div class='.$span.'><div class="panel"><p>' . do_shortcode($content) . '</p></div></div></div><div class="clear"></div>';
   }
}
add_shortcode('panel', 'stormbringer_panel');
endif;



/* =Wells
-----------------------------------------------
* [well] shortcode.
* Example: [well]Your text here.[/well] */
if ( ! function_exists( 'stormbringer_well' ) ):
function stormbringer_well($atts, $content = null) {
   return '<div class="well">' . do_shortcode($content) .'</div>';
}
add_shortcode('well', 'stormbringer_well');
endif;

// Block Messages
function stormbringer_blockquotes( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'float' => '', /* left, right */
	'cite' => '', /* text for cite */
	), $atts ) );
	
	$output = '<blockquote';
	if($float == 'left') {
		$output .= ' class="pull-left"';
	}
	elseif($float == 'right'){
		$output .= ' class="pull-right"';
	}
	$output .= '><p>' . $content . '</p>';
	
	if($cite){
		$output .= '<small>' . $cite . '</small>';
	}
	
	$output .= '</blockquote>';
	
	return $output;
}

add_shortcode('blockquote', 'stormbringer_blockquotes');
 



?>