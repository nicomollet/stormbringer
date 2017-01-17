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
			'title'   => __('Alert Danger', 'stormbringer'),
			'block'   => 'div',
			'classes' => 'alert alert-danger',
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
			'classes'  => 'btn',
		),
		array(
			'title'    => __('Button Default', 'stormbringer'),
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
        'formatselect',

		'bold',
		'italic',

        'bullist',
        'numlist',
        'blockquote',

        'alignleft',
        'aligncenter',
        'alignright',

        'link',
        'unlink',

        'wp_more',
		'wp_adv'
	);
}

function extended_editor_mce_buttons_2( $buttons ) {
// the second toolbar line
	return array(
        'styleselect',
        'strikethrough',
        'hr',
		'pastetext',
		'pasteword',
		'removeformat',
		'charmap',
		'outdent',
		'indent',
		'wp-help',
	);
}
