<?php
/**
 * The template for displaying a full width page and no title.
 *
 * @package StormBringer
 * @since StormBringer 0.2.7
 *
 * Template Name: PageFullWidthNoTitle
 * Template Post Type: post, page, product
 */
?>
<?php get_header(); ?>

<?php //get_sidebar(); ?>

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
			get_template_part( 'content', 'page' );
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

<?php get_footer(); ?>