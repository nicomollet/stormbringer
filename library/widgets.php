<?php
// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');



// first and last classes for widgets
// http://wordpress.org/support/topic/how-to-first-and-last-css-classes-for-sidebar-widgets
function roots_widget_first_last_classes($params) {
  global $my_widget_num;
  $this_id = $params[0]['id'];
  $arr_registered_widgets = wp_get_sidebars_widgets();

  if (!$my_widget_num) {
    $my_widget_num = array();
  }

  if (!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) {
    return $params;
  }

  if (isset($my_widget_num[$this_id])) {
    $my_widget_num[$this_id] ++;
  } else {
    $my_widget_num[$this_id] = 1;
  }

  $class = 'class="widget-' . $my_widget_num[$this_id] . ' ';

  if ($my_widget_num[$this_id] == 1) {
    $class .= 'widget-first ';
  } elseif ($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) {
    $class .= 'widget-last ';
  }

  $params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']);

  return $params;

}
add_filter('dynamic_sidebar_params', 'roots_widget_first_last_classes');