<?php
/**
 * The template for displaying the Loop Content.
 *
 * @package StormBringer
 * @since StormBringer 0.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(""); ?>>

  <?php // only show edit button if user has permission to edit posts
  global $user_level;
  if ($user_level > 0) $edit_link = '<a href="'.get_edit_post_link(get_the_ID()).'" class="btn btn-success edit-post pull-right"><i class="icon-pencil icon-white"></i> '.__("Modifier", "stormbringer").'</a>';
  ?>
    <?php  if ( is_single() || is_page() || is_singular() ) { ?>
      <header class="page-header">
        <?php echo $edit_link;?>
        <h1 class="page-title"><?php the_title(); ?></h1>
      </header>
    <?php } else { ?>
      <header class="entry-header">
        <?php echo $edit_link;?>
        <h2 class="entry-title"><a class="entry-title" title="<?php printf( esc_attr__( 'Lien vers %s', 'stormbringer' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </header>
  <?php } ?>
  <!-- /.entry-header -->

  <?php if(is_singular('post') || is_category() || is_tag() || is_archive()):?>
    <footer class="entry-meta">

      <p class="entry-date">
        <i class="icon-calendar"></i> <time datetime="<?php echo the_time('Y-m-d'); ?>"><?php _e("Le", "stormbringer"); ?> <?php echo get_the_date( ); ?></time>
      </p>
      <p class="entry-author">
        <i class="icon-user"></i> <?php _e("Par", "stormbringer"); ?> <?php the_author_posts_link(); ?>
      </p>

      <?php if (comments_open() && !is_page()) : ?>
        <p class="comments-link">
            <?php comments_popup_link('<span class="leave-reply"><i class="icon-comment"></i> ' . __('Laisser un commentaire', 'stormbringer') . '</span>', _x('<i class="icon-comment"></i> 1 commentaire', 'comments number', 'stormbringer'), _x('<i class="icon-comment"></i> % commentaires', 'comments number', 'stormbringer')); ?>
        </p>
      <?php endif; // End if comments_open() ?>

      <?php
      $categories_list = get_the_category_list(__(', ','stormbringer'));
      if ($categories_list): ?>
        <p class="entry-categories">
          <?php if ($categories_list) printf(__('<span class="%1$s"><i class="icon-book"></i> Catégories&nbsp;:</span> %2$s', 'stormbringer'), 'intro', $categories_list);?>
        </p>
      <?php endif; // End if categories ?>

      <?php
      $tags_list = get_the_tag_list('', __(', ','stormbringer'));
      if ($tags_list): ?>
        <p class="entry-tags">
          <?php printf(__('<span class="%1$s"><i class="icon-tags"></i> Mots clés&nbsp;:</span> %2$s', 'stormbringer'), 'intro', $tags_list);            ?>
        </p>
      <?php endif; // End if $tags_list ?>


    </footer>

  <?php endif;?>
  <!-- /.entry-meta -->

  <section class="entry-content">
    <?php do_action( 'stormbringer_content_before' ); ?>
    <?php the_post_thumbnail('medium'); ?>
    <?php if (is_archive() || is_search()) { ?>
      <?php echo get_the_excerpt(); ?>
    <?php } else { ?>
      <?php the_content(); ?>
    <?php } ?>
    <?php do_action( 'stormbringer_content_after' ); ?>
  </section>
  <!-- /.entry-content -->

</article>
<!-- /#post -->
    
