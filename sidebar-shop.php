<?php
/**
 * The template for displaying the Shop Sidebar.
 *
 * @package StormBringer
 * @since StormBringer 0.2.8
 */
?>
<aside id="sidebar" role="complementary">
  <div class="sidebar-inside">
    <?php if (is_active_sidebar('sidebar_shop')) : ?>
      <?php dynamic_sidebar('sidebar_shop'); ?>
    <?php else : ?>
    <div class="alert alert-warning fade in">
      <a class="close" data-dismiss="alert">×</a>
      <p><?php _e('Enable widgets in Sidebar Shop', 'stormbringer'); ?></p>
    </div>
    <?php endif; ?>
  </div>
</aside>