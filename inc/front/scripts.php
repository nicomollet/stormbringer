<?php


function stormbringer_js_theme() {

	//wp_enqueue_script( 'stormbringer-common', get_template_directory_uri() . '/js/src/common.js', array( 'jquery' ), null, true );

	// Preprocessor
	$preprocessor = get_theme_mod('bootstrap_preprocessor', true);

	if ( $preprocessor === 'less' ) {
		wp_enqueue_script( 'scripts.js', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ), null, true );
	}

	if ( $preprocessor === 'scss' || $preprocessor == 1) {

		$grunt_assets = get_theme_mod('grunt_assets');

		if ( current_user_can( 'administrator' ) || $_GET['scsscompile'] == '1' ) {
			$jsfile = 'js/scripts.js';
		}
		else{
			$jsfile = 'js/scripts.min.js';
			if(isset($grunt_assets[$jsfile])) {
				$jsfile = $grunt_assets[$jsfile];
			}
		}

		wp_enqueue_script( 'theme', get_stylesheet_directory_uri() . '/'.$jsfile, array( 'jquery' ), null, true );
	}

}
add_action( 'wp_enqueue_scripts', 'stormbringer_js_theme', 300 );




function stormbringer_js_libraries_footer() {

	if(current_theme_supports('libraries')) {

		$lang = get_theme_mod( 'lang');
		$libraries = get_theme_support('libraries')[0];

		if ( !is_admin() ) {
			wp_deregister_script( 'jquery' );
			if ( @$libraries['jquery'] && get_theme_mod( 'libraries_jquery', true ) ) {
				wp_enqueue_script( 'jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/'.$libraries['jquery'].'/jquery.min.js', array(), null, true );
			}
		}

		/*if ( @$libraries['modernizr'] && get_theme_mod( 'libraries_modernizr', true ) ) {
			wp_enqueue_script( 'modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/' . $libraries['modernizr'] . '/modernizr.min.js', array(), null, true );
		}*/

		if(@$libraries['bootstrap'] && get_theme_mod('libraries_bootstrap', true)){
			wp_enqueue_script( 'bootstrap', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/'.$libraries['bootstrap'].'/js/bootstrap.min.js', array(), null, true );
		}

		// Optionnal libraries
		if(@$libraries['jquery-cycle'] && get_theme_mod('libraries_jquery-cycle', true)){
			wp_enqueue_script('jquery-cycle','//cdnjs.cloudflare.com/ajax/libs/jquery.cycle/'.$libraries['jquery-cycle'].'/jquery.cycle.all.min.js', array('jquery'), null, true);
		}

		if(@$libraries['jquery-easing'] && get_theme_mod('libraries_jquery-easing', true)){
			wp_enqueue_script('jquery-easing','//cdnjs.cloudflare.com/ajax/libs/jquery-easing/'.$libraries['jquery-easing'].'/jquery.easing.min.js', array('jquery'), null, true);
		}

		if(@$libraries['jquery-mousewheel'] && get_theme_mod('libraries_jquery-mousewheel', true) ){
			wp_enqueue_script('jquery-mousewheel','//cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/'.$libraries['jquery-mousewheel'].'/jquery.mousewheel.min.js', array('jquery'), null, true);
		}

		if ( @$libraries['jquery-validate'] && get_theme_mod( 'libraries_jquery-validate' , true) ) {
			wp_enqueue_script('jquery-validate','//cdnjs.cloudflare.com/ajax/libs/jquery-validate/'.$libraries['jquery-validate'].'/jquery.validate.min.js', array('jquery'), null, true);
		}

		if ( @$libraries['jquery-cookie'] && get_theme_mod( 'libraries_jquery-cookie', true ) ) {
			wp_enqueue_script('jquery-cookie','//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/'.$libraries['jquery-cookie'].'/jquery.cookie.min.js', array('jquery'), null, true);
		}

		if ( @$libraries['jquery-lazyload'] && get_theme_mod( 'libraries_jquery-lazyload', true ) ) {
			wp_enqueue_script('jquery-lazyload','//cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/'.$libraries['jquery-lazyload'].'/jquery.lazyload.min.js', array('jquery'), null, true);
		}

		if ( @$libraries['jquery-waypoints'] && get_theme_mod( 'libraries_jquery-waypoints', true ) ) {
			wp_enqueue_script('jquery-waypoints','//cdnjs.cloudflare.com/ajax/libs/waypoints/'.$libraries['jquery-waypoints'].'/jquery.waypoints.min.js', array('jquery'), null, true);
		}

		if ( @$libraries['jquery-touchswipe'] && get_theme_mod( 'libraries_jquery-touchswipe', true ) ) {
			wp_enqueue_script('jquery-touchswipe','//cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/'.$libraries['jquery-touchswipe'].'/jquery.touchSwipe.min.js', array('jquery'), null, true);
		}

		if ( @$libraries['jquery-owlcarousel'] && get_theme_mod( 'libraries_jquery-owlcarousel', true ) ) {
			wp_enqueue_script( 'jquery-owlcarousel', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/' . $libraries['jquery-owlcarousel'] . '/owl.carousel.min.js', array( 'jquery' ), null, true );
		}

		if(@$libraries['bootstrap-select'] && get_theme_mod('libraries_bootstrap-select', true)){
			wp_enqueue_script( 'bootstrap-select', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/'.$libraries['bootstrap-select'].'/js/bootstrap-select.min.js', array( 'bootstrap' ), null, true );
		}

		if(@$libraries['bootstrap-datepicker'] && get_theme_mod('libraries_bootstrap-datepicker', true) ){

			wp_enqueue_script( 'bootstrap-datepicker', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/'.$libraries['bootstrap-datepicker'].'/js/bootstrap-datepicker.min.js', array( 'bootstrap' ), null, true );
			if($lang != '') {
				wp_enqueue_script( 'bootstrap-datepicker-'.$lang, '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/'.$libraries['bootstrap-datepicker'].'/locales/bootstrap-datepicker.'.$lang.'.min.js', array( 'bootstrap','bootstrap-datepicker' ), null, true );
			}
		}

	}
}
add_action( 'wp_enqueue_scripts', 'stormbringer_js_libraries_footer', 200 );



// Add IE8 conditional JS
function stormbringer_ie8_js_header() {

	if(current_theme_supports('libraries')) {
		$libraries = get_theme_support('libraries')[0];
		echo '<!--[if lt IE 9]>'."\n";
		if(@$libraries['html5shiv'] && get_theme_mod('libraries_html5shiv', true) ) {
			echo '<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/' . $libraries['html5shiv'] . '/html5shiv.min.js"></script>'."\n";
		}
		if(@$libraries['respond'] && get_theme_mod('libraries_respond', true)){
			echo '<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/'.$libraries['respond'].'/respond.js"></script>'."\n";
		}
		if(@$libraries['selectivizr'] && get_theme_mod('libraries_selectivizr', true)){
			echo '<script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/'.$libraries['selectivizr'].'/selectivizr-min.js"></script>'."\n";
		}
		echo '<![endif]-->'."\n";
	}

}
add_action( 'wp_head', 'stormbringer_ie8_js_header' );



function stormbringer_footer() {

	echo '<div class="modal fade do-not-print" id="modal-default" tabindex="-1" aria-hidden="true" role="dialog">' . "\n";
	echo '<div class="modal-dialog">' . "\n";
	echo '<div class="modal-content">' . "\n";
	echo '<div class="modal-header">' . "\n";
	echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' . "\n";
	echo '<h4 class="modal-title"></h4>' . "\n";
	echo '</div>' . "\n";
	echo '<div class="modal-body in-frame">' . "\n";
	echo '<iframe id="modal-frame" name="modal-frame" src="" sandbox="allow-same-origin allow-forms allow-popups"></iframe>' . "\n";
	echo '</div>' . "\n";
	echo '</div>' . "\n";
	echo '</div>' . "\n";
	echo '</div>' . "\n";

	echo '<script type="text/javascript">' . "\n";
	$stormbringer_config = [
		'AJAXURL'              => admin_url( 'admin-ajax.php' ),
		'THEME_LANG'           => get_theme_mod( 'lang' ),
		'STYLESHEET_DIRECTORY' => get_bloginfo( 'stylesheet_directory' ),
		'WPURL'                => get_bloginfo( 'wpurl' ),
		'URL'                  => get_bloginfo( 'url' ),
		'LANGUAGE'             => get_bloginfo( 'language' ),
		'STYLESHEET_URL'       => get_bloginfo( 'stylesheet_url' ),
		'TEMPLATE_URL'         => get_bloginfo( 'template_url' ),
		'ENV'                  => current_user_can( 'administrator' ) ? 'development' : 'production',
	];
	echo 'var stormbringer_config = ' . json_encode( $stormbringer_config, JSON_PRETTY_PRINT ) . ";\n";
	echo '</script>' . "\n";
}
add_action( 'wp_footer', 'stormbringer_footer', -100 );

function stormbringer_inframe() {
	echo '<script type="text/javascript">' . "\n";
	echo 'if(self !== top){' . "\n";
	echo 'document.documentElement.className ="in-frame";' . "\n";
	echo '}' . "\n";
	echo '</script>' . "\n";
}
add_action( 'wp_head', 'stormbringer_inframe', 100 );
