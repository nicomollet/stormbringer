<?php
/**
 * The template for displaying the Home Sidebar.
 *
 * @package StormBringer
 * @since StormBringer 0.0.2
 */
?>
<aside id="sidebar" role="complementary">
  <div class="sidebar-inside">
    <?php if (is_active_sidebar('sidebar_home')) : ?>
      <?php dynamic_sidebar('sidebar_home'); ?>
    <?php else : ?>
    <div class="alert alert-block fade in">
      <a class="close" data-dismiss="alert">×</a>
      <p><?php _e('Veuillez activer des widgets de Sidebar Home', 'stormbringer'); ?></p>
    </div>
    <?php endif; ?>
  </div>
</aside>