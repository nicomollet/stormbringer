<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * @package StormBringer
 * @since StormBringer 0.1.6
 * @version StormBringer 0.1.6
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


get_header( 'shop' ); ?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

	<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

<?php endif; ?>

<?php do_action( 'woocommerce_archive_description' ); ?>

<?php if ( have_posts() ) :
	ob_start();

	do_action( 'woocommerce_before_shop_loop' );
	do_action( 'shop_loop' );
	do_action( 'woocommerce_after_shop_loop' );

	echo '<div class="woocommerce">' . ob_get_clean() . '</div>';

elseif ( ! woocommerce_product_subcategories( array(
	'before' => woocommerce_product_loop_start( false ),
	'after'  => woocommerce_product_loop_end( false )
) )
) : ?>

	<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

<?php endif; ?>

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php do_action( 'woocommerce_sidebar' ); ?>

<?php get_footer( 'shop' ); ?>
