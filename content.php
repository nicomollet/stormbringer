<?php
/**
 * The template for displaying the Loop Content.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(""); ?>>

  <?php // only show edit button if user has permission to edit posts
  global $user_level;
  if ($user_level > 0) $edit_link = '<a href="'.get_edit_post_link(get_the_ID()).'" class="btn btn-success edit-post pull-right"><span class="glyphicon glyphicon-pencil"></span> '.__('Edit', 'stormbringer').'</a>';
  ?>
    <?php  if ( is_single() || is_page() || is_singular() ) { ?>
      <header class="page-header">
        <?php echo $edit_link;?>
        <h1 class="page-title"><?php the_title(); ?></h1>
      </header>
    <?php } else { ?>
      <header class="entry-header">
        <?php echo $edit_link;?>
        <h2 class="entry-title"><a class="entry-title" title="<?php printf( esc_attr__( 'Link to %s', 'stormbringer' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </header>
  <?php } ?>
  <!-- /.entry-header -->

  <?php if(is_singular() || is_category() || is_tag() || is_archive() || is_home()):?>
    <footer class="entry-meta">

      <p class="entry-date">
        <i class="glyphicon glyphicon-calendar"></i> <time datetime="<?php echo the_time('Y-m-d'); ?>"><?php echo get_the_date(esc_attr__( 'F j, Y', 'stormbringer' ) ); ?></time>
      </p>
      <p class="entry-author">
        <i class="glyphicon glyphicon-user"></i> <?php _e('By', 'stormbringer'); ?> <?php the_author_posts_link(); ?>
      </p>

	    <?php if (comments_open() && !is_page()) : ?>
		    <p class="comments-link">
			    <?php comments_popup_link('<span class="leave-reply"><span class="glyphicon glyphicon-comment"></span> ' . __('Leave a comment', 'stormbringer') . '</span>', '<span class="glyphicon glyphicon-comment"></span> '._x('1 comment', 'comments number', 'stormbringer'), '<span class="glyphicon glyphicon-comment"></span> '._x('% comments', 'comments number', 'stormbringer')); ?>
		    </p>
	    <?php endif; // End if comments_open() ?>

	    <?php
	    $categories_list = get_the_category_list(__(', ','stormbringer'));
	    if ($categories_list): ?>
		    <p class="entry-categories">
			    <?php printf(__('<span class="%1$s"><span class="glyphicon glyphicon-book"></span> Categories:</span> %2$s', 'stormbringer'), 'intro', $categories_list);?>
		    </p>
	    <?php endif; // End if $categories_list ?>

	    <?php
	    $tags_list = get_the_tag_list('', __(', ','stormbringer'));
	    if ($tags_list): ?>
		    <p class="entry-tags">
			    <?php printf(__('<span class="%1$s"><span class="glyphicon glyphicon-tags"></span> Tags:</span> %2$s', 'stormbringer'), 'intro', $tags_list);?>
		    </p>
	    <?php endif; // End if $tags_list ?>


    </footer>

  <?php endif;?>
  <!-- /.entry-meta -->

  <section class="entry-content">

    <?php the_post_thumbnail('medium'); ?>
    <?php if (is_archive() || is_search()) { ?>
      <?php echo get_the_excerpt(); ?>
    <?php } else { ?>
      <?php the_content(); ?>
	    <?php
	    // JetPack sharing
	    if ( function_exists( 'sharing_display' ) ) {
		    sharing_display( '', true );
	    }
	    ?>
    <?php } ?>

  </section>
  <!-- /.entry-content -->

</article>
<!-- /#post -->