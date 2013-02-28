<?php
/**
 * The template for displaying Archive pages.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>
<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="content" class="<?php echo apply_filters('stormbringer_content_container_class', 'span9');?>" role="main">

  <?php stormbringer_breadcrumb();?>

  <?php if (have_posts()) : the_post(); ?>
    <?php $format = get_post_format();
      if ( false === $format )
      $format = 'standard';
      get_template_part( 'content', 'page' );
    ?>
  <?php endif;?>

  <?php
$pod = pods( 'mainpod' );
echo $pod->filters( array( 'fields' => array( 'my_filter'), 'label' => 'Go' ) );
$pod->find();

echo '<ul>';
while ( $pod->fetch() ) {
  echo "<li>" . $pod->display( 'name' ) . ' ('.$pod->display( 'my_filter' ) .')</li>';
}
echo '</ul>';
echo $pod->pagination();
  ?>

</div>
<!-- /#content -->

<?php get_footer(); ?>