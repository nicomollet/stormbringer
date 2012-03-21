<?php get_header(); ?>

<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">

  <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">

    <?php if(BREADCRUMB_ACTIVE)breadcrumb_trail();?>

    <?php if (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

      <header class="entry-header page-header">
        <?php
        // only show edit button if user has permission to edit posts
        if( $user_level > 0 ) {
        ?>
        <a href="<?php echo get_edit_post_link(); ?>" class="btn btn-success edit-post pull-right"><i class="icon-pencil icon-white"></i> <?php _e("Edit post","bonestheme"); ?></a>
        <?php } ?>
        <h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>

      </header>

      <section class="entry-content">

        <div class="entry-attachment">
          <div class="attachment">
            <?php
              /**
               * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
               * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
               */
              $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
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
            echo wp_get_attachment_image( $post->ID ); // filterable image width with, essentially, no limit for image height.
            ?></a>
          </div><!-- .attachment -->

          <?php if ( ! empty( $post->post_excerpt ) ) : ?>
            <div class="entry-caption">
              <dl>
                <?php
                $imgmeta = wp_get_attachment_metadata( $post->ID );
                if($imgmeta['image_meta']['shutter_speed']) :
                  // Convert the shutter speed retrieve from database to fraction
                  if ((1 / $imgmeta['image_meta']['shutter_speed']) > 1) {
                    if ((number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1)) == 1.3
                        or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 1.5
                        or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 1.6
                        or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 2.5
                    ) {
                      $pshutter = "1/" . number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1, '.', '') . " second";
                    }
                    else {
                      $pshutter = "1/" . number_format((1 / $imgmeta['image_meta']['shutter_speed']), 0, '.', '') . " second";
                    }
                  }
                  else{
                    $pshutter = $imgmeta['image_meta']['shutter_speed'] . " seconds";
                  }
                endif;
                if($imgmeta['image_meta']['created_timestamp'])
                    printf( '<dt>%s</dt><dd>%s</dd>', __( 'Date Taken:', 'twentyeleven' ), date("d-M-Y H:i:s", $imgmeta['image_meta']['created_timestamp']));
                if($imgmeta['image_meta']['created_timestamp'])
                    printf( '<dt>%s</dt><dd>%s</dd>', __( 'Credit:', 'twentyeleven' ), $imgmeta['image_meta']['credit']);
                if($imgmeta['image_meta']['created_timestamp'])
                    printf( '<dt>%s</dt><dd>%s</dd>', __( 'Copyright:', 'twentyeleven' ), $imgmeta['image_meta']['copyright']);
                if($imgmeta['image_meta']['created_timestamp'])
                    printf( '<dt>%s</dt><dd>%s</dd>', __( 'Title:', 'twentyeleven' ), $imgmeta['image_meta']['title']);
                if($imgmeta['image_meta']['created_timestamp'])
                    printf( '<dt>%s</dt><dd>%s</dd>', __( 'Caption:', 'twentyeleven' ), $imgmeta['image_meta']['caption']);
                if($imgmeta['image_meta']['created_timestamp'])
                    printf( '<dt>%s</dt><dd>%s</dd>', __( 'Camera:', 'twentyeleven' ), $imgmeta['image_meta']['camera']);
                if($imgmeta['image_meta']['created_timestamp'])
                    printf( '<dt>%s</dt><dd>%s</dd>', __( 'Focal Length:', 'twentyeleven' ), $imgmeta['image_meta']['focal_length']);
                if($imgmeta['image_meta']['created_timestamp'])
                    printf( '<dt>%s</dt><dd>%s</dd>', __( 'Aperture:', 'twentyeleven' ), $imgmeta['image_meta']['aperture']);
                if($imgmeta['image_meta']['created_timestamp'])
                    printf( '<dt>%s</dt><dd>%s</dd>', __( 'ISO:', 'twentyeleven' ), $imgmeta['image_meta']['iso']);
                if($imgmeta['image_meta']['created_timestamp'])
                    printf( '<dt>%s</dt><dd>%s</dd>', __( 'Shutter Speed:', 'twentyeleven' ), $pshutter);

                ?>
              </dl>
              <?php the_excerpt(); ?>
            </div>
          <?php endif; ?>
        </div><!-- .entry-attachment -->

        <?php the_content(); ?>

      </section><!-- .entry-content -->

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

