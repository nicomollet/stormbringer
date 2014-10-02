<?php
/**
 * The template for displaying the Theme my Login "Profile Form".
 *
 * @package StormBringer
 * @since StormBringer 0.0.2
 */
?>
<?php
$user_role = reset($profileuser->roles);
if (is_multisite() && empty($user_role)) {
  $user_role = 'subscriber';
}

$user_can_edit = false;
foreach (array('posts', 'pages') as $post_cap)
  $user_can_edit |= current_user_can("edit_$post_cap");
?>

<?php //$template->the_action_template_message( 'profile' ); ?>
<?php stormbringer_thememylogin_errors($template->get_errors()); ?>
<?php $thememylogin_options = stormbringer_thememylogin_options(); ?>

<?php //$template->the_errors(); ?>

<form id="form-profile" action="<?php $template->the_action_url('profile'); ?>" method="post" class="form form-horizontal form-profile">
  <?php do_action('profile_personal_options', $profileuser); ?>

  <fieldset>
    <legend><?php _e('Account information', 'stormbringer') ?></legend>


    <div class="form-group">
      <label class="control-label" for="user_login"><?php _e('Username', 'stormbringer') ?></label>

      <div class="form-input">
        <input placeholder="<?php _e('Username', 'stormbringer') ?>" disabled="disabled" type="text" name="user_login" id="user_login" class="form-control" value="<?php echo esc_attr($profileuser->user_login); ?>"/>
      </div>
	    <span class="help-block"><?php _e('Your username can\'t be changed', 'stormbringer'); ?></span>
    </div>

    <div class="form-group">
      <label class="control-label" for="first_name"><?php _e('First name', 'stormbringer') ?></label>

      <div class="form-input">
        <input placeholder="<?php _e('First name', 'stormbringer') ?>" type="text" name="first_name" id="first_name" class="form-control" value="<?php echo esc_attr($profileuser->first_name) ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label" for="last_name"><?php _e('Last name', 'stormbringer') ?></label>

      <div class="form-input">
        <input placeholder="<?php _e('Last name', 'stormbringer') ?>" type="text" name="last_name" id="last_name" class="form-control" value="<?php echo esc_attr($profileuser->last_name) ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label" for="nickname"><?php _e('Surname', 'stormbringer') ?>
        <span class="form-required">*</span></label>

      <div class="form-input">
        <input placeholder="<?php _e('Surname', 'stormbringer') ?>" type="text" name="nickname" id="nickname" class="form-control" value="<?php echo esc_attr($profileuser->nickname) ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label" for="display_name"><?php _e('Displayed publicly', 'stormbringer') ?>
        <span class="form-required">*</span></label>

      <div class="form-input">
        <select name="display_name" id="display_name" class="form-control">
          <?php
          $public_display = array();
          $public_display['display_nickname'] = $profileuser->nickname;
          $public_display['display_username'] = $profileuser->user_login;
          if (!empty($profileuser->first_name))
            $public_display['display_firstname'] = $profileuser->first_name;
          if (!empty($profileuser->last_name))
            $public_display['display_lastname'] = $profileuser->last_name;
          if (!empty($profileuser->first_name) && !empty($profileuser->last_name)) {
            $public_display['display_firstlast'] = $profileuser->first_name . ' ' . $profileuser->last_name;
            $public_display['display_lastfirst'] = $profileuser->last_name . ' ' . $profileuser->first_name;
          }
          if (!in_array($profileuser->display_name, $public_display)) // Only add this if it isn't duplicated elsewhere
            $public_display = array('display_displayname' => $profileuser->display_name) + $public_display;
          $public_display = array_map('trim', $public_display);
          foreach ($public_display as $id => $item) {
            $selected = ($profileuser->display_name == $item) ? ' selected="selected"' : '';
            ?>
            <option id="<?php echo $id; ?>" value="<?php echo esc_attr($item); ?>"<?php echo $selected; ?>><?php echo $item; ?></option>
            <?php } ?>
        </select>
      </div>
    </div>

  </fieldset>


  <fieldset>
    <legend><?php _e('Social networks', 'stormbringer') ?></legend>

    <div class="form-group">
      <label class="control-label" for="email"><?php _e('Email', 'stormbringer') ?><span class="form-required">*</span></label>

      <div class="form-input">
        <input placeholder="<?php _e('Email', 'stormbringer') ?>" type="text" name="email" id="email" class="form-control" value="<?php echo esc_attr($profileuser->user_email) ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label" for="url"><?php _e('Website', 'stormbringer') ?></label>

      <div class="form-input">
        <input placeholder="<?php _e('Website', 'stormbringer') ?>" type="text" name="url" id="url" class="form-control" value="<?php echo esc_attr($profileuser->user_url) ?>"/>
      </div>
    </div>

    <?php if (function_exists('_wp_get_user_contactmethods')) :
    foreach (_wp_get_user_contactmethods() as $name => $desc) {
      ?>
      <div class="form-group">
        <label class="control-label" for="<?php echo $name; ?>"><?php echo apply_filters('user_' . $name . '_label', $desc); ?></label>

        <div class="form-input">
          <input placeholder="<?php echo apply_filters('user_' . $name . '_label', $desc); ?>" type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="form-control" value="<?php echo esc_attr($profileuser->$name) ?>"/>
        </div>
      </div>
      <?php
    }
  endif;
    ?>

  </fieldset>

  <fieldset>
    <legend><?php _e('About you', 'stormbringer'); ?></legend>

    <div class="form-group">
      <label class="control-label" for="description"><?php _e('Biographical Info', 'stormbringer'); ?></label>

      <div class="form-input">
        <textarea name="description" id="description" rows="5" cols="30" class="form-control"><?php echo esc_html($profileuser->description); ?></textarea>
      </div>
	    <div class="help-block"><?php _e('Tell us about you in a few words.', 'stormbringer'); ?></div>
    </div>

    <?php
    $show_password_fields = apply_filters('show_password_fields', true, $profileuser);
    if ($show_password_fields) :
      ?>
      <div class="form-group">
        <label class="control-label" for="pass1"><?php _e('New password', 'stormbringer'); ?></label>
				<div class="form-input">
					<input type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" class="form-control"/>
				</div>
	      <div class="help-block"><?php _e('If you want to change your password, if not leave empty.', 'stormbringer'); ?></div>

	      <div class="form-input form-input-offset">
          <input type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" class="form-control"/>
        </div>
	      <span class="help-block"><?php _e('Type your password again.', 'stormbringer'); ?></span><br/>
	      <p id="pass-strength-result" class="help-block"><?php _e('Password Strength', 'stormbringer'); ?></p>
	      <p class="help-block indicator-hint"><?php _e('Hint: the password should be at least eight characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', 'stormbringer'); ?></p>
      </div>
      <?php endif; ?>
  </fieldset>
  <?php
  do_action('show_user_profile', $profileuser);
  ?>

  <?php if (count($profileuser->caps) > count($profileuser->roles) && apply_filters('additional_capabilities_display', true, $profileuser)) { ?>
  <fieldset>
    <legend><?php _e('Permissions', 'stormbringer') ?></legend>

    <div class="form-group">
      <label class="control-label"><?php _e('Permissions', 'stormbringer'); ?></label>

      <div class="form-input">
        <?php
        $output = '';
        global $wp_roles;
        foreach ($profileuser->caps as $cap => $value) {
          if (!$wp_roles->is_role($cap)) {
            if ($output != '')
              $output .= ', ';
            $output .= $value ? $cap : "Denied: {$cap}";
          }
        }
        echo $output;
        ?>
      </div>
    </div>
  </fieldset>
  <?php } ?>

  <div class="form-group">
	  <div class="form-actions">
		  <input class="btn btn-primary" type="submit" name="form-submit" value="<?php esc_attr_e('Update my account', 'stormbringer'); ?>"/>
		  <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($current_user->ID); ?>"/>
		  <input type="hidden" name="from" value="profile"/>
		  <input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>"/>
		  <?php wp_nonce_field('update-user_' . $current_user->ID) ?>
	  </div>
  </div>

</form>
