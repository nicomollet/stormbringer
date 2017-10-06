<?php
/**
 * The template for displaying a page.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 *
 * Template Name: Sitemap
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

			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
				'after'  => '</div>',
			) );
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