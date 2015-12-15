<?php
$gruntAssets = [
<% _.forEach(files, function(file) { %>
"<%= file.originalPath %>" => "<%= file.versionedPath %>",
<% }); %>
];
add_theme_support( 'gruntassets', $gruntAssets );
set_theme_mod( 'grunt_assets', $gruntAssets );
