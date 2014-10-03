<?php
/**
 * The template for displaying the default Sidebar.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>
<aside id="sidebar" role="complementary">
  <div class="sidebar-inside">
    <?php if (is_active_sidebar('sidebar_main')) : ?>
      <?php dynamic_sidebar('sidebar_main'); ?>
    <?php else : ?>
    <div class="alert fade in">
      <a class="close" data-dismiss="alert">×</a>
      <p><?php _e('Enable widgets in Sidebar', 'stormbringer'); ?></p>
    </div>
    <?php endif; ?>
  </div>
</aside>