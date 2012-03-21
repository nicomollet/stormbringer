<?php
function favicon() {
  echo "\n". '<!-- favicon -->' . "\n";
  echo '<link rel="icon" href="/favicon.ico" type="image/x-icon"/>' . "\n";
  echo '<link rel="Shortcut Icon" href="/favicon.ico" type="image/x-icon"/>' . "\n";
  echo '<link rel="apple-touch-icon" href="/apple-touch-icon.png"/>' . "\n";
  echo '<link rel="apple-touch-icon-precomposed" href="/apple-touch-icon.png"/>  ' . "\n";
}
add_action('wp_head', 'favicon',100);