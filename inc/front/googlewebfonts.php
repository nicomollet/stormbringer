<?php

function stormbringer_google_webfonts() {

	$google_fonts = get_theme_mod( 'google_fonts' );

	if ( $google_fonts != '' ) :
		echo "\n" . '<!-- Google Webfonts -->' . "\n";
		echo '<script type="text/javascript">' . "\n";
		echo "WebFontConfig = {google:{families:" . $google_fonts . "}};" . "\n";
		echo '(function(d, t) {' . "\n";
		echo 'var wf = d.createElement(t),s = d.getElementsByTagName(t)[0];' . "\n";
		echo "wf . src = '//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';" . "\n";
		echo 's.parentNode.insertBefore(wf, s);' . "\n";
		echo "})( document, 'script')" . "\n";
		echo '</script>' . "\n";
	endif;
}

add_action( 'wp_head', 'stormbringer_google_webfonts', 30 );