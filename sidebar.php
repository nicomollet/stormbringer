<div class="well">
  <?php if (is_active_sidebar('sidebar_main')) : ?>
  <?php dynamic_sidebar('sidebar_main'); ?>
<?php else : ?>
  <div class="alert alert-block fade in">
    <a class="close" data-dismiss="alert">×</a>
    <p><?php _e('Please activate some Widgets', 'roots'); ?></p>
  </div>
<?php endif; ?>
</div>