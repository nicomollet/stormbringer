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

	<?php
	/**
	 * stormbringer_content_before hook.
	 *
	 * @hooked stormbringer_breadcrumb - 10
	 */
	do_action( 'stormbringer_content_before' );
	?>

	<?php
	get_template_part( 'content', 'none' );
	?>

	<?php
	/**
	 * stormbringer_content_after hook.
	 */
	do_action( 'stormbringer_content_after' );
	?>


</div>
<!-- /#content -->

<?php get_footer(); ?>
