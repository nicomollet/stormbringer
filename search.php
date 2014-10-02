<?php
/**
 * The template for displaying Search pages.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>
<?php get_header(); ?>

<div id="content" role="main">

  <?php stormbringer_breadcrumb();?>

  <header class="page-header search-header">
    <h1 class="page-title search-title"><span><?php printf( __( 'Search results: %s', 'stormbringer' ), '</span>' . get_search_query() . '' ); ?></h1>
  </header>

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

<?php get_sidebar('blog'); ?>

<?php get_footer(); ?>