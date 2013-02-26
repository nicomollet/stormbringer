<?php get_header(); ?>

<aside id="sidebar" class="<?php echo apply_filters('stormbringer_sidebar_container_class', 'span3'); ?>" role="complementary">
  <?php get_sidebar(); ?>
</aside>
<!-- /#sidebar -->

<div id="content" class="<?php echo apply_filters('stormbringer_content_container_class', 'span9');?>" role="main">

  <?php stormbringer_breadcrumb();?>

  <?php if (have_posts()) : the_post(); ?>
    <?php $format = get_post_format();
      if ( false === $format )
      $format = 'standard';
      get_template_part( 'content', 'page' );
    ?>
  <?php endif;?>

</div>
<!-- /#content -->

<?php get_footer(); ?>