<?php
// html editor styles
add_editor_style( 'css/styles.css' );

add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );

function my_mce_before_init( $settings ) {

	$style_formats = array(

		array(
			'title'   => __('Lead', 'stormbringer'),
			'block'   => 'p',
			'classes' => 'lead',
		),
		array(
			'title'   => __('Small', 'stormbringer'),
			'inline'   => 'small',
		),
		array(
			'title'   => __('Muted', 'stormbringer'),
			'block'   => 'p',
			'classes' => 'text-muted',
		),
		array(
			'title'   => __('Alert Error', 'stormbringer'),
			'block'   => 'div',
			'classes' => 'alert alert-error',
			'wrapper' => true
		),
		array(
			'title'   => __('Alert Success', 'stormbringer'),
			'block'   => 'div',
			'classes' => 'alert alert-success',
			'wrapper' => true
		),
		array(
			'title'   => __('Alert Warning', 'stormbringer'),
			'block'   => 'div',
			'classes' => 'alert alert-warning',
			'wrapper' => true
		),
		array(
			'title'   => __('Alert Info', 'stormbringer'),
			'block'   => 'div',
			'classes' => 'alert alert-info',
			'wrapper' => true
		),
		array(
			'title'    => __('Button', 'stormbringer'),
			'selector' => 'a',
			'classes'  => 'btn btn-default',
		),
		array(
			'title'    => __('Button Primary', 'stormbringer'),
			'selector' => 'a',
			'classes'  => 'btn btn-primary',
		),

	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;

}


add_filter( "mce_buttons", "extended_editor_mce_buttons", 0 );
add_filter( "mce_buttons_2", "extended_editor_mce_buttons_2", 0 );

function extended_editor_mce_buttons( $buttons ) {
	return array(
		'bold',
		'italic',
		'strikethrough',
		'|',
		'bullist',
		'numlist',
		'blockquote',
		'|',
		'link',
		'unlink',
		'|',
		'formatselect',
		'styleselect',
		'wp_adv'
	);
}

function extended_editor_mce_buttons_2( $buttons ) {
// the second toolbar line
	return array(
		'justifyleft',
		'justifycenter',
		'justifyright',
		'|',
		'pastetext',
		'pasteword',
		'removeformat',
		'|',
		'outdent',
		'indent',
		'hr',
		'wp_more',
		'|',
	);
}


/* To add custom styles to Rich Text Editor, use this function in functions.php:

function custom_tinymce_styles( $settings ) {

	$style_formats_original = json_decode( $settings['style_formats'] );
	$style_formats          = array(

		// Inline style
		array(
			'title'   => 'Color Red',
			'inline'  => 'span',
			'classes' => 'red',
		),

		// Selector style
		array(
			'title'    => 'Button Info',
			'selector' => 'a',
			'classes'  => 'btn btn-info',
		),

		// Block style
		array(
			'title'   => 'Big',
			'block'   => 'p',
			'classes' => 'big',
		),

	);

	$settings['style_formats'] = json_encode( array_merge( $style_formats, $style_formats_original ) );

	return $settings;

}
add_filter( 'tiny_mce_before_init', 'custom_tinymce_styles', 100 );

*/