<?php
// Custom password protected post
add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '
	<p>'.__('This content is protected by a password, type the password below:','stormbringer').'</p>
	<form class="form-stacked protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post">
    <fieldset>
    <div class="clearfix">
    <label for="' . $label . '">' . __( 'Password:','stormbringer' ) . '</label>
    <div class="input">
    <input class="form-control" placeholder="' . __( 'Password:','stormbringer' ) . '" name="post_password" id="' . $label . '" type="password" size="30"/>
    <input class="btn btn-primary" type="submit" name="Submit" value="' . esc_attr__( 'Send','stormbringer' ) . '" />
    </div>
    <!-- /clearfix -->
    </fieldset>
	</form>
	';
	return $o;
}
