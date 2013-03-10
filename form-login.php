<?php
/**
 * The template for displaying the Theme my Login "Login Form".
 *
 * @package StormBringer
 * @since StormBringer 0.0.2
 */
?>
<?php //$template->the_action_template_message('login'); ?>
<?php stormbringer_thememylogin_errors($template->get_errors());?>
<?php $thememylogin_options = stormbringer_thememylogin_options(); ?>

<form name="form-login" id="form-login-<?php $template->the_instance(); ?>" action="<?php $template->the_action_url('login'); ?>" method="post" class="form-horizontal form-login">

  <div class="control-group">
    <label class="control-label" for="userlogin-<?php $template->the_instance(); ?>"><?php _e('Username', 'stormbringer') ?></label>

    <div class="controls">
      <input placeholder="<?php _e('Username', 'stormbringer') ?>" type="text" name="log" id="userlogin-<?php $template->the_instance(); ?>" class="input-small" value="<?php $template->the_posted_value('log'); ?>"/>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="userpass-<?php $template->the_instance(); ?>"><?php _e('Password', 'stormbringer') ?></label>

    <div class="controls">
      <input placeholder="<?php _e('Password', 'stormbringer') ?>" type="password" name="pwd" id="userpass-<?php $template->the_instance(); ?>" class="input-small" value=""/>
    </div>
  </div>


  <div class="control-group">
    <div class="controls">
      <label class="checkbox">
        <input name="rememberme" type="checkbox" id="rememberme-<?php $template->the_instance(); ?>" value="forever"/> <?php _e('Remember Me', 'stormbringer'); ?>
      </label>
    </div>
  </div>

  <?php
  do_action('login_form'); // Wordpress hook
  do_action_ref_array('tml_login_form', array(&$template)); // TML hook
  ?>

  <div class="form-actions">
    <input class="btn btn-primary" type="submit" name="wp-submit" id="wp-submit-<?php $template->the_instance(); ?>" value="<?php _e('Log In', 'stormbringer'); ?>"/>
    <?php
    if ($this->options['show_pass_link'])
      printf('<a href="%s">%s</a>', $this->get_action_url('lostpassword'), $this->get_title('lostpassword'));
    ?>
    <input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url('login'); ?>"/>
    <input type="hidden" name="testcookie" value="1"/>
    <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>"/>
  </div>

  <div class="movetomodal-footer">
    <p class="pull-right">
      <?php
      if ($this->options['show_reg_link'] && get_option( 'users_can_register' ) )
      printf($thememylogin_options['message_noaccount'].' <a href="%s" class="btn btn-primary" title="">%s</a>',$this->get_action_url( 'register' ),$this->get_title( 'register' ),$this->get_title( 'register' ));
      ?>
    </p>
  </div>

</form>

<?php //$template->the_action_links(array('login' => false)); ?>


