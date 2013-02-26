<?php get_header(); ?>

<div id="content" class="<?php echo apply_filters('stormbringer_content_container_class', 'span9');?>" role="main">

  <?php stormbringer_breadcrumb();?>

    <header class="page-header search-header">
      <h1 class="search-title"><span><?php printf( __( 'Résultats de la recherche : %s', 'stormbringer' ), '</span>' . get_search_query() . '' ); ?></h1>
    </header>

    <?php if ( have_posts() ) : ?>
      <?php /* Start the Loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>

        <?php
        /* Include the Post-Format-specific template for the content.
        * If you want to overload this in a child theme then include a file
        * called content-___.php (where ___ is the Post Format name) and that will be used instead.
        */
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
  <!-- /#main -->

  <aside id="sidebar" class="<?php echo apply_filters('stormbringer_sidebar_container_class', 'span3'); ?>" role="complementary">
    <?php get_sidebar('blog'); ?>
  </aside>
  <!-- /#sidebar -->

</div>
<!-- /#content -->

<?php get_footer(); ?>