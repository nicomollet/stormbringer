<?php
// Custom password protected post
add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<p>This post is password protected. To view it please enter your password below:</p> <form class="form-stacked protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post"><fieldset>	<div class="clearfix"><label for="' . $label . '">' . __( "Password:" ) . ' </label><div class="input"><input name="post_password" id="' . $label . '" type="password" size="30"/><input class="btn small" type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" /></div><!-- /clearfix -->
	</fieldset></form>
	';
	return $o;
}
