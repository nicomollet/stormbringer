<?php
/**
 * The template for displaying a Login Form.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 *
 * Template Name: Login Form
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
  $defaults = array(
    'title' => esc_attr__( 'Log In', 'alienship' ),
    'label_username' => esc_attr__( 'Username', 'alienship' ),
    'label_password' => esc_attr__( 'Password', 'alienship' ),
    'label_log_in' => esc_attr__( 'Log In', 'alienship' ),
    'label_remember' => esc_attr__('Remember Me', 'alienship' ),
    'form_class' => 'form-placeholder',
    'id_submit' => 'wp-submit',
    'remember' => true,
    'show_avatar' => false,
    'logged_out_text' => esc_html__( 'Please log into the site.', 'alienship' ),
    'logged_in_text' => esc_html__( 'Logged in as', 'alienship' )
  );
  the_widget('alienship_Widget_Login', $defaults);
  ?>

</div>
<!-- /#content -->

<?php get_footer(); ?>