<?php get_header(); ?>

<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">

  <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">

    <?php if (BREADCRUMB_ACTIVE) breadcrumb_trail();?>
    
    <div class="page-header">
      <?php if (is_category()) { ?>
        <h1 class="archive-title">
          <span><?php _e("Posts Categorized:", "bonestheme"); ?></span> <?php single_cat_title(); ?>
        </h1>
      <?php } elseif (is_tag()) { ?>
        <h1 class="archive-title">
          <span><?php _e("Posts Tagged:", "bonestheme"); ?></span> <?php single_tag_title(); ?>
        </h1>
      <?php } elseif (is_tax()) { ?>
        <h1 class="archive-title">
          <span><?php _e("Posts Categorized:", "bonestheme"); ?></span> <?php single_cat_title(); ?>
        </h1>
      <?php } elseif (is_author()) { ?>
        <h1 class="archive-title">
          <span><?php _e("Posts By:", "bonestheme"); ?></span> <?php get_the_author_meta('display_name'); ?>
        </h1>
      <?php } elseif (is_day()) { ?>
        <h1 class="archive-title">
          <span><?php _e("Daily Archives:", "bonestheme"); ?></span> <?php the_time('l, F j, Y'); ?>
        </h1>
      <?php } elseif (is_month()) { ?>
        <h1 class="archive-title">
          <span><?php _e("Monthly Archives:", "bonestheme"); ?></span> <?php the_time('F Y'); ?>
        </h1>
      <?php } elseif (is_year()) { ?>
        <h1 class="archive-title">
          <span><?php _e("Yearly Archives:", "bonestheme"); ?></span> <?php the_time('Y'); ?>
        </h1>
      <?php } elseif (is_post_type_archive()) { ?>
        <h1 class="archive-title h2">
          <?php post_type_archive_title(); ?>
        </h1>
      <?php } ?>
      <?php
        if ( is_category() ) {
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
    </div>

    <?php get_template_part('content', get_post_format()); ?>

  </div>
  <!-- end #main -->

  <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
    <?php get_sidebar(); ?>
  </aside><!-- /#sidebar -->


</div> <!-- end #content -->

<?php get_footer(); ?>