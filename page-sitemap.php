<?php
/*
Template Name: Sitemap
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

      <section class="sitemap-content">
        <div class="row-fluid">
          <div class="span6" >
            <h3><?php _e('Pages', 'woothemes') ?></h3>
            <ul>
              <?php wp_list_pages('depth=0&sort_column=menu_order&title_li='); ?>
            </ul>
          </div>

          <div class="span6">
            <h3><?php _e('Categories', 'woothemes') ?></h3>
            <ul>
              <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>
            </ul>
          </div>
        </div>
        <div class="row-fluid">
          <div class="span12">
            <h3><?php _e('Posts per category', 'woothemes'); ?></h3>
            <?php

            $cats = get_categories();
            foreach ($cats as $cat) {

              query_posts('cat=' . $cat->cat_ID);

              ?>

              <h4><?php echo $cat->cat_name; ?></h4>
              <ul>
                <?php while (have_posts()) : the_post(); ?>
                <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                    <?php if (get_comments_number()!=0):?>
                      <span class="badge"><?php comments_popup_link(__('', 'woothemes'), __('1', 'woothemes'), __('%', 'woothemes')); ?></span>
                    <?php endif;?>

                </li>
                <?php endwhile;  ?>
              </ul>

            <?php } ?>
          </div>
        </div>



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