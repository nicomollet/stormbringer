<?php if (!is_user_logged_in()) : ?>
<div id="modal-login" class="modal hide fade">
  <form class="form form-horizontal" action="<?php echo wp_login_url(get_permalink()); ?>" method="post">
    <div class="modal-header">
      <a class="close" href="#">×</a>
      <h3><?php echo __("S'identifier", 'stormbringer'); ?></h3>
    </div>
    <div class="modal-body">

      <div class="control-group">
        <label for="username" class="control-label"><?php _e('Identifiant', 'stormbringer'); ?></label>

        <div class="controls">
          <input type="text" name="log" id="username" class="input-large">
        </div>
      </div>

      <div class="control-group">
        <label for="password" class="control-label"><?php _e('Mot de passe', 'stormbringer'); ?></label>

        <div class="controls">
          <input type="password" name="pwd" id="password" class="input-large">
        </div>
      </div>

      <div class="control-group">

        <div class="controls">
          <label class="checkbox">
            <input type="checkbox" value="forever" id="rememberme" name="rememberme">
            <label for="rememberme"><?php _e('Se souvenir', 'stormbringer'); ?></label>
          </label>
        </div>
      </div>

    </div>
    <div class="modal-footer">
      <?php if (get_option('users_can_register') == 1): ?>
      <p class="pull-left">
        <a href="/wp-login.php?action=register" class="btn" onclick="$('#modal-login').modal('hide')">
          <?php echo __('Créer un compte', 'stormbringer'); ?>
        </a>
      </p>

      <?php endif; ?>
      <p class="pull-right">
        <a href="#" class="btn" onclick="$('#modal-login').modal('hide'); return false">
          <?php echo __('Annuler', 'stormbringer'); ?>
        </a>
      </p>
      <button type="submit" class="btn btn-primary" onclick="$('#modal-login').modal('hide');"><?php echo __("S'identifier", 'stormbringer'); ?></button>
    </div>
  </form>
</div>
<?php endif; ?>