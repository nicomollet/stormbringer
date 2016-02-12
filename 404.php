<?php
/**
 * The template for displaying 404 Error page.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>
<?php get_header(); ?>

<?php //get_sidebar(); ?>

<div id="content" role="main">

	<?php if ( function_exists( 'yoast_breadcrumb' ) ) : yoast_breadcrumb(); endif; ?>

	<?php
	get_template_part( 'content', 'none' );
	?>

</div>
<!-- /#content -->

<?php get_footer(); ?>
