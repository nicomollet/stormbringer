<?php
/**
 * The template for displaying the Theme my Login "Register Form".
 *
 * @package StormBringer
 * @since StormBringer 0.0.2
 */
?>
<?php //$template->the_action_template_message('register','<p>','</p>'); ?>
<?php stormbringer_thememylogin_errors($template->get_errors());?>

<form name="form-register" id="form-register-<?php $template->the_instance(); ?>" action="<?php $template->the_action_url('register'); ?>" method="post" class="form-horizontal form-register">

  <div class="control-group">
    <label class="control-label" for="userlogin-<?php $template->the_instance(); ?>"><?php _e('Username', 'theme-my-login') ?></label>

    <div class="controls">
      <input placeholder="<?php _e('Username', 'theme-my-login') ?>" type="text" name="user_login" id="userlogin-<?php $template->the_instance(); ?>" class="input-small" value="<?php $template->the_posted_value('user_login'); ?>"/>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="useremail-<?php $template->the_instance(); ?>"><?php _e('E-mail', 'theme-my-login') ?></label>

    <div class="controls">
      <input placeholder="<?php _e('E-mail', 'theme-my-login') ?>" type="text" name="user_email" id="useremail-<?php $template->the_instance(); ?>" class="input-small" value="<?php $template->the_posted_value('user_email'); ?>"/>
      <span class="help-inline"><?php _e('A password will be e-mailed to you.', 'theme-my-login'); ?></span>
    </div>
  </div>

  <?php
  do_action('register_form'); // Wordpress hook
  do_action_ref_array('tml_register_form', array(&$template)); //TML hook
  ?>

  <div class="form-actions">
    <input class="btn btn-primary" type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php _e('Register', 'theme-my-login'); ?>"/>
    <input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url('register'); ?>"/>
    <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>"/>
  </div>

</form>
<?php $template->the_action_links(array('register' => false)); ?>
