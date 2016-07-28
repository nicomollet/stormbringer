<?php


function stormbringer_preprocessor() {

	$preprocessor = get_theme_mod('bootstrap_preprocessor', true);

	$cssfile = 'css/styles.css';

	if ( $preprocessor === 'less' ) {
		if ( ! is_admin() ) {
			if ( current_user_can( 'administrator' ) && $_GET['lesscompile'] != '1' ) {

			}
			else {
				$to_cache              = array( STYLESHEETPATH . '/less/application.less' => '' );
				Less_Cache::$cache_dir = STYLESHEETPATH . '/css/';
				$css_file_name         = Less_Cache::Get( $to_cache );
				wp_register_style( 'theme',  get_stylesheet_directory_uri() . '/'.$cssfile, array(), null, null );
				wp_enqueue_style( 'theme' );
			}

		}
	}

	if ( $preprocessor === 'scss' || $preprocessor == 1) {

		if ( ! is_admin() ) {
			if ( current_user_can( 'administrator' ) || $_GET['scsscompile'] == '1' ) {
				wp_register_style( 'theme', get_stylesheet_directory_uri() . '/css/styles.css', array(), null, null );
				wp_enqueue_style( 'theme' );
			} else {

				$cssfile      = 'css/styles.min.css';
				$grunt_assets = get_theme_mod('grunt_assets');
				//if(isset($grunt_assets[$cssfile])) {
				//	$cssfile = $grunt_assets[$cssfile];
				//}

				wp_register_style( 'theme', get_stylesheet_directory_uri() . '/'.$cssfile, array(), null, null );
				wp_enqueue_style( 'theme' );
			}
		}
	}

}

add_action( 'wp_enqueue_scripts', 'stormbringer_preprocessor');


function stormbringer_livereload(){
	$preprocessor = get_theme_mod('bootstrap_preprocessor', true);

	if ( $preprocessor === 'less' ) {
		if ( ! is_admin() ) {
			// less.js for admin (development only)
			//if ( current_user_can('administrator') && (ENVIRONMENT == "dev" || ENVIRONMENT == "local")) {
			if ( current_user_can( 'administrator' ) && $_GET['lesscompile'] != '1' ) {
				echo '<!-- Less -->' . "\n";
				echo '<link rel="stylesheet/less" href="' . get_template_directory_uri() . '/less/application.less"/>' . "\n";
				echo '<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/' . get_theme_support( 'libraries' )[0]['lessjs'] . '/less.min.js"></script>' . "\n";
				echo "<script type='text/javascript'>less.env = 'development';less.async = true;less.poll = 600;less.watch();</script>" . "\n";
			} // compile with lessphp http://leafo.net/lessphp/ for users


		}
	}

	if ( $preprocessor === 'scss' || $preprocessor == 1) {

		if ( ! is_admin() ) {
			if ( current_user_can( 'administrator' ) || $_GET['scsscompile'] == '1' ) {
				if ( defined( 'LIVERELOAD' ) && LIVERELOAD == true ) {
					$livereloadurl = get_bloginfo( 'url' ) . ':35729';
					if ( defined( 'LIVERELOAD_URL' ) ) {
						$livereloadurl = LIVERELOAD_URL;
					}
					echo '<script src="' . $livereloadurl . '/livereload.js"></script>' . "\n";

				}
			}
		}
	}
}
add_action( 'wp_head', 'stormbringer_livereload' );

function stormbringer_css() {

	if(current_theme_supports('libraries')) {
		$libraries = get_theme_support('libraries')[0];

		if(@$libraries['bootstrap-select'] && get_theme_mod('libraries_bootstrap-select', true)){
			wp_register_style( 'bootstrap-select', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/'.$libraries['bootstrap-select'].'/css/bootstrap-select.min.css', array(), null, 'screen,projection' );
			wp_enqueue_style( 'bootstrap-select' );
		}

		if(@$libraries['bootstrap-datepicker'] && get_theme_mod('libraries_bootstrap-datepicker', true)){
			wp_register_style( 'bootstrap-datepicker', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/'.$libraries['bootstrap-datepicker'].'/css/bootstrap-datepicker.min.css', array(), null, 'screen,projection' );
			wp_enqueue_style( 'bootstrap-datepicker' );
		}

		if(@$libraries['animatecss'] && get_theme_mod('libraries_animatecss', true)){
			wp_register_style( 'animatecss', '//cdnjs.cloudflare.com/ajax/libs/animate.css/'.$libraries['animatecss'].'/animate.min.css', array(), null, 'screen,projection' );
			wp_enqueue_style( 'animatecss' );
		}

		if ( @$libraries['jquery-owlcarousel'] && get_theme_mod( 'libraries_jquery-owlcarousel', true ) ) {
			wp_register_style( 'jquery-owlcarousel', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/' . $libraries['jquery-owlcarousel'] . '/assets/owl.carousel.min.css', array(), null, 'screen,projection' );
			wp_enqueue_style( 'jquery-owlcarousel' );
		}

	}

}
add_action( 'wp_enqueue_scripts', 'stormbringer_css', -100 );
