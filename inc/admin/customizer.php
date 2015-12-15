<?php
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function stormbringer_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



	$wp_customize->add_section( 'favicon', array(
		'title'    => __( 'Favicon', 'stormbringer' ),
		'priority' => 10,
	) );

	// Setting - Theme Color
	$wp_customize->add_setting(
		'favicon_theme_color',
		array(
			'default'		=> '#333',
			'transport'		=> 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// Control - Theme Color
	$wp_customize->add_control(
		new WP_Customize_Color_Control (
			$wp_customize, 'favicon_theme_color',
			array (
				'label'		=> __( 'Theme Color', 'stormbringer' ),
				'section'	=> 'favicon',
				'settings'	=> 'favicon_theme_color',
				'priority'	=> 10
			)
		)
	);

	// Setting - Mask Color
	$wp_customize->add_setting(
		'favicon_mask_color',
		array(
			'default'		=> '#333',
			'transport'		=> 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// Control - Mask Color
	$wp_customize->add_control(
		new WP_Customize_Color_Control (
			$wp_customize, 'favicon_mask_color',
			array (
				'label'		=> __( 'Mask Color', 'stormbringer' ),
				'section'	=> 'favicon',
				'settings'	=> 'favicon_mask_color',
				'priority'	=> 10
			)
		)
	);

	// Setting - Tile Color
	$wp_customize->add_setting(
		'favicon_tile_color',
		array(
			'default'		=> '#333',
			'transport'		=> 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// Control - Tile Color
	$wp_customize->add_control(
		new WP_Customize_Color_Control (
			$wp_customize, 'favicon_tile_color',
			array (
				'label'		=> __( 'Tile Color', 'stormbringer' ),
				'section'	=> 'favicon',
				'settings'	=> 'favicon_tile_color',
				'priority'	=> 10
			)
		)
	);

	// Setting - Favicons folder
	$wp_customize->add_setting('favicon_folder[folder]', array(
		'default'        => 'root',
		'capability'     => 'edit_theme_options',
		//'type'           => 'option',
	));

	// Control - Tile Color
	$wp_customize->add_control('favicon_folder', array(
		'label'      => __('Folder', 'stormbringer'),
		'section'    => 'favicon',
		'description'    => __('Use http://realfavicongenerator.net to generate the favicons', 'stormbringer'),
		'settings'   => 'favicon_folder[folder]',
		'type'       => 'radio',
		'choices'    => array(
			'root' => __('Relative to the root folder /', 'stormbringer'),
			'theme' => __('Relative to the theme folder /wp-content/themes/themename/img/favicon/', 'stormbringer'),
		),
	));

	// Setting - Copyright Message
	$wp_customize->add_setting(
		'favicon_appname',
		array(
			'default'		=> get_bloginfo(),
			'transport'		=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	// Control - Copyright Message
	$wp_customize->add_control(
		'favicon_appname',
		array(
			'section'		=> 'favicon',
			'label'			=> __( 'Application name', 'stormbringer' ),
			'type'			=> 'text'
		)
	);



	/*------------------------------------------
	# Theme Options
	------------------------------------------*/

	// Section
	$wp_customize->add_section(
		'stormbringer_theme_options',
		array (
			'title'			=> __( 'Theme Options', 'stormbringer' ),
			'description'	=> __('More options.', 'stormbringer' ),
			'priority'		=> 500
		)
	);

	// Setting - Copyright Message
	$wp_customize->add_setting(
		'stormbringer_footer_message',
		array(
			'default'		=> __( 'Copyright 2015', 'stormbringer' ),
			'transport'		=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	// Control - Copyright Message
	$wp_customize->add_control(
		'stormbringer_footer_message',
		array(
			'section'		=> 'stormbringer_theme_options',
			'label'			=> __( 'Footer Message', 'stormbringer' ),
			'type'			=> 'text'
		)
	);

}
add_action( 'customize_register', 'stormbringer_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function stormbringer_customize_preview() {
	wp_enqueue_script( 'stormbringer_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery', 'customize-preview' ), null, true );
}
//add_action( 'customize_preview_init', 'stormbringer_customize_preview' );
