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

<form name="form-login" id="form-login<?php $template->the_instance(); ?>" action="<?php $template->the_action_url('login'); ?>" method="post" class="form form-horizontal form-login">

  <div class="form-group">
    <label class="control-label" for="userlogin<?php $template->the_instance(); ?>"><?php _e('Nom d\'utilisateur', 'stormbringer') ?></label>

    <div class="form-input">
      <input placeholder="<?php _e('Nom d\'utilisateur', 'stormbringer') ?>" type="text" name="log" id="userlogin<?php $template->the_instance(); ?>" class="form-control" value="<?php $template->the_posted_value('log'); ?>"/>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label" for="userpass-<?php $template->the_instance(); ?>"><?php _e('Mot de passe', 'stormbringer') ?></label>

    <div class="form-input">
      <input placeholder="<?php _e('Mot de passe', 'stormbringer') ?>" type="password" name="pwd" id="userpass<?php $template->the_instance(); ?>" class="form-control" value=""/>
    </div>
	  <?php
	  if ($this->options['show_pass_link']):?>
		<div class="help-block"><small>
			<?php
			printf('<a href="%s">%s</a>', $this->get_action_url('lostpassword'), $this->get_title('lostpassword'));
			?></small>
		</div>
		<?php endif; ?>
  </div>


  <div class="form-group">
    <div class="form-input form-input-offset">
      <label class="checkbox">
        <input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever"/> <?php _e('Se souvenir de moi', 'stormbringer'); ?>
      </label>
    </div>
  </div>

  <?php
  do_action('login_form'); // Wordpress hook
  do_action_ref_array('tml_login_form', array(&$template)); // TML hook
  ?>

  <div class="form-group">
	  <div class="form-actions">
		  <input class="btn btn-primary" type="submit" name="form-submit" id="form-submit<?php $template->the_instance(); ?>" value="<?php _e('Se connecter', 'stormbringer'); ?>"/>

		  <input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url('login'); ?>"/>
		  <input type="hidden" name="testcookie" value="1"/>
		  <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>"/>

	  </div>
  </div>

  <div class="movetomodal-footer">
    <p class="pull-right">
      <?php
      _e('Pas encore de compte ?','stormbringer'); print'&nbsp;';
      printf('<a href="%s" class="btn btn-primary" title="">%s</a>',$this->get_action_url( 'register' ),$this->get_title( 'register' ),$this->get_title( 'register' ));
      ?>
    </p>
  </div>

</form>

<?php //$template->the_action_links(array('login' => false)); ?>


