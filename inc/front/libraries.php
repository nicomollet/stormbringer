<?php

function stormbringer_js_header() {
	if ( !is_admin() ) {
		wp_deregister_script( 'jquery' );
		if (defined( 'JQUERY' ) && JQUERY != '' ) {
			wp_enqueue_script( 'jquery', 'http://cdnjs.cloudflare.com/ajax/libs/jquery/'.JQUERY.'/jquery.min.js', array(), null, false );
		}
		if (defined( 'MODERNIZR' ) && MODERNIZR != '' ) {
			wp_enqueue_script( 'modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/' . MODERNIZR . '/modernizr.min.js', array(), null, false );
		}
	}
}
add_action('wp_enqueue_scripts', 'stormbringer_js_header', 50);

function stormbringer_js_footer() {

	if (defined( 'BOOTSTRAP' ) && BOOTSTRAP != '' ) {
		wp_enqueue_script( 'bootstrap', 'http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/'.BOOTSTRAP.'/js/bootstrap.min.js', array(), null, true );
	}

	// Optionnal libraries
	if (defined( 'JQUERY_CYCLE' ) && JQUERY_CYCLE != '' ) {
		wp_enqueue_script('jquery-cycle','http://cdnjs.cloudflare.com/ajax/libs/jquery.cycle/'.JQUERY_CYCLE.'/jquery.cycle.all.min.js', array('jquery'), null, true);
	}

	if (defined( 'JQUERY_EASING' ) && JQUERY_EASING != '' ) {
		wp_enqueue_script('jquery-easing','http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/'.JQUERY_EASING.'/jquery.easing.min.js', array('jquery'), null, true);
	}

	if (defined( 'JQUERY_MOUSEWHEEL' ) && JQUERY_MOUSEWHEEL != '' ) {
		wp_enqueue_script('jquery-mousewheel','http://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/'.JQUERY_MOUSEWHEEL.'/jquery.mousewheel.min.js', array('jquery'), null, true);
	}

	if (defined( 'JQUERY_VALIDATE' ) && JQUERY_VALIDATE != '' ) {
		wp_enqueue_script('jquery-validate','http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js', array('jquery'), null, true);
	}

	if (defined( 'JQUERY_COOKIE' ) && JQUERY_COOKIE != '' ) {
		wp_enqueue_script('jquery-cookie','http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/'.JQUERY_COOKIE.'/jquery.cookie.min.js', array('jquery'), null, true);
	}

	if (defined( 'BOOTSTRAP_SELECT' ) && BOOTSTRAP_SELECT != '' ) {
		wp_enqueue_script( 'bootstrap-select', 'http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/'.BOOTSTRAP_SELECT.'/js/bootstrap-select.min.js', array( 'bootstrap' ), null, true );
	}

	if ( defined( 'ADDTHIS' ) && ADDTHIS != '' ) {
		wp_enqueue_script( 'addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=' . ADDTHIS , array(), null, true );
	}

	// Preprocessor
	if ( PREPROCESSOR == 'less' ) {
		if ( LIGHTBOX === 'fancybox' ) {
			wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox-1.3.4_patch.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'fancybox-open', get_template_directory_uri() . '/js/fancybox/fancybox-open.js', array( 'jquery' ), null, true );
		}
		if ( LIGHTBOX === 'tbmodal' ) {
			wp_enqueue_script( 'bootstrap-modalgallery', get_template_directory_uri() . '/js/bootstrap-modalgallery.js', array(
					'bootstrap',
					'jquery'
				), null, true );
			wp_enqueue_script( 'bootstrap-modalopen', get_template_directory_uri() . '/js/bootstrap-modalopen.js', array(
					'bootstrap',
					'jquery'
				), null, true );
		}
		wp_enqueue_script( 'common.js', get_template_directory_uri() . '/js/common.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'app.js', get_template_directory_uri() . '/js/app.js', array( 'jquery' ), null, true );
	}

	if ( PREPROCESSOR == 'scss' ) {
		wp_enqueue_script( 'production.min.js', get_template_directory_uri() . '/js/production.min.js', array( 'jquery' ), null, true );
	}

}

add_action( 'wp_enqueue_scripts', 'stormbringer_js_footer', 300 );

// Add IE8 conditional JS
function stormbringer_ie8_js_header() {
	echo '<!--[if lt IE 9]>';
	if ( defined( 'RESPOND' ) && RESPOND != '' ) {
		echo '<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/'.RESPOND.'/respond.js"></script>';
	}
	if ( defined( 'SELECTIVIZR' ) && SELECTIVIZR != '' ) {
		echo '<script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/'.SELECTIVIZR.'/selectivizr-min.js"></script>';
	}
	echo '<![endif]-->';
}

add_action( 'wp_head', 'stormbringer_ie8_js_header' );


function stormbringer_css() {

	if (defined( 'BOOTSTRAP_SELECT' ) && BOOTSTRAP_SELECT != '' ) {
		wp_register_style( 'bootstrap-select', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/'.BOOTSTRAP_SELECT.'/css/bootstrap-select.min.css', array(), null, 'screen,projection' );
		wp_enqueue_style( 'bootstrap-select' );
	}

	if ( LIGHTBOX == 'fancybox' ) {
		wp_register_style( 'fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css', array(), null, 'screen,projection' );
		wp_enqueue_style( 'fancybox' );
	}
}

add_action( 'wp_enqueue_scripts', 'stormbringer_css', 100 );