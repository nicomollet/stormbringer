<?php
/**
 * The template for displaying Archive pages.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>
<?php get_header(); ?>

	<div id="content" role="main">

		<?php if ( function_exists( 'yoast_breadcrumb' ) ) : yoast_breadcrumb(); endif; ?>

		<header class="page-header archive-header">

			<?php
			the_archive_title( '<h1 class="page-title archive-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>

			<?php
			// Category feed
			if ( is_category() ) {
				$category = get_the_category();
				echo '<a href="' . get_category_feed_link( $category[0]->term_id ) . '" class="taxonomy-feed">' . __( "Feed", 'stormbringer' ) . '</a>';
			}
			?>

			<?php
			// Author vcard
			if ( is_author() ) {
			$queried_object = get_queried_object();
			?>
			<?php _e( 'Posts by:', 'stormbringer' ); ?>
			<span class="vcard"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>" rel="me"><?php echo get_the_author(); ?></a>
				<?php } ?>

		</header>

		<?php if ( have_posts() ) : ?>

			<div class="row">
				<?php
				while ( have_posts() ) : the_post(); ?>

					<?= bootstrap_clearfix( $counter_posts, [
						'xs' => 12,
						'sm' => 6,
						'md' => 4,
						'lg' => 3
					] ) ?>

					<div class="col-sm-6 col-md-4 col-lg-3">
						<?php
						$type = get_post_type();
						get_template_part( 'content', $type );
						?>
					</div>

				<?php endwhile; ?>
			</div>

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