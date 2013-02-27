<?php
function stormbringer_wp_head_analytics() {
if(defined('GOOGLE_ANALYTICS') && GOOGLE_ANALYTICS!='') :
  echo "\n". '<!-- Google Analytics Tracking -->' . "\n";
  echo '<script type="text/javascript">' . "\n";
  echo 'var analyticsFileTypes = [""];' . "\n";
  echo 'var analyticsEventTracking = "enabled";' . "\n";
  echo '</script>' . "\n";
  echo '<script type="text/javascript">' . "\n";
  echo 'var _gaq = _gaq || [];' . "\n";
  echo '_gaq.push(["_setAccount", "'.GOOGLE_ANALYTICS.'"]);' . "\n";
  echo '_gaq.push(["_trackPageview"]);' . "\n";
  echo '_gaq.push(["_trackPageLoadTime"]);' . "\n";
  echo '(function() {' . "\n";
  echo 'var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;' . "\n";
  echo 'ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";' . "\n";
  echo 'var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);' . "\n";
  echo '})();' . "\n";
  echo '</script>' . "\n";
endif;
}
add_action('wp_head', 'stormbringer_wp_head_analytics',1);