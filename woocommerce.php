<?php
/**
 * The template for displaying Woocommerce.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>
<?php get_header(); ?>

<?php get_sidebar('shop'); ?>

	<div id="content" role="main">

		<?php if ( function_exists('yoast_breadcrumb') ) :  yoast_breadcrumb(); endif; ?>

		<?php woocommerce_content(); ?>

	</div>
	<!-- /#content -->

<?php get_footer(); ?>