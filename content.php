<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) { ?>
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
  <?php get_search_form(); ?>
<?php } ?>

<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(""); ?>>

  <header class="entry-header">
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p class="entry-date"><?php _e("Posted", "bonestheme"); ?>
      <time datetime="<?php echo the_time('Y-m-j'); ?>"><?php the_time("F j, Y"); ?></time> <?php _e("by", "bonestheme"); ?> <?php the_author_posts_link(); ?>
    </p>
  </header>
  <!-- /.entry-header -->

  <section class="entry-content">
    <?php the_post_thumbnail('medium'); ?>
    <?php if (is_archive() || is_search()) { ?>
    <?php the_excerpt(); ?>
    <?php } else { ?>
    <?php the_content(); ?>
    <?php } ?>
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
    
<?php endwhile; /* End loop */ ?>

<?php if (function_exists('stormbringer_pagination')) { // if expirimental feature is active ?>
  <?php page_navi(); // use the page navi function ?>
<?php } else { // if it is disabled, display regular wp prev & next links ?>
  <nav class="wp-prev-next">
    <ul class="clearfix">
      <li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "stormbringer")) ?></li>
      <li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "stormbringer")) ?></li>
    </ul>
  </nav>
<?php } ?>