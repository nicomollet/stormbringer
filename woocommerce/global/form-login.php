<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>

<form class="woocomerce-form woocommerce-form-login form form-horizontal login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>
	<div class="panel panel-primary">
		<div class="panel-body">
			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; ?>

			<div class="form-group">
				<label for="username" class="control-label"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
				<div class="form-input">
				<input type="text" class="form-control" name="username" id="username" autocomplete="username" />

				</div>
			</div>
			<div class="form-group">
				<label for="password" class="control-label"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<div class="form-input">
					<input class="form-control" type="password" name="password" id="password" autocomplete="current-password" />
				</div>
			</div>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<div class="form-group">
				<div class="form-actions">
					<?php wp_nonce_field( 'woocommerce-login' ); ?>
					<button type="submit" class="btn btn-primary woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
					<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
						<span><?php _e( 'Remember me', 'woocommerce' ); ?></span>
					</label>
				</div>
			</div>

			<div class="form-group">
				<div class="form-actions">
					<p class="lost_password">
						<a class="btn-link" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
					</p>
				</div>
			</div>

			<?php do_action( 'woocommerce_login_form_end' ); ?>
		</div>
	</div>

</form>

