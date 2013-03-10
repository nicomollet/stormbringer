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

<form id="form-profile" action="<?php $template->the_action_url('profile'); ?>" method="post" class="form-horizontal form-profile">
  <?php do_action('profile_personal_options', $profileuser); ?>

  <fieldset>
    <legend><?php _e('Name', 'stormbringer') ?></legend>


    <div class="control-group">
      <label class="control-label" for="user_login"><?php _e('Username', 'stormbringer') ?></label>

      <div class="controls">
        <input placeholder="<?php _e('Username', 'stormbringer') ?>" disabled="disabled" type="text" name="user_login" id="user_login" class="input-small" value="<?php echo esc_attr($profileuser->user_login); ?>"/>
        <span class="help-inline"><?php _e('Your username cannot be changed.', 'stormbringer'); ?></span>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="first_name"><?php _e('First name', 'stormbringer') ?></label>

      <div class="controls">
        <input placeholder="<?php _e('First name', 'stormbringer') ?>" type="text" name="first_name" id="first_name" class="input-small" value="<?php echo esc_attr($profileuser->first_name) ?>"/>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="last_name"><?php _e('Last name', 'stormbringer') ?></label>

      <div class="controls">
        <input placeholder="<?php _e('Last name', 'stormbringer') ?>" type="text" name="last_name" id="last_name" class="input-small" value="<?php echo esc_attr($profileuser->last_name) ?>"/>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="nickname"><?php _e('Nickname', 'stormbringer') ?>
        <span class="form-required">*</span></label>

      <div class="controls">
        <input placeholder="<?php _e('Nickname', 'stormbringer') ?>" type="text" name="nickname" id="nickname" class="input-small" value="<?php echo esc_attr($profileuser->nickname) ?>"/>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="display_name"><?php _e('Display name publicly as', 'stormbringer') ?>
        <span class="form-required">*</span></label>

      <div class="controls">
        <select name="display_name" id="display_name">
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
    <legend><?php _e('Contact Info', 'stormbringer') ?></legend>

    <div class="control-group">
      <label class="control-label" for="email"><?php _e('E-mail', 'stormbringer') ?><span class="form-required">*</span></label>

      <div class="controls">
        <input placeholder="<?php _e('E-mail', 'stormbringer') ?>" type="text" name="email" id="email" class="input-small" value="<?php echo esc_attr($profileuser->user_email) ?>"/>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="url"><?php _e('Website', 'stormbringer') ?></label>

      <div class="controls">
        <input placeholder="<?php _e('Website', 'stormbringer') ?>" type="text" name="url" id="url" class="input-small" value="<?php echo esc_attr($profileuser->user_url) ?>"/>
      </div>
    </div>

    <?php if (function_exists('_wp_get_user_contactmethods')) :
    foreach (_wp_get_user_contactmethods() as $name => $desc) {
      ?>
      <div class="control-group">
        <label class="control-label" for="<?php echo $name; ?>"><?php echo apply_filters('user_' . $name . '_label', $desc); ?></label>

        <div class="controls">
          <input placeholder="<?php echo apply_filters('user_' . $name . '_label', $desc); ?>" type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="input-small" value="<?php echo esc_attr($profileuser->$name) ?>"/>
        </div>
      </div>
      <?php
    }
  endif;
    ?>

  </fieldset>

  <fieldset>
    <legend><?php _e('About Yourself', 'stormbringer'); ?></legend>

    <div class="control-group">
      <label class="control-label" for="description"><?php _e('Biographical Info', 'stormbringer'); ?></label>

      <div class="controls">
        <textarea name="description" id="description" rows="5" cols="30" class="input-small"><?php echo esc_html($profileuser->description); ?></textarea>
        <span class="help-block"><?php _e('Share a little biographical information to fill out your profile. This may be shown publicly.', 'stormbringer'); ?></span>
      </div>
    </div>

    <?php
    $show_password_fields = apply_filters('show_password_fields', true, $profileuser);
    if ($show_password_fields) :
      ?>
      <div class="control-group">
        <label class="control-label" for="pass1"><?php _e('New Password', 'stormbringer'); ?></label>

        <div class="controls">
          <input type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" class="input-small"/>
          <span class="help-block"><?php _e('If you would like to change the password type a new one. Otherwise leave this blank.', 'stormbringer'); ?></span><br/>
          <input type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" class="input-small"/>
          <span class="help-block"><?php _e('Type your new password again.', 'stormbringer'); ?></span><br/>

          <p id="pass-strength-result"><?php _e('Strength indicator', 'stormbringer'); ?></p>

          <p class="help-block indicator-hint"><?php _e('Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', 'stormbringer'); ?></p>
        </div>
      </div>
      <?php endif; ?>
  </fieldset>
  <?php
  do_action('show_user_profile', $profileuser);
  ?>

  <?php if (count($profileuser->caps) > count($profileuser->roles) && apply_filters('additional_capabilities_display', true, $profileuser)) { ?>
  <fieldset>
    <legend><?php _e('Additional Capabilities', 'stormbringer') ?></legend>

    <div class="control-group">
      <label class="control-label"><?php _e('Capabilities', 'stormbringer'); ?></label>

      <div class="controls">
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

  <div class="form-actions">
    <input class="btn btn-primary" type="submit" name="form-submit" value="<?php esc_attr_e('Update Profile', 'stormbringer'); ?>"/>
    <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($current_user->ID); ?>"/>
    <input type="hidden" name="from" value="profile"/>
    <input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>"/>
    <?php wp_nonce_field('update-user_' . $current_user->ID) ?>
  </div>

</form>
