<?php
/**
 * The template for displaying the Loop Content.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>

<article id="attachment-<?php the_ID(); ?>" <?php post_class(""); ?>>

  <?php // only show edit button if user has permission to edit posts
  global $user_level;
  if ($user_level > 0) $edit_link = '<a href="'.get_edit_post_link(get_the_ID()).'" class="btn btn-success edit-post pull-right"><i class="glyphicon glyphicon-pencil"></i> '.__("Edit", "stormbringer").'</a>';
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

  <footer class="entry-meta">

    <p class="entry-date">
      <i class="glyphicon glyphicon-calendar"></i> <time datetime="<?php echo the_time('Y-m-d'); ?>"><?php echo get_the_date( ); ?></time>
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
    $metadata = wp_get_attachment_metadata();
    if ($metadata['width'] && $metadata['height']): ?>
      <p class="entry-size">
        <?php printf(__('<span class="%1$s"><span class="glyphicon glyphicon-picture"></span> Size:</span> %2$s &times; %3$s', 'stormbringer'), 'intro', $metadata['width'],$metadata['height']);?>
      </p>
    <?php endif; // End if $metadata ?>

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
  <!-- /.entry-meta -->

  <section class="entry-content">

    <div class="entry-attachment">
      <?php
      $imgmeta = wp_get_attachment_metadata( $post->ID );
      /**
       * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
       * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
       */
      $k=0;
      $attachments = array_values( get_children( array(
        'post_parent'    => $post->post_parent,
        'post_status'    => 'inherit',
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'order'          => 'ASC',
        'orderby'        => 'menu_order ID'
      ) ) );
      foreach ( $attachments as $k => $attachment ) {
        if ( $attachment->ID == $post->ID )
          break;
      }
      $k++;
      // If there is more than 1 attachment in a gallery
      if ( count( $attachments ) > 1 ) {
        if ( isset( $attachments[ $k ] ) )
          // get the URL of the next image attachment
          $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
        else
          // or get the URL of the first image attachment
          $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
      } else {
        // or, if there's only 1 image, get the URL of the image
        $next_attachment_url = wp_get_attachment_url();
      }
      ?>

      <a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
        $attachment_size = apply_filters( 'stormbringer_attachment_size', array( 800, 800 ) ); // filterable image width with, essentially, no limit for image height.
        echo wp_get_attachment_image( $post->ID, $attachment_size );
        ?></a>
    </div><!-- .entry-attachment -->

    <?php if ( ! empty( $post->post_excerpt ) ) : ?>
    <div class="entry-caption">
      <?php the_excerpt(); ?>
    </div>
    <?php endif; ?>

  </section>
  <!-- /.entry-content -->

</article>
<!-- /#post -->
    
