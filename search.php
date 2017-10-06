<?php
/**
 * The template for displaying Search pages.
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

		<header class="page-header search-header">
			<h1 class="page-title search-title">
				<?php printf( __( 'Search results: %s', 'stormbringer' ), '<span>' . get_search_query() . '</span>' ); ?>
			</h1>
		</header>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php the_posts_pagination(); ?>

		<?php else : ?>

			<?php
			/* No results */
			get_template_part( 'content', 'none' );
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