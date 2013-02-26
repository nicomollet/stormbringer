<?php
// Custom password protected post
add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<p>'.__('Cet article est protégé par un mot de passe, saisissez le mot de passe ci-dessous :','stormbringer').'</p> <form class="form-stacked protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post"><fieldset>	<div class="clearfix"><label for="' . $label . '">' . __( 'Mot de passe :','stormbringer' ) . ' </label><div class="input"><input name="post_password" id="' . $label . '" type="password" size="30"/><input class="btn btn-primary" type="submit" name="Submit" value="' . esc_attr__( 'Valider','stormbringer' ) . '" /></div><!-- /clearfix -->
	</fieldset></form>
	';
	return $o;
}
