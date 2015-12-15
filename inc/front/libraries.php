<?php

function stormbringer_js_footer() {

	if(current_theme_supports('libraries')) {
		$libraries = get_theme_support('libraries')[0];

		if ( !is_admin() ) {
			wp_deregister_script( 'jquery' );
			if($libraries['jquery']){
				wp_enqueue_script( 'jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/'.$libraries['jquery'].'/jquery.min.js', array(), null, true );
			}
		}

		if($libraries['modernizr']){
			wp_enqueue_script( 'modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/' . $libraries['modernizr'] . '/modernizr.min.js', array(), null, true );
		}

		if($libraries['bootstrap']){
			wp_enqueue_script( 'bootstrap', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/'.$libraries['bootstrap'].'/js/bootstrap.min.js', array(), null, true );
		}

		// Optionnal libraries
		if($libraries['jquery-cycle']){
			wp_enqueue_script('jquery-cycle','//cdnjs.cloudflare.com/ajax/libs/jquery.cycle/'.$libraries['jquery-cycle'].'/jquery.cycle.all.min.js', array('jquery'), null, true);
		}

		if($libraries['jquery-easing']){
			wp_enqueue_script('jquery-easing','//cdnjs.cloudflare.com/ajax/libs/jquery-easing/'.$libraries['jquery-easing'].'/jquery.easing.min.js', array('jquery'), null, true);
		}

		if($libraries['jquery-mousewheel']){
			wp_enqueue_script('jquery-mousewheel','//cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/'.$libraries['jquery-mousewheel'].'/jquery.mousewheel.min.js', array('jquery'), null, true);
		}

		if($libraries['jquery-validate']){
			wp_enqueue_script('jquery-validate','//cdnjs.cloudflare.com/ajax/libs/jquery-validate/'.$libraries['jquery-validate'].'/jquery.validate.min.js', array('jquery'), null, true);
		}

		if($libraries['jquery-cookie']){
			wp_enqueue_script('jquery-cookie','//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/'.$libraries['jquery-cookie'].'/jquery.cookie.min.js', array('jquery'), null, true);
		}

		if($libraries['bootstrap-select']){
			wp_enqueue_script( 'bootstrap-select', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/'.$libraries['bootstrap-select'].'/js/bootstrap-select.min.js', array( 'bootstrap' ), null, true );
		}

		$addthis_id = get_theme_mod('addthis_id');
		if ($addthis_id ) {
			wp_enqueue_script( 'addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=' . $addthis_id , array(), null, true );
		}

	}


	wp_enqueue_script( 'bootstrap-modalgallery', get_template_directory_uri() . '/js/bootstrap-modalgallery.js', array('bootstrap','jquery'), null, true );
	wp_enqueue_script( 'bootstrap-modalopen', get_template_directory_uri() . '/js/bootstrap-modalopen.js', array('bootstrap','jquery'), null, true );
	wp_enqueue_script( 'stormbringer-common', get_template_directory_uri() . '/js/common.js', array( 'jquery' ), null, true );

	// Preprocessor
	$preprocessor = 'scss';
	$preprocessor = get_theme_mod('bootstrap_preprocessor');

	if ( $preprocessor == 'less' ) {
		wp_enqueue_script( 'application.js', get_stylesheet_directory_uri() . '/js/application.js', array( 'jquery' ), null, true );
	}
	if ( $preprocessor == 'scss' ) {

		$grunt_assets = get_theme_mod('grunt_assets');

		if ( current_user_can( 'administrator' ) || $_GET['scsscompile'] == '1' ) {
			$jsfile = 'js/production.js';
		}
		else{
			$jsfile = 'js/production.min.js';
			if(isset($grunt_assets[$jsfile])) {
				$jsfile = $grunt_assets[$jsfile];
			}
		}

		wp_enqueue_script( 'theme', get_stylesheet_directory_uri() . '/'.$jsfile, array( 'jquery' ), null, true );
	}






}
add_action( 'wp_enqueue_scripts', 'stormbringer_js_footer', 300 );

// Add IE8 conditional JS
function stormbringer_ie8_js_header() {

	if(current_theme_supports('libraries')) {
		$libraries = get_theme_support('libraries')[0];
		echo '<!--[if lt IE 9]>'."\n";
		if($libraries['html5shiv']) {
			echo '<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/' . $libraries['html5shiv'] . '/html5shiv.min.js"></script>'."\n";
		}
		if($libraries['respond']){
			echo '<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/'.$libraries['respond'].'/respond.js"></script>'."\n";
		}
		if($libraries['selectivizr']){
			echo '<script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/'.$libraries['selectivizr'].'/selectivizr-min.js"></script>'."\n";
		}
		echo '<![endif]-->'."\n";
	}

}
add_action( 'wp_head', 'stormbringer_ie8_js_header' );


function stormbringer_css() {

	if(current_theme_supports('libraries')) {
		$libraries = get_theme_support('libraries')[0];

		if($libraries['bootstrap-select']){
			wp_register_style( 'bootstrap-select', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/'.$libraries['bootstrap-select'].'/css/bootstrap-select.min.css', array(), null, 'screen,projection' );
			wp_enqueue_style( 'bootstrap-select' );
		}
	}

}
add_action( 'wp_enqueue_scripts', 'stormbringer_css', 100 );

