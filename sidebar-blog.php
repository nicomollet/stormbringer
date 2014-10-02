<?php
/**
 * The template for displaying the Blog Sidebar.
 *
 * @package StormBringer
 * @since StormBringer 0.0.2
 */
?>
<aside id="sidebar" role="complementary">
  <div class="sidebar-inside">
    <?php if (is_active_sidebar('sidebar_blog')) : ?>
      <?php dynamic_sidebar('sidebar_blog'); ?>
    <?php else : ?>
    <div class="alert alert-block fade in">
      <a class="close" data-dismiss="alert">×</a>
      <p><?php _e('Enable widgets in Sidebar Blog', 'stormbringer'); ?></p>
    </div>
    <?php endif; ?>
  </div>
</aside>