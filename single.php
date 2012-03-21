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
      <!-- /.entry-content -->
      
      <footer class="entry-meta">

        <?php if (comments_open()) : ?>
          <p class="comments-link">
              <?php comments_popup_link('<span class="leave-reply"><i class="icon-comment"></i> ' . __('Reply', 'twentyeleven') . '</span>', _x('<i class="icon-comment"></i> 1 comment', 'comments number', 'twentyeleven'), _x('<i class="icon-comment"></i> % commentaires', 'comments number', 'twentyeleven')); ?>
          </p>
        <?php endif; // End if comments_open() ?>

        <?php
        $categories_list = get_the_category_list(__(', '));
        if ($categories_list): ?>
          <p class="entry-categories">
            <?php if ($categories_list) printf(__('<span class="%1$s"><i class="icon-book"></i> Catégories&nbsp;:</span> %2$s', 'stormbringer'), 'intro', $categories_list);?>
          </p>
        <?php endif; // End if categories ?>

        <?php
        $tags_list = get_the_tag_list('', __(', '));
        if ($tags_list): ?>
          <p class="entry-tags">
            <?php printf(__('<span class="%1$s"><i class="icon-tags"></i> Mots clés&nbsp;:</span> %2$s', 'stormbringer'), 'intro', $tags_list);            ?>
          </p>
        <?php endif; // End if $tags_list ?>

      </footer>
      <!-- /.entry-meta -->
      
    </article>
    <!-- /#post -->

    <?php comments_template(); ?>

    <?php else : ?>

    <article id="post-not-found">
      <header class="entry-header page-header">
        <h1 class="entry-title"><?php _e("No Posts Yet", "bonestheme"); ?></h1>
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