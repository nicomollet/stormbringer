<?php

/**
 * Main Menu Walker - Thanks to Alien Ship (http://www.johnparris.com/alienship)
 */
class stormbringer_Navbar_Nav_Walker extends Walker_Nav_Menu
{
  function start_el(&$output, $item, $depth, $args)
  {
    global $wp_query;
    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $class_names = $value = '';

    // If the item has children, add the dropdown class for bootstrap
    if ($args->has_children) {
      $class_names = "dropdown ";
    }

    $classes = empty($item->classes) ? array() : (array)$item->classes;

    $class_names .= join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $output .= $indent . '<li id="' . $args->menu . '_menu_item_' . $item->ID . '"' . $value . $class_names . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
    // if the item has children add these two attributes to the anchor tag
    if ($args->has_children) {
      $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
    }

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID);
    $item_output .= $args->link_after;
    // if the item has children add the caret just before closing the anchor tag
    if ($args->has_children) {
      $item_output .= '<b class="caret"></b>';
      $item_output .= '</a>';
    }
    else {
      $item_output .= '</a>';
    }
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }

  function start_lvl(&$output, $depth)
  {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }

  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
  {
    $id_field = $this->db_fields['id'];
    if (is_object($args[0])) {
      $args[0]->has_children = !empty($children_elements[$element->$id_field]);
    }
    return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }


}

/**
 * Top Menu fallback callback. If no menu is assigned, let's assign one - and optionally create one if needed.
 * Thanks to Alin Ship (http://www.johnparris.com/alienship)
 */
function stormbringer_menu_fallback()
{
  $locations = get_theme_mod('nav_menu_locations');
  if (!has_nav_menu('top') && !is_nav_menu('Blank Top Menu')) {
    //$locations['top'] = wp_create_nav_menu('Blank Top Menu', array('slug' => 'top'));
    set_theme_mod('nav_menu_locations', $locations);
  } else {
    $locations['top'] = 'Blank Top Menu';
    set_theme_mod('nav_menu_locations', $locations);
  }
}

// add order class to first levels or a menu
function stormbringer_menu_order($items)
{

  $i = 0;
  foreach ($items as $key => $value) {
    if ($value->menu_item_parent == 0) {
      $i++;
      $items[$key]->classes[] = 'menu_order_' . $i;
    }

  }
  return $items;
}

add_filter('wp_nav_menu_objects', 'stormbringer_menu_order');
