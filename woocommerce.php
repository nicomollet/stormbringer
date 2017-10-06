<?php
/**
 * The template for displaying Woocommerce.
 *
 * @package StormBringer
 * @since   StormBringer 0.0.1
 */
?>
<?php get_header(); ?>

<?php get_sidebar('shop'); ?>

	<div id="content" role="main">

		<?php
		/**
		 * stormbringer_content_before hook.
		 *
		 * @hooked stormbringer_breadcrumb - 10
		 */
		do_action( 'stormbringer_content_before' );
		?>

		<?php woocommerce_content(); ?>

		<?php
		/**
		 * stormbringer_content_after hook.
		 */
		do_action( 'stormbringer_content_after' );
		?>

	</div>
	<!-- /#content -->

<?php get_footer(); ?>