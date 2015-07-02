<?php
/**
 * The template for displaying all single posts.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>
<?php get_header(); ?>

	<div id="content" role="main">

		<?php if ( function_exists( 'yoast_breadcrumb' ) ) :  yoast_breadcrumb(); endif; ?>

		<?php if ( have_posts() ) : the_post(); ?>

			<?php
			$type = get_post_type();
			get_template_part( 'content', $type );
			?>

			<?php if ( ! is_attachment() ) {
				get_template_part( 'archive', 'author' );
			} ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || 0 != get_comments_number() ) {
				comments_template( '', true );
			}
			?>

		<?php endif; ?>

	</div>
	<!-- /#content -->

<?php get_sidebar( 'blog' ); ?>

<?php get_footer(); ?>