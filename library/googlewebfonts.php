<?php

function google_webfonts() {
  if(defined("GOOGLE_WEBFONTS")) :
    echo "\n". '<!-- google webfonts -->' . "\n";
    echo '<script type="text/javascript">' . "\n";
    echo "WebFontConfig = {google:{families:['".implode("','", unserialize(GOOGLE_WEBFONTS))."']}};" . "\n";
    echo '(function(d, t) {' . "\n";
    echo 'var wf = d.createElement(t),s = d.getElementsByTagName(t)[0];' . "\n";
    echo "wf.src = '//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';" . "\n";
    echo 's.parentNode.insertBefore(wf, s);' . "\n";
    echo "})(document, 'script')" . "\n";
    echo '</script>' . "\n";
  endif;
}

add_action('wp_head', 'google_webfonts',30);