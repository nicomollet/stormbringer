<?php
/**
 * Helpers functions
 *
 * @package StormBringer
 */

/**
 * Bootstrap auto clearfix from inside loops.
 * Put this function at the start of the loop before other bootstrap cols are called.
 *
 * @param       integer $counter_posts $i The count from within the loop where the function is called. Starting with 0.
 * @param       array   $args          ['xs'=> 12, 'sm' => 6, 'md' => 4, 'lg' => 3]
 * @param       string  $element
 * @param       int     $grid
 *
 * @return      string HTML
 * @author      Oran Blackwell
 * @version     1.0.1
 *
 * @since       0.2.0
 * @note        Currently only works on equally distributed columns (per group) eg. .col-xs-6(*n) or .col-sm-3(*n)
 * @todo        If array is passed for $xs, $sm... then assume non-equal widths and handle accordingly.
 * @todo        Pass multiple classes to a single div.
 * @todo        Add ability to include "+" to have a mobile first approach. ie "xs-12" & "sm-6+" will also apply for "md-6" & "lg-6"
 */
function stormbringer_bootstrap_grid(&$counter_posts = 0, $args = array(), $element = 'div', $grid = 12)
{
    $devices = array();
    $clearfix   = '';

    if (isset($args['xs']) && is_int($args['xs'])) {
        $devices[] = 'xs';
    }
    if (isset($args['sm']) && is_int($args['sm'])) {
        $devices[] = 'sm';
    }
    if (isset($args['md']) && is_int($args['md'])) {
        $devices[] = 'md';
    }
    if (isset($args['lg']) && is_int($args['lg'])) {
        $devices[] = 'lg';
    }

    foreach ($devices as $device) {
        $modulus = $grid / $args[$device];

        $clearfix .= ($counter_posts > 0 && $counter_posts % $modulus == 0 ? ' <'.$element.' class="clearfix visible-'.$device.'"></'.$element.'>' : '');
    }

    $counter_posts++;

    return $clearfix;
}



