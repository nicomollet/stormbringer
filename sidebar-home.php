<div class="inside">
  <?php if (is_active_sidebar('sidebar_home')) : ?>
  <?php dynamic_sidebar('sidebar_home'); ?>
<?php else : ?>
  <div class="alert alert-block fade in">
    <a class="close" data-dismiss="alert">×</a>
    <p><?php _e('Veuillez activer des widgets de Sidebar Home', 'stormbringer'); ?></p>
  </div>
<?php endif; ?>
</div>