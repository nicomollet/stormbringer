<?php
function stormbringer_addthis_js_footer() {
    echo "\n". '<!-- addthis js -->' . "\n";
    echo '<script type="text/javascript"> var addthis_config = {"data_track_clickback":false,"data_track_addressbar":false,"ui_language":"fr","ui_508_compliant":true};if (typeof(addthis_share) == "undefined"){ addthis_share = {"templates":{"twitter":"{{title}} {{url}}"}};}</script>' . "\n";
    echo '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js'.(defined('ADDTHIS_PROFILE')?'#pubid='.ADDTHIS_PROFILE:'').'"></script>' . "\n";
}
add_action('wp_footer', 'stormbringer_addthis_js_footer',30);
?>