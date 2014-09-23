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
    <legend><?php _e('Nom', 'stormbringer') ?></legend>


    <div class="form-group">
      <label class="control-label" for="user_login"><?php _e('Nom d\'utilisateur', 'stormbringer') ?></label>

      <div class="form-input">
        <input placeholder="<?php _e('Nom d\'utilisateur', 'stormbringer') ?>" disabled="disabled" type="text" name="user_login" id="user_login" class="form-control" value="<?php echo esc_attr($profileuser->user_login); ?>"/>
      </div>
	    <span class="help-block"><?php _e('Votre nom d\'utilisateur ne peut pas être changé', 'stormbringer'); ?></span>
    </div>

    <div class="form-group">
      <label class="control-label" for="first_name"><?php _e('Prénom', 'stormbringer') ?></label>

      <div class="form-input">
        <input placeholder="<?php _e('Prénom', 'stormbringer') ?>" type="text" name="first_name" id="first_name" class="form-control" value="<?php echo esc_attr($profileuser->first_name) ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label" for="last_name"><?php _e('Nom', 'stormbringer') ?></label>

      <div class="form-input">
        <input placeholder="<?php _e('Nom', 'stormbringer') ?>" type="text" name="last_name" id="last_name" class="form-control" value="<?php echo esc_attr($profileuser->last_name) ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label" for="nickname"><?php _e('Surnom', 'stormbringer') ?>
        <span class="form-required">*</span></label>

      <div class="form-input">
        <input placeholder="<?php _e('Surnom', 'stormbringer') ?>" type="text" name="nickname" id="nickname" class="form-control" value="<?php echo esc_attr($profileuser->nickname) ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label" for="display_name"><?php _e('Nom affiché publiquement', 'stormbringer') ?>
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
    <legend><?php _e('Réseaux sociaux', 'stormbringer') ?></legend>

    <div class="form-group">
      <label class="control-label" for="email"><?php _e('E-mail', 'stormbringer') ?><span class="form-required">*</span></label>

      <div class="form-input">
        <input placeholder="<?php _e('E-mail', 'stormbringer') ?>" type="text" name="email" id="email" class="form-control" value="<?php echo esc_attr($profileuser->user_email) ?>"/>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label" for="url"><?php _e('Website', 'stormbringer') ?></label>

      <div class="form-input">
        <input placeholder="<?php _e('Site web', 'stormbringer') ?>" type="text" name="url" id="url" class="form-control" value="<?php echo esc_attr($profileuser->user_url) ?>"/>
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
    <legend><?php _e('À propos de vous', 'stormbringer'); ?></legend>

    <div class="form-group">
      <label class="control-label" for="description"><?php _e('Biographical Info', 'stormbringer'); ?></label>

      <div class="form-input">
        <textarea name="description" id="description" rows="5" cols="30" class="form-control"><?php echo esc_html($profileuser->description); ?></textarea>
      </div>
	    <div class="help-block"><?php _e('Décrivez-vous en quelques mots.', 'stormbringer'); ?></div>
    </div>

    <?php
    $show_password_fields = apply_filters('show_password_fields', true, $profileuser);
    if ($show_password_fields) :
      ?>
      <div class="form-group">
        <label class="control-label" for="pass1"><?php _e('Nouveau mot de passe', 'stormbringer'); ?></label>
				<div class="form-input">
					<input type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" class="form-control"/>
				</div>
	      <div class="help-block"><?php _e('Si vous souhaitez changer de mot de passe, sinon laissez le champ vide.', 'stormbringer'); ?></div>

	      <div class="form-input form-input-offset">
          <input type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" class="form-control"/>
        </div>
	      <span class="help-block"><?php _e('Saisissez votre mot de passe à nouveau.', 'stormbringer'); ?></span><br/>
	      <p id="pass-strength-result" class="help-block"><?php _e('Force du mot de passe', 'stormbringer'); ?></p>
	      <p class="help-block indicator-hint"><?php _e('Conseil : Le mot de passe doit comporter au moins 8 charactères. Pour le rendre plus fort, utilisez des capitales et minuscules, chiffres et symboles comme ! " ? $ % ^ &amp; ).', 'stormbringer'); ?></p>
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
		  <input class="btn btn-primary" type="submit" name="form-submit" value="<?php esc_attr_e('Mettre à jour mon compte', 'stormbringer'); ?>"/>
		  <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($current_user->ID); ?>"/>
		  <input type="hidden" name="from" value="profile"/>
		  <input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>"/>
		  <?php wp_nonce_field('update-user_' . $current_user->ID) ?>
	  </div>
  </div>

</form>
