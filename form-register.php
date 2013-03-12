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
<?php $thememylogin_options = stormbringer_thememylogin_options(); ?>

<form name="form-register" id="form-register<?php $template->the_instance(); ?>" action="<?php $template->the_action_url('register'); ?>" method="post" class="form-horizontal form-register">

  <div class="control-group">
    <label class="control-label" for="userlogin<?php $template->the_instance(); ?>"><?php _e('Username', 'stormbringer') ?></label>

    <div class="controls">
      <input placeholder="<?php _e('Username', 'stormbringer') ?>" type="text" name="user_login" id="userlogin<?php $template->the_instance(); ?>" class="input-small" value="<?php $template->the_posted_value('user_login'); ?>"/>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="useremail-<?php $template->the_instance(); ?>"><?php _e('E-mail', 'stormbringer') ?></label>

    <div class="controls">
      <input placeholder="<?php _e('E-mail', 'stormbringer') ?>" type="text" name="user_email" id="useremail<?php $template->the_instance(); ?>" class="input-small" value="<?php $template->the_posted_value('user_email'); ?>"/>
      <span class="help-inline"><?php _e('A password will be e-mailed to you.', 'stormbringer'); ?></span>
    </div>
  </div>

  <?php
  do_action('register_form'); // Wordpress hook
  do_action_ref_array('tml_register_form', array(&$template)); //TML hook
  ?>

  <div class="form-actions">
    <input class="btn btn-primary" type="submit" name="form-submit" id="form-submit<?php $template->the_instance(); ?>" value="<?php _e('Register', 'stormbringer'); ?>"/>
    <input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url('register'); ?>"/>
    <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>"/>
  </div>

  <div class="movetomodal-footer">
    <p class="pull-right">
      <?php
      _e('Déjà un compte ?','stormbringer'); print'&nbsp;';
      printf('<a href="%s" class="btn btn-primary" title="">%s</a>',$this->get_action_url( 'login' ),$this->get_title( 'login' ),$this->get_title( 'login' ));
      ?>
    </p>
  </div>

</form>
<?php //$template->the_action_links(array('register' => false)); ?>