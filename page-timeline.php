<?php
/*
Template Name: Timeline
*/
?>
<?php get_header(); ?>

<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">

  <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">

    <?php if (BREADCRUMB_ACTIVE) breadcrumb_trail();?>

    <?php if (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

      <header class="entry-header page-header">
        <?php // only show edit button if user has permission to edit posts
        if ($user_level > 0) {?>
          <a href="<?php echo get_edit_post_link(); ?>" class="btn btn-success edit-post pull-right"><i class="icon-pencil icon-white"></i> <?php _e("Edit post", "bonestheme"); ?></a>
        <?php } ?>
        <h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
      </header>
      <!-- /.entry-header -->

      <section class="entry-content">
        <?php the_content(); ?>
      </section>

      <section class="timeline-content">

          <?php query_posts('posts_per_page=-1');
            $dates_array 			= Array();
            $year_array 			= Array();
            $i 				= 0;
            $prev_post_ts    		= null;
            $prev_post_year  		= null;
            $distance_multiplier 	        =  9;
          ?>

                <?php while (have_posts()) : the_post();

                  $post_ts    =  strtotime($post->post_date);
                  $post_year  =  date( 'Y', $post_ts );

                  /* Handle the first year as a special case */
                  if ( is_null( $prev_post_year ) ) {
                    ?>
                    <h3 class="archive-year"><?php echo $post_year?></h3>
                    <ul class="archives-list">
                    <?php
                  }
                  else if ( $prev_post_year != $post_year ) {
                    /* Close off the OL */
                    ?>
                    </ul>
                    <?php

                    $working_year  =  $prev_post_year;

                    /* Print year headings until we reach the post year */
                    while ( $working_year > $post_year ) {
                      $working_year--;
                      ?>
                      <h3 class="archive-year"><?php echo $working_year?></h3>
                      <?php
                    }

                    /* Open a new ordered list */
                    ?>
                    <ul class="archives-list">
                    <?php
                  }

                  /* Compute difference in days */
                  if ( ! is_null( $prev_post_ts ) && $prev_post_year == $post_year ) {
                    $dates_diff  =  ( date( 'z', $prev_post_ts ) - date( 'z', $post_ts ) ) * $distance_multiplier;
                  }
                  else {
                    $dates_diff  =  0;
                  }
                ?>
                  <li><span class="date"><?php the_time('F j'); ?><sup><?php the_time('S') ?></sup></span> <span class="linked"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></span>
                    <?php if (get_comments_number()!=0):?>
                      <span class="badge"><?php comments_popup_link(__('', 'woothemes'), __('1', 'woothemes'), __('%', 'woothemes')); ?></span>
                    <?php endif;?>
                  </li>
                <?php
                  /* For subsequent iterations */
                  $prev_post_ts    =  $post_ts;
                  $prev_post_year  =  $post_year;
                endwhile;

                /* If we've processed at least *one* post, close the ordered list */
                if ( ! is_null( $prev_post_ts ) ) {
                  ?>
                </ul>
                <?php } ?>







      </section>


    </article>

    <?php comments_template(); ?>


    <?php else : ?>

    <article id="post-not-found">
      <header>
        <h1><?php _e("No Posts Yet", "bonestheme"); ?></h1>
      </header>
      <section class="entry-content">
        <p><?php _e("Sorry, What you were looking for is not here.", "bonestheme"); ?></p>
      </section>
      <footer>
      </footer>
    </article>

    <?php endif; ?>

  </div>
  <!-- /#main -->

  <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
    <?php get_sidebar(); ?>
  </aside>
  <!-- /#sidebar -->

</div><!-- /#content -->

<?php get_footer(); ?>