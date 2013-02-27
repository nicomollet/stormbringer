<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="content" class="<?php echo apply_filters('stormbringer_content_container_class', 'span9');?>" role="main">

  <?php stormbringer_breadcrumb();?>

    <?php
      /* No results */
      get_template_part( 'content', 'none' );
    ?>

</div>
<!-- /#content -->

<?php get_footer(); ?>
