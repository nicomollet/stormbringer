<?php
/**
 * The template for displaying a default Homepage with last posts.
 *
 * @package StormBringer
 * @since StormBringer 0.1
 */
?>

<?php get_header(); ?>

<div class="span12">
  <div class="hero-unit">
      <h1><?php bloginfo('title'); ?></h1>
      <p><?php bloginfo('description'); ?></p>
  </div>
</div>

</div>
<div class="row">

<div id="content" class="<?php echo apply_filters('stormbringer_content_container_class', 'span9');?>" role="main">

  <div class="page-header index-header">
    <h1 class="page-title index-title"><?php _e('Derniers articles', 'stormbringer');?></h1>
  </div>

  <?php if ( have_posts() ) : ?>

  <?php while ( have_posts() ) : the_post(); ?>

    <?php
    $format = get_post_format();
    if ( false === $format )
      $format = 'standard';
    get_template_part( 'content', $format );
    ?>

    <?php endwhile; ?>

  <?php stormbringer_pagination();?>

  <?php else : ?>

  <?php
  /* No results */
  get_template_part( 'content', 'none' );
  ?>

  <?php endif; ?>

</div>
<!-- /#content -->

<aside id="sidebar" class="<?php echo apply_filters('stormbringer_sidebar_container_class', 'span3'); ?>" role="complementary">
  <?php get_sidebar(); ?>
</aside>
<!-- /#sidebar -->

<?php get_footer(); ?>