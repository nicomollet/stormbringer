<?php
/**
 * The template for displaying the Theme my Login "Profile Form".
 *
 * @package StormBringer
 * @since StormBringer 0.0.2
 */
?>
<?php
$user_role = reset( $profileuser->roles );
if ( is_multisite() && empty( $user_role ) ) {
	$user_role = 'subscriber';
}

$user_can_edit = false;
foreach ( array( 'posts', 'pages' ) as $post_cap )
	$user_can_edit |= current_user_can( "edit_$post_cap" );
?>

<?php //$template->the_action_template_message( 'profile' ); ?>
<?php stormbringer_thememylogin_errors($template->get_errors()); ?>

<div class="login profile" id="stormbringer<?php $template->the_instance(); ?>">

	<?php $template->the_errors(); ?>
	<form id="your-profile" action="" method="post">
		<?php wp_nonce_field( 'update-user_' . $current_user->ID ) ?>
		<p>
			<input type="hidden" name="from" value="profile" />
			<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />
		</p>

		<?php if ( !$theme_my_login->options->get_option( array( 'themed_profiles', $user_role, 'restrict_admin' ) ) && !has_action( 'personal_options' ) ): ?>

		<h3><?php _e( 'Personal Options', 'stormbringer' ); ?></h3>

		<table class="form-table">
		<?php if ( rich_edit_exists() && $user_can_edit ) : // don't bother showing the option if the editor has been removed ?>
		<tr>
			<th scope="row"><?php _e( 'Visual Editor', 'stormbringer' )?></th>
			<td><label for="rich_editing"><input name="rich_editing" type="checkbox" id="rich_editing" value="false" <?php checked( 'false', $profileuser->rich_editing ); ?> /> <?php _e( 'Disable the visual editor when writing', 'stormbringer' ); ?></label></td>
		</tr>
		<?php endif; ?>
		<?php if ( count( $_wp_admin_css_colors ) > 1 && has_action( 'admin_color_scheme_picker' ) ) : ?>
		<tr>
			<th scope="row"><?php _e( 'Admin Color Scheme', 'stormbringer' )?></th>
			<td><?php do_action( 'admin_color_scheme_picker' ); ?></td>
		</tr>
		<?php
		endif; // $_wp_admin_css_colors
		if ( $user_can_edit ) : ?>
		<tr>
			<th scope="row"><?php _e( 'Keyboard Shortcuts', 'stormbringer' ); ?></th>
			<td><label for="comment_shortcuts"><input type="checkbox" name="comment_shortcuts" id="comment_shortcuts" value="true" <?php if ( !empty( $profileuser->comment_shortcuts ) ) checked( 'true', $profileuser->comment_shortcuts ); ?> /> <?php _e( 'Enable keyboard shortcuts for comment moderation.', 'stormbringer' ); ?></label> <?php _e( '<a href="http://codex.wordpress.org/Keyboard_Shortcuts" target="_blank">More information</a>', 'stormbringer' ); ?></td>
		</tr>
		<?php endif; ?>
		<?php if ( function_exists( '_get_admin_bar_pref' ) ) : ?>
		<tr class="show-admin-bar">
			<?php if ( version_compare( $wp_version, '3.3', '>=' ) ) : ?>
			<th scope="row"><?php _e( 'Toolbar', 'stormbringer' )?></th>
			<td>
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e( 'Toolbar', 'stormbringer' ) ?></span></legend>
					<label for="admin_bar_front">
						<input name="admin_bar_front" type="checkbox" id="admin_bar_front" value="1"<?php checked( _get_admin_bar_pref( 'front', $profileuser->ID ) ); ?> />
						<?php _e( 'Show Toolbar when viewing site', 'stormbringer' ); ?>
					</label>
					<br />
				</fieldset>
			</td>
			<?php else : ?>
			<th scope="row"><?php _e( 'Show Admin Bar', 'stormbringer' )?></th>
			<td>
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e( 'Show Admin Bar', 'stormbringer' ); ?></span></legend>
					<label for="admin_bar_front">
						<input name="admin_bar_front" type="checkbox" id="admin_bar_front" value="1" <?php checked( _get_admin_bar_pref( 'front', $profileuser->ID ) ); ?> />
						<?php /* translators: Show admin bar when viewing site */ _e( 'when viewing site', 'stormbringer' ); ?>
					</label>
					<br />
					<label for="admin_bar_admin">
						<input name="admin_bar_admin" type="checkbox" id="admin_bar_admin" value="1" <?php checked( _get_admin_bar_pref( 'admin', $profileuser->ID ) ); ?> />
						<?php /* translators: Show admin bar in dashboard */ _e( 'in dashboard', 'stormbringer' ); ?>
					</label>
				</fieldset>
			</td>
			<?php endif; ?>
		</tr>
		<?php endif; // function exists ?>
		<?php do_action( 'personal_options', $profileuser ); ?>
		</table>
		<?php endif; // restrict admin ?>

		<?php do_action( 'profile_personal_options', $profileuser ); ?>

		<h3><?php _e( 'Name', 'stormbringer' ) ?></h3>

		<table class="form-table">
		<tr>
			<th><label for="user_login"><?php _e( 'Username', 'stormbringer' ); ?></label></th>
			<td><input type="text" name="user_login" id="user_login" value="<?php echo esc_attr( $profileuser->user_login ); ?>" disabled="disabled" class="regular-text" /> <span class="description"><?php _e( 'Your username cannot be changed.', 'stormbringer' ); ?></span></td>
		</tr>

		<tr>
			<th><label for="first_name"><?php _e( 'First name', 'stormbringer' ) ?></label></th>
			<td><input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( $profileuser->first_name ) ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="last_name"><?php _e( 'Last name', 'stormbringer' ) ?></label></th>
			<td><input type="text" name="last_name" id="last_name" value="<?php echo esc_attr( $profileuser->last_name ) ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="nickname"><?php _e( 'Nickname', 'stormbringer' ); ?> <span class="description"><?php _e( '(required)', 'stormbringer' ); ?></span></label></th>
			<td><input type="text" name="nickname" id="nickname" value="<?php echo esc_attr( $profileuser->nickname ) ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="display_name"><?php _e( 'Display name publicly as', 'stormbringer' ) ?></label></th>
			<td>
				<select name="display_name" id="display_name">
				<?php
					$public_display = array();
					$public_display['display_nickname']  = $profileuser->nickname;
					$public_display['display_username']  = $profileuser->user_login;
					if ( !empty( $profileuser->first_name ) )
						$public_display['display_firstname'] = $profileuser->first_name;
					if ( !empty( $profileuser->last_name ) )
						$public_display['display_lastname'] = $profileuser->last_name;
					if ( !empty( $profileuser->first_name ) && !empty( $profileuser->last_name ) ) {
						$public_display['display_firstlast'] = $profileuser->first_name . ' ' . $profileuser->last_name;
						$public_display['display_lastfirst'] = $profileuser->last_name . ' ' . $profileuser->first_name;
					}
					if ( !in_array( $profileuser->display_name, $public_display ) )// Only add this if it isn't duplicated elsewhere
						$public_display = array( 'display_displayname' => $profileuser->display_name ) + $public_display;
					$public_display = array_map( 'trim', $public_display );
					foreach ( $public_display as $id => $item ) {
						$selected = ( $profileuser->display_name == $item ) ? ' selected="selected"' : '';
				?>
						<option id="<?php echo $id; ?>" value="<?php echo esc_attr( $item ); ?>"<?php echo $selected; ?>><?php echo $item; ?></option>
				<?php } ?>
				</select>
			</td>
		</tr>
		</table>

		<h3><?php _e( 'Contact Info', 'stormbringer' ) ?></h3>

		<table class="form-table">
		<tr>
			<th><label for="email"><?php _e( 'E-mail', 'stormbringer' ); ?> <span class="description"><?php _e( '(required)', 'stormbringer' ); ?></span></label></th>
			<td><input type="text" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ) ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="url"><?php _e( 'Website', 'stormbringer' ) ?></label></th>
			<td><input type="text" name="url" id="url" value="<?php echo esc_attr( $profileuser->user_url ) ?>" class="regular-text code" /></td>
		</tr>

		<?php if ( function_exists( '_wp_get_user_contactmethods' ) ) :
			foreach ( _wp_get_user_contactmethods() as $name => $desc ) {
		?>
		<tr>
			<th><label for="<?php echo $name; ?>"><?php echo apply_filters( 'user_'.$name.'_label', $desc ); ?></label></th>
			<td><input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_attr( $profileuser->$name ) ?>" class="regular-text" /></td>
		</tr>
		<?php
			}
			endif;
		?>
		</table>

		<h3><?php _e( 'About Yourself', 'stormbringer' ); ?></h3>

		<table class="form-table">
		<tr>
			<th><label for="description"><?php _e( 'Biographical Info', 'stormbringer' ); ?></label></th>
			<td><textarea name="description" id="description" rows="5" cols="30"><?php echo esc_html( $profileuser->description ); ?></textarea><br />
			<span class="description"><?php _e( 'Share a little biographical information to fill out your profile. This may be shown publicly.', 'stormbringer' ); ?></span></td>
		</tr>

		<?php
		$show_password_fields = apply_filters( 'show_password_fields', true, $profileuser );
		if ( $show_password_fields ) :
		?>
		<tr id="password">
			<th><label for="pass1"><?php _e( 'New Password', 'stormbringer' ); ?></label></th>
			<td><input type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" /> <span class="description"><?php _e( 'If you would like to change the password type a new one. Otherwise leave this blank.', 'stormbringer' ); ?></span><br />
				<input type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" /> <span class="description"><?php _e( 'Type your new password again.', 'stormbringer' ); ?></span><br />
				<div id="pass-strength-result"><?php _e( 'Strength indicator', 'stormbringer' ); ?></div>
				<p class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', 'stormbringer' ); ?></p>
			</td>
		</tr>
		<?php endif; ?>
		</table>

		<?php
			do_action( 'show_user_profile', $profileuser );
		?>

		<?php if ( count( $profileuser->caps ) > count( $profileuser->roles ) && apply_filters( 'additional_capabilities_display', true, $profileuser ) ) { ?>
		<br class="clear" />
			<table width="99%" style="border: none;" cellspacing="2" cellpadding="3" class="editform">
				<tr>
					<th scope="row"><?php _e( 'Additional Capabilities', 'stormbringer' ) ?></th>
					<td><?php
					$output = '';
					global $wp_roles;
					foreach ( $profileuser->caps as $cap => $value ) {
						if ( !$wp_roles->is_role( $cap ) ) {
							if ( $output != '' )
								$output .= ', ';
							$output .= $value ? $cap : "Denied: {$cap}";
						}
					}
					echo $output;
					?></td>
				</tr>
			</table>
		<?php } ?>

		<p class="submit">
			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
			<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Update Profile', 'stormbringer' ); ?>" name="submit" />
		</p>
	</form>
</div>
