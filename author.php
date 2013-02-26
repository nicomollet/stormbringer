<?php get_header(); ?>

<div id="content" class="<?php echo apply_filters('stormbringer_content_container_class', 'span9');?>" role="main">

  <?php stormbringer_breadcrumb();?>


    <?php if ( have_posts() ) the_post(); ?>

    <header class="page-header author-header">
      <h1 class="author-title">
        <span><?php _e("Articles rédigés par :", "stormbringer"); ?></span> <?php get_the_author_meta('display_name'); ?>
        <span class="vcard"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) );?>" title="<?php echo esc_attr( get_the_author() );?>" rel="me"><?php echo get_the_author();?></a></span>
      </h1>
      <?php
      // If a user has filled out their description, show a bio on their entries.
      if ( get_the_author_meta( 'description' ) ) : ?>
      <div id="author-info">
        <div id="author-avatar">
          <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 60 ) ); ?>
        </div><!-- #author-avatar -->
        <div id="author-description">
          <h2><?php printf( __( 'A propos de %s', 'stormbringer' ), get_the_author() ); ?></h2>
          <?php the_author_meta( 'description' ); ?>
        </div><!-- #author-description	-->
      </div><!-- #entry-author-info -->
      <?php endif; ?>
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

    <?php get_template_part( 'pagination', 'archive' ); ?>

  <?php else : ?>

    <?php
      /* No results */
      get_template_part( 'content', 'none' );
    ?>

  <?php endif; ?>

</div>
<!-- /#content -->

<aside id="sidebar" class="<?php echo apply_filters('stormbringer_sidebar_container_class', 'span3'); ?>" role="complementary">
  <?php get_sidebar('blog'); ?>
</aside>
<!-- /#sidebar -->



<?php get_footer(); ?>