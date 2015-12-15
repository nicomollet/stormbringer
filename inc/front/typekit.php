<?php

function stormbringer_typekit() {

	$typekit_id = get_theme_mod('typekit_id');

	if ( $typekit_id ) :
		echo "\n" . '<!-- Typekit -->' . "\n";
        echo '<script type="text/javascript" src="//use.typekit.net/'.$typekit_id.'.js"></script>' . "\n";
        echo '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>' . "\n";
	endif;
}

add_action( 'wp_head', 'stormbringer_typekit', 30 );