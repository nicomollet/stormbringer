<?php

/**
 * Load Webfont launcher
 */
function stormbringer_webfonts() {

$google_fonts = get_theme_mod( 'google_fonts' );
$typekit_id = get_theme_mod('typekit_id');

$script = '';
if ( $google_fonts || $typekit_id ) :
if($google_fonts)$google_fonts= 'google:{families:'.$google_fonts.'},';
if($typekit_id)$typekit_id= 'typekit:{id:\''.$typekit_id.'\'},';
$script = <<<EOS
<script>
WebFontConfig = {
  {$google_fonts}{$typekit_id}
  timeout: 2000,
  active: function() {
    sessionStorage.fonts = true;
    window.setTimeout (
    function(){
      document.documentElement.className += ' wf-active-real';
    }
    ,500);
    },
};
(function(d, t) {
var wf = d.createElement(t),s = d.getElementsByTagName(t)[0];
wf.src = '//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
wf.async = true;
s.parentNode.insertBefore(wf, s);
})( document, 'script')
</script>
EOS;
endif;
echo $script;
}
add_action( 'wp_footer', 'stormbringer_webfonts', 20 );

/**
 * Webfont loader fallback
 */
function stormbringer_webfonts_nojs(){
$script = <<<EOS
<script>
(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)
</script>
EOS;
echo $script;
}
add_action( 'wp_head', 'stormbringer_webfonts_nojs', 0 );