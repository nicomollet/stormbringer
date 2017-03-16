<?php
/**
 * Theme Customizer
 *
 * Code adapted from Underscores theme (underscores.me) and Otto's great tutorial (ottopress.com)
 *
 * @package StormBringer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function stormbringer_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



	// Favicon *******************
	$wp_customize->add_section( 'favicon', array(
		'title'    => __( 'Favicon', 'stormbringer' ),
		'priority' => 10,
	) );

	// Theme Color
	$wp_customize->add_setting(
		'favicon_theme_color',
		array(
			'default'		=> '#333',
			'transport'		=> 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
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

	// Mask Color
	$wp_customize->add_setting(
		'favicon_mask_color',
		array(
			'default'		=> '#333',
			'transport'		=> 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
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

	// Tile Color
	$wp_customize->add_setting(
		'favicon_tile_color',
		array(
			'default'		=> '#333',
			'transport'		=> 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
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

	// Favicons folder
	$wp_customize->add_setting('favicon_folder', ['default' => 'root']);
	$wp_customize->add_control('favicon_folder', array(
		'label'      => __('Folder', 'stormbringer'),
		'section'    => 'favicon',
		'description'    => __('Use http://realfavicongenerator.net to generate the favicons', 'stormbringer'),
		'settings'   => 'favicon_folder',
		'type'       => 'radio',
		'choices'    => array(
			'root' => __('Relative to the root folder /', 'stormbringer'),
			'theme' => __('Relative to the theme folder', 'stormbringer').': ' .  get_stylesheet_directory_uri(  ) . '/img/favicon/',
		),
	));


	// Libraries ****************************
	$wp_customize->add_section( 'libraries', array(
		'title'    => __( 'External Libraries', 'stormbringer' ),
		'priority' => 10,
	) );

	// library
	if(current_theme_supports('libraries')) :
		$libraries = get_theme_support('libraries')[0];

		foreach($libraries as $librarie_name => $librarie_key) :
			$wp_customize->add_setting(
				'libraries_'.$librarie_name.'',
				array(
					'default'		=> '1',
					'transport'		=> 'refresh',
					'sanitize_callback' => 'absint'
				)
			);
			$wp_customize->add_control(
				'libraries_'.$librarie_name.'',
				array(
					'section'		=> 'libraries',
					'default'		=> '1',
					'label'			=> $librarie_name,
					'type'			=> 'checkbox',
					'std' => '1'
				)
			);
		endforeach;
	endif;

	// Title Tagline ****************************

	$wp_customize->remove_setting('site_icon');

	// Lang
	$wp_customize->add_setting(
		'lang',
		array(
			'default'		=> '',
			'transport'		=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'lang',
		array(
			'section'		=> 'title_tagline',
			'label'			=> __( 'Site Language', 'stormbringer' ),
			'type'			=> 'text'
		)
	);


	// Misc ****************************
	$wp_customize->add_section( 'misc', array(
		'title'    => __( 'Misc.', 'stormbringer' ),
		'priority' => 10,
	) );

	// Excerpt Length
	$wp_customize->add_setting(
		'excerpt_length',
		array(
			'default'		=> '50',
			'transport'		=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'excerpt_length',
		array(
			'section'		=> 'misc',
			'label'			=> __( 'Excerpt Length', 'stormbringer' ),
			'type'			=> 'text'
		)
	);

	// Google Fonts
	$wp_customize->add_setting(
		'google_fonts',
		array(
			'default'		=> '',
			'transport'		=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'google_fonts',
		array(
			'section'		=> 'misc',
			'description' => 'Example: [\'Montserrat:400\',\'Dancing Script:400\']',
			'label'			=> __( 'Google Fonts', 'stormbringer' ),
			'type'			=> 'text'
		)
	);

	// Typekit
	$wp_customize->add_setting(
		'typekit_id',
		array(
			'default'		=> '',
			'transport'		=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'typekit_id',
		array(
			'section'		=> 'misc',
			'label'			=> __( 'Typekit ID', 'stormbringer' ),
			'type'			=> 'text'
		)
	);

	// Addthis
	$wp_customize->add_setting(
		'addthis_id',
		array(
			'default'		=> '',
			'transport'		=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'addthis_id',
		array(
			'section'		=> 'misc',
			'label'			=> __( 'Addthis ID', 'stormbringer' ),
			'type'			=> 'text'
		)
	);

    // category bottom description
    $wp_customize->add_setting(
        'cuztom',
        array(
            'default'		=> 0,
            'transport'		=> 'postMessage',
            'sanitize_callback' => 'absint'
        )
    );
    $wp_customize->add_control(
        'cuztom',
        array(
            'section'		=> 'misc',
            'label'			=> __( 'Load Cuztom library', 'stormbringer' ),
            'type'			=> 'checkbox',
        )
    );



	// Bootstrap ****************************
	$wp_customize->add_section( 'bootstrap', array(
		'title'    => __( 'Bootstrap', 'stormbringer' ),
		'priority' => 0,
	) );

	// Preprocessor
	$wp_customize->add_setting('bootstrap_preprocessor', [
		'default' => 'scss',
		'transport'		=> 'postMessage',
		'sanitize_callback' => 'absint'
		]
	);
	$wp_customize->add_control('bootstrap_preprocessor', array(
		'label'      => __('Preprocessor', 'stormbringer'),
		'section'    => 'bootstrap',
		'settings'   => 'bootstrap_preprocessor',
		'type'       => 'radio',
		'choices'    => array(
			'scss' => __('Scss', 'stormbringer'),
			'less' => __('Less', 'stormbringer'),
		),
	));

}
add_action( 'customize_register', 'stormbringer_customize_register' );