<?php
$gruntAssets = [
<% _.forEach(files, function(file) { %>
"<%= file.originalPath %>" => "<%= file.versionedPath %>",
<% }); %>
];
set_theme_mod( 'grunt_assets', $gruntAssets );
