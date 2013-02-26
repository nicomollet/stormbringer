<?php get_header(); ?>

<div id="content" class="<?php echo apply_filters('stormbringer_content_container_class', 'span9');?>" role="main">

  <?php stormbringer_breadcrumb();?>

  <header class="page-header archive-header">
    <h1 class="archive-title">
      <?php if (is_category()) { ?>
          <span><?php _e("Catégorie :", "stormbringthe_contenter"); ?></span> <?php single_cat_title(); ?>
      <?php } elseif (is_tag()) { ?>
          <span><?php _e("Mot-clé :", "stormbringer"); ?></span> <?php single_tag_title(); ?>
      <?php } elseif (is_tax()) { ?>
          <span><?php _e("Liste des articles :", "stormbringer"); ?></span> <?php single_cat_title(); ?>
      <?php } elseif (is_day()) { ?>
          <span><?php _e("Articles du jour :", "stormbringer"); ?></span> <?php the_time('l, F j, Y'); ?>
      <?php } elseif (is_month()) { ?>
          <span><?php _e("Articles du mois :", "stormbringer"); ?></span> <?php the_time('F Y'); ?>
      <?php } elseif (is_year()) { ?>
          <span><?php _e("Articles de l'année :", "stormbringer"); ?></span> <?php the_time('Y'); ?>
      <?php } elseif (is_post_type_archive()) { ?>
          <span><?php post_type_archive_title(); ?></span>
      <?php } ?>
    </h1>
    <?php
      if ( is_category() ) {
        $category = get_the_category();
        echo '<a href="'.get_category_feed_link( $category[0]->term_id).'" class="taxonomy-feed">'.__("S'inscrire",'stormbringer').'</a>';
        // show an optional category description
        $category_description = category_description();
        if ( ! empty( $category_description ) )
          echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

      } elseif ( is_tag() ) {
        // show an optional tag description
        $tag_description = tag_description();
        if ( ! empty( $tag_description ) )
          echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
      }
      ?>
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

<aside id="sidebar" class="<?php echo apply_filters('stormbringer_sidebar_container_class', 'span3'); ?>" role="complementary">
  <?php get_sidebar('blog'); ?>
</aside>
<!-- /#sidebar -->



<?php get_footer(); ?>