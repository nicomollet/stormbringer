<?php
// html editor styles
add_editor_style('css/application.css');


add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );

function my_mce_before_init( $settings ) {

    $style_formats = array(
        array(
        	'title' => 'Big',
        	'block' => 'p',
        	'classes' => 'big',
        ),
        array(
        	'title' => 'Small',
        	'block' => 'p',
        	'classes' => 'small',
        ),
        array(
        	'title' => 'Alert Heading',
        	'block' => 'h4',
        	'classes' => 'alert-heading',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Alert Error',
        	'block' => 'div',
        	'classes' => 'alert alert-block alert-error',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Alert Success',
        	'block' => 'div',
        	'classes' => 'alert alert-block alert-success',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Alert Warning',
        	'block' => 'div',
        	'classes' => 'alert alert-block alert-warning',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Alert Info',
        	'block' => 'div',
        	'classes' => 'alert alert-block alert-info',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Button',
        	'selector' => 'a',
        	'classes' => 'btn',
        ),
        array(
        	'title' => 'Button Primary',
        	'selector' => 'a',
        	'classes' => 'btn btn-primary',
        ),
/*        array(
        	'title' => 'Button Info',
        	'selector' => 'a',
        	'classes' => 'btn btn-info',
        ),
        array(
        	'title' => 'Button Success',
        	'selector' => 'a',
        	'classes' => 'btn btn-success',
        ),
        array(
        	'title' => 'Button Warning',
        	'selector' => 'a',
        	'classes' => 'btn btn-warning',
        ),
        array(
        	'title' => 'Button Danger',
        	'selector' => 'a',
        	'classes' => 'btn btn-danger',
        ),
        array(
        	'title' => 'Button Inverse',
        	'selector' => 'a',
        	'classes' => 'btn btn-inverse',
        ),*/


    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}


add_filter("mce_buttons", "extended_editor_mce_buttons", 0);
add_filter("mce_buttons_2", "extended_editor_mce_buttons_2", 0);

function extended_editor_mce_buttons($buttons) {
return array(
    'bold', 'italic', 'strikethrough', '|',
    'bullist', 'numlist', 'blockquote', '|',
    'link', 'unlink',  '|',
    'formatselect', 'styleselect',
    'wp_adv' );
}

function extended_editor_mce_buttons_2($buttons) {
// the second toolbar line
return array(
    'justifyleft', 'justifycenter', 'justifyright', '|',
    'pastetext', 'pasteword', 'removeformat', '|',
    'outdent', 'indent', 'hr','wp_more','|',
     );
}