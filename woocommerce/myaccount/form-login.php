<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1">

		<?php endif; ?>


		<div class="panel panel-primary">
			<div class="panel-heading">
				<span><?php esc_html_e( 'Login', 'woocommerce' ); ?></span>
			</div>
			<div class="panel-body">
				<form class="woocommerce-form woocommerce-form-login login form form-horizontal" method="post">

					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<div class="form-group">

						<label for="username" class="control-label"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
						<div class="form-input">
							<input type="text" class="woocommerce-Input woocommerce-Input--text form-control" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
						</div>

					</div>

					<div class="form-group">
						<label for="password" class="control-label"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
						<div class="form-input">
							<input class="woocommerce-Input woocommerce-Input--text form-control" type="password" name="password" id="password" autocomplete="current-password" />
						</div>
					</div>

					<?php do_action( 'woocommerce_login_form' ); ?>

					<div class="form-group">
						<div class="form-actions">
							<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
								<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
							</label>
						</div>
					</div>

					<div class="form-group">
						<div class="form-actions">
							<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
							<input type="submit" class="woocommerce-Button btn btn-primary" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />

						</div>
					</div>

					<div class="form-group">
						<div class="woocommerce-LostPassword lost_password form-actions">
							<a class="btn-link" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
						</div>
					</div>

					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>

				<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
			</div>

		</div>


	</div>

	<div class="u-column2 col-2">

		<div class="panel panel-primary">
			<div class="panel-heading">
				<span><?php esc_html_e( 'Register', 'woocommerce' ); ?></span>
			</div>
			<div class="panel-body">
				<form method="post" class="woocommerce-form woocommerce-form-register register form form-horizontal">

					<?php do_action( 'woocommerce_register_form_start' ); ?>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

						<div class="form-group">
							<label for="reg_username" class="control-label"><?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
							<div class="form-input">
								<input type="text" class="woocommerce-Input woocommerce-Input--text form-control" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
							</div>
						</div>


					<?php endif; ?>

					<div class="form-group">
						<label for="reg_email" class="control-label"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
						<div class="form-input">
							<input type="email" class="woocommerce-Input woocommerce-Input--text form-control" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?>" />
						</div>
					</div>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

						<div class="form-group">
							<label for="reg_password" class="control-label"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
							<div class="form-input">
								<input type="password" class="woocommerce-Input woocommerce-Input--text form-control" name="password" id="reg_password" autocomplete="new-password" />
							</div>
						</div>

					<?php endif; ?>

					<?php do_action( 'woocommerce_register_form' ); ?>

					<div class="form-actions">
						<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
						<input type="submit" class="woocommerce-Button btn btn-primary" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
					</div>

					<?php do_action( 'woocommerce_register_form_end' ); ?>

				</form>
			</div>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
