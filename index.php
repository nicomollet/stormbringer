<?php get_header(); ?>

<div class="hero-unit ">
    <h1><?php bloginfo('title'); ?></h1>
    <p><?php bloginfo('description'); ?></p>
</div>

<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">

  <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
    <div class="page-header">
      <h1 class="page-title"><?php _e('Latest Posts', 'roots');?></h1>
    </div>
    <?php get_template_part('content', 'index'); ?>
  </div><!-- /#main -->

  <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
    <?php get_sidebar(); ?>
  </aside><!-- /#sidebar -->

</div><!-- /#content -->
      
<?php get_footer(); ?>