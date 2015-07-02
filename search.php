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

		<?php if ( function_exists('yoast_breadcrumb') ) :  yoast_breadcrumb(); endif; ?>

		<header class="page-header search-header">
			<h1 class="page-title search-title">
				<span><?php printf( __( 'Search results: %s', 'stormbringer' ), '</span>' . get_search_query() . '' ); ?>
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

	</div>
	<!-- /#content -->

<?php get_sidebar( 'blog' ); ?>

<?php get_footer(); ?>