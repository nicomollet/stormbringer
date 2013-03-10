<?php
/**
 * The template for displaying the Theme my Login "Lost Password Form".
 *
 * @package StormBringer
 * @since StormBringer 0.0.2
 */
?>
<?php //$template->the_action_template_message('lostpassword'); ?>
<?php stormbringer_thememylogin_errors($template->get_errors()); ?>

<form name="form-lostpassword" id="form-lostpassword-<?php $template->the_instance(); ?>" action="<?php $template->the_action_url('lostpassword'); ?>" method="post" class="form-horizontal form-lostpassword">

  <div class="control-group">
    <label class="control-label" for="userlogin-<?php $template->the_instance(); ?>"><?php _e('Username or E-mail:', 'stormbringer') ?></label>

    <div class="controls">
      <input placeholder="<?php _e('Username or E-mail:', 'stormbringer') ?>" type="text" name="user_login" id="userlogin-<?php $template->the_instance(); ?>" class="input-small" value="<?php $template->the_posted_value('user_login'); ?>"/>
    </div>
  </div>

  <?php
  do_action('lostpassword_form'); // Wordpress hook
  do_action_ref_array('tml_lostpassword_form', array(&$template)); // TML hook
  ?>

  <div class="form-actions">
    <input class="btn btn-primary" type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php _e('Get New Password', 'stormbringer'); ?>"/>
    <input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url('lostpassword'); ?>"/>
    <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>"/>
  </div>
</form>
<?php $template->the_action_links(array('lostpassword' => false)); ?>
