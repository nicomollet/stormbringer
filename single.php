<?php
/**
 * The template for displaying all single posts.
 *
 * @package StormBringer
 * @since StormBringer 0.1
 */
?>

<?php get_header(); ?>

<div id="content" class="<?php echo apply_filters('stormbringer_content_container_class', 'span9');?>" role="main">

  <?php stormbringer_breadcrumb();?>

  <?php if (have_posts()) : the_post(); ?>
    <?php $format = get_post_format();
      if ( false === $format )
      $format = 'standard';
      if(is_attachment())$format = 'image';
      get_template_part( 'content', $format );
    ?>
    <?php if(!is_attachment())get_template_part( 'archive', 'author'); ?>
    <?php
    // If comments are open or we have at least one comment, load up the comment template
    if ( comments_open() || 0 != get_comments_number() )
      comments_template( '', true );
    ?>
  <?php endif;?>

</div>
<!-- /#content -->

<aside id="sidebar" class="<?php echo apply_filters('stormbringer_sidebar_container_class', 'span3'); ?>" role="complementary">
  <?php get_sidebar('blog'); ?>
</aside>
<!-- /#sidebar -->

<?php get_footer(); ?>