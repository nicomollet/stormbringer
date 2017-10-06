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

		<?php
		/**
		 * stormbringer_content_before hook.
		 *
		 * @hooked stormbringer_breadcrumb - 10
		 */
		do_action( 'stormbringer_content_before' );
		?>

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

		<?php
		/**
		 * stormbringer_content_after hook.
		 */
		do_action( 'stormbringer_content_after' );
		?>

	</div>
	<!-- /#content -->

<?php //get_sidebar( 'blog' ); ?>

<?php get_footer(); ?>