<?php
/**
 * The template for displaying Archive pages.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>
<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="content" class="<?php echo apply_filters('stormbringer_content_container_class', 'col-md-9');?>" role="main">

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