<?php

function stormbringer_addthis() {

	$addthis_id = get_theme_mod('addthis_id');
	if ($addthis_id ) {
		wp_enqueue_script( 'addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=' . $addthis_id , array(), null, true );
	}
}

add_action( 'wp_enqueue_scripts', 'stormbringer_addthis', 30 );