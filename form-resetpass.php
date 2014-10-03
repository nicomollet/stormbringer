<?php
/**
 * The template for displaying the Theme my Login "Reset Pass".
 *
 * @package StormBringer
 * @since StormBringer 0.0.2
 */
?>
<?php //$template->the_action_template_message('resetpass'); ?>
<?php stormbringer_thememylogin_errors($template->get_errors()); ?>
<?php //$thememylogin_options = stormbringer_thememylogin_options(); ?>

<form name="form-resetpassword" id="form-resetpassword<?php $template->the_instance(); ?>" action="<?php $template->the_action_url('resetpass'); ?>" method="post" class="form-horizontal form-login">

  <div class="form-group">
    <label class="control-label" for="pass1<?php $template->the_instance(); ?>"><?php _e('New password', 'stormbringer') ?></label>

    <div class="controls">
      <input placeholder="<?php _e('New password', 'stormbringer') ?>" type="password" name="pass1" id="pass1<?php $template->the_instance(); ?>" class="input-small" value="" autocomplete="off"/>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label" for="pass2<?php $template->the_instance(); ?>"><?php _e('Confirm new password', 'stormbringer') ?></label>

    <div class="controls">
      <input placeholder="<?php _e('Confirm new password', 'stormbringer') ?>" type="password" name="pass2" id="pass2<?php $template->the_instance(); ?>" class="input-small" value="" autocomplete="off"/>
      <p id="pass-strength-result" class="help-block hide-if-no-js"><?php _e('Strength indicator', 'stormbringer'); ?></p>
      <p class="help-block indicator-hint"><?php _e('Hint: the password should be at least eight characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).'); ?></p>
    </div>
  </div>

  <?php
  do_action('resetpassword_form'); // Wordpress hook
  do_action_ref_array('tml_resetpassword_form', array($template)); // TML hook
  ?>
  <div class="form-actions">
    <input type="submit" class="btn btn-primary" name="form-submit" id="form-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e('Reset Password', 'stormbringer'); ?>"/>
    <input type="hidden" name="key" value="<?php $template->the_posted_value('key'); ?>"/>
    <input type="hidden" name="login" id="user_login" value="<?php $template->the_posted_value('login'); ?>"/>
    <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>"/>
  </div>
</form>
<?php //$template->the_action_links(array('lostpassword' => false)); ?>
