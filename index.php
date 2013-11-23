<?php
/**
 * The template for displaying a default Homepage with last posts.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>
<?php get_header(); ?>

<div id="content" role="main">

  <div class="jumbotron">
    <div class="container">
      <h1><?php bloginfo('title'); ?></h1>
      <p><?php bloginfo('description'); ?></p>
      <p><a class="btn btn-primary btn-lg" role="button"><?php _e('Contactez-nous', 'stormbringer');?></a></p>
    </div>
  </div>

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

<?php get_sidebar('home'); ?>

<?php get_footer(); ?>