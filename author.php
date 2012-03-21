<?php get_header(); ?>

<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">

  <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">

    <?php if (BREADCRUMB_ACTIVE) breadcrumb_trail();?>

    <?php if ( have_posts() ) the_post(); ?>

    <header class="page-header author-header">
      <h1 class="author-title">
        <span><?php _e("Posts By:", "bonestheme"); ?></span> <?php get_the_author_meta('display_name'); ?>
        <span class="vcard"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) );?>" title="<?php echo esc_attr( get_the_author() );?>" rel="me"><?php echo get_the_author();?></a></span>
      </h1>
      <?php
      // If a user has filled out their description, show a bio on their entries.
      if ( get_the_author_meta( 'description' ) ) : ?>
        <p id="author-description">
          <?php the_author_meta( 'description' ); ?>
        </p><!-- #author-description -->
      <?php endif; ?>
    </header>

    <?php get_template_part('content', get_post_format()); ?>

  </div>
  <!-- end #main -->

  <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
    <?php get_sidebar(); ?>
  </aside><!-- /#sidebar -->


</div> <!-- end #content -->

<?php get_footer(); ?>