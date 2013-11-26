<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>

<?php get_header(); ?>

<div id="content" role="main">

  <?php stormbringer_breadcrumb();?>

  <header class="page-header archive-header">
    <h1 class="page-title archive-title">
      <?php if (is_category()) { ?>
          <?php _e("Catégorie :", "stormbringer"); ?> <span><?php single_cat_title(); ?></span>
      <?php } elseif (is_tag()) { ?>
          <?php _e("Mot-clé :", "stormbringer"); ?> <span><?php single_tag_title(); ?></span>
      <?php } elseif (is_tax()) { ?>
          <?php _e("Liste des articles :", "stormbringer"); ?> <span><?php single_cat_title(); ?></span>
      <?php } elseif (is_day()) { ?>
          <?php _e("Articles du jour :", "stormbringer"); ?> <span><?php the_time('l, F j, Y'); ?></span>
      <?php } elseif (is_month()) { ?>
          <?php _e("Articles du mois :", "stormbringer"); ?> <span><?php the_time('F Y'); ?></span>
      <?php } elseif (is_year()) { ?>
          <span><?php _e("Articles de l'année :", "stormbringer"); ?> <?php the_time('Y'); ?></span>
      <?php } elseif (is_author()) { ?>
          <?php _e("Articles rédigés par :", "stormbringer");?><?php the_post();?> <span class="vcard"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) );?>" title="<?php echo esc_attr( get_the_author() );?>" rel="me"><?php echo get_the_author();?></a>
      <?php rewind_posts(); } elseif (is_post_type_archive()) { ?>
          <span><?php post_type_archive_title(); ?></span>
      <?php } ?>
    </h1>

    <?php
    /* Author or Taxonomy description template */
    if(is_category() || is_tag())
      get_template_part( 'archive', 'taxonomy');
    if(is_author())
      get_template_part( 'archive', 'author');
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

<?php get_sidebar('blog'); ?>

<?php get_footer(); ?>