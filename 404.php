<?php get_header(); ?>

    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">

      <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
        <div class="page-header 404-header">
          <h1><?php _e("No Posts Yet", "bonestheme"); ?></h1>
        </div>
        <div class="entry-content">
          <p><?php _e("Sorry, What you were looking for is not here.", "bonestheme"); ?></p>
        </div>
      </div><!-- /#main -->

      <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
        <?php get_sidebar(); ?>
      </aside><!-- /#sidebar -->

    </div><!-- /#content -->

<?php get_footer(); ?>
