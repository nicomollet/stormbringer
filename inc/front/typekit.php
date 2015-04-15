<?php

function stormbringer_google_typekit() {

	if ( current_theme_supports('typekit') && get_theme_support('typekit')[0] != '' ) :
		echo "\n" . '<!-- Typekit -->' . "\n";
        echo '<script type="text/javascript" src="//use.typekit.net/'.get_theme_support('typekit')[0].'.js"></script>' . "\n";
        echo '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>' . "\n";
	endif;
}

add_action( 'wp_head', 'stormbringer_google_typekit', 30 );