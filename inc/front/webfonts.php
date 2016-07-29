<?php

function stormbringer_webfonts() {

$google_fonts = get_theme_mod( 'google_fonts' );
$typekit_id = get_theme_mod('typekit_id');

$script = '';
if ( $google_fonts || $typekit_id ) :
if($google_fonts)$google_fonts= 'google:{families:'.$google_fonts.'},';
if($typekit_id)$typekit_id= 'typekit:{id:\''.$typekit_id.'\'},';
$script = <<<EOS
<script>
WebFontConfig = {{$google_fonts}{$typekit_id}};
(function(d, t) {
var wf = d.createElement(t),s = d.getElementsByTagName(t)[0];
wf.src = '//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
s.parentNode.insertBefore(wf, s);
})( document, 'script')
</script>
EOS;
endif;
echo $script;
}

add_action( 'wp_footer', 'stormbringer_webfonts', 30 );