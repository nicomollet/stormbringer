<?php
/*
Template Name: Sitemap
*/
?>
<?php get_header(); ?>

  <aside id="sidebar" class="<?php echo apply_filters('stormbringer_sidebar_container_class', 'span3'); ?>" role="complementary">
    <?php get_sidebar(); ?>
  </aside>
  <!-- /#sidebar -->

  <div id="content" class="<?php echo apply_filters('stormbringer_content_container_class', 'span9');?>" role="main">

    <?php stormbringer_breadcrumb();?>

    <?php if (have_posts()) : the_post(); ?>
      <?php $format = get_post_format();
        if ( false === $format )
        $format = 'standard';
        get_template_part( 'content', 'page' );
      ?>

      <!-- .sitemap-content -->
      <section class="sitemap-content">
        <div class="row-fluid">
          <div class="span6" >
            <h3><?php _e('Pages', 'stormbringer') ?></h3>
            <ul>
              <?php wp_list_pages('depth=0&sort_column=menu_order&title_li='); ?>
            </ul>
          </div>

          <div class="span6">
            <h3><?php _e('Solutions', 'stormbringer') ?></h3>
            <ul>
              <?php
                $args = array('numberposts' => -1, 'post_type' => 'solution', 'orderby' => 'post_title', 'order' => 'ASC', 'suppress_filters'=>0);
                $clients = get_posts($args);
                $i = 0;
                if($clients) {
                  foreach ($clients as $post) :
                    setup_postdata($post);
                    ?>
                    <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
                    <?php
                  endforeach;
                }
              ?>
            </ul>
            <h3><?php _e('Clients', 'stormbringer') ?></h3>
            <ul>
              <?php
                $args = array('numberposts' => -1, 'post_type' => 'client', 'orderby' => 'post_title', 'order' => 'ASC', 'suppress_filters'=>0);
                $clients = get_posts($args);
                $i = 0;
                if($clients) {
                  foreach ($clients as $post) :
                    setup_postdata($post);
                    ?>
                    <li><a href="<?php the_permalink();?>" class="fancybox-frame"><?php the_title();?></a></li>
                    <?php
                  endforeach;
                }
              ?>
            </ul>
            <h3><?php _e('Partenaires', 'stormbringer') ?></h3>
            <ul>
              <?php
                $args = array('numberposts' => -1, 'post_type' => 'partner', 'orderby' => 'post_title', 'order' => 'ASC', 'suppress_filters'=>0);
                $clients = get_posts($args);
                $i = 0;
                if($clients) {
                  foreach ($clients as $post) :
                    setup_postdata($post);
                    ?>
                    <li><a href="<?php the_permalink();?>" class="fancybox-frame"><?php the_title();?></a></li>
                    <?php
                  endforeach;
                }
              ?>
            </ul>
          </div>
        </div>
      </section>
      <!-- /.sitemap-content -->

    <?php endif;?>

  </div>
  <!-- /#content -->

<?php get_footer(); ?>