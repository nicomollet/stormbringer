<?php
/**
 * The template for displaying the Header.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>
<!doctype html>
<!--[if IEMobile 7 ]>
<html <?php language_attributes(); ?> class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]>
<html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>
<html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>
<html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js wf-start">
<!--<![endif]-->

<head>
<meta charset="utf-8">

<?php wp_head(); ?>

<?php
// Check current user
global $current_user;
global $user_level;
wp_get_current_user();
?>
</head>

<body <?php body_class(''); ?>>
<?php
// Google Tag Manager for WordPress
if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); }
?>

<!--[if lt IE 7]>
<p id="browsernotsupported" class="alert"><?php _e('You are using an outdated browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'stormbringer');?></p>
<![endif]-->

<div id="wrapper">

	<?php do_action( 'stormbringer_header_before' ); ?>

	<div class="header-above-wrapper">

		<header role="contentinfo" id="header-above" itemscope="itemscope">
			<div class="header-above-inner">

	            <?php

	            if (is_active_sidebar('header-above-4')) {
	                $widget_columns = apply_filters('stormbringer_header_above_widget_regions', 4);
	            } elseif (is_active_sidebar('header-above-3')) {
	                $widget_columns = apply_filters('stormbringer_header_above_widget_regions', 3);
	            } elseif (is_active_sidebar('header-above-2')) {
	                $widget_columns = apply_filters('stormbringer_header_above_widget_regions', 2);
	            } elseif (is_active_sidebar('header-above-1')) {
	                $widget_columns = apply_filters('stormbringer_header_above_widget_regions', 1);
	            } else {
	                $widget_columns = apply_filters('stormbringer_header_above_widget_regions', 0);
	            }

	            if ($widget_columns > 0) : ?>


	                <?php
	                $i = 0;
	                while ($i < $widget_columns) : $i++;
	                    if (is_active_sidebar('header-above-'.$i)) : ?>

	                        <?php dynamic_sidebar('header-above-'.intval($i)); ?>

	                    <?php endif;
	                endwhile; ?>


	            <?php endif;
	            ?>

			</div>
		</header>
	</div>
	<!-- /.header-above-wrapper -->

	<div class="header-wrapper">

		<header role="contentinfo" id="header" itemscope="itemscope">
			<div class="header-inner">

	            <?php

	            if (is_active_sidebar('header-4')) {
	                $widget_columns = apply_filters('stormbringer_header_widget_regions', 4);
	            } elseif (is_active_sidebar('header-3')) {
	                $widget_columns = apply_filters('stormbringer_header_widget_regions', 3);
	            } elseif (is_active_sidebar('header-2')) {
	                $widget_columns = apply_filters('stormbringer_header_widget_regions', 2);
	            } elseif (is_active_sidebar('header-1')) {
	                $widget_columns = apply_filters('stormbringer_header_widget_regions', 1);
	            } else {
	                $widget_columns = apply_filters('stormbringer_header_widget_regions', 0);
	            }

	            if ($widget_columns > 0) : ?>


	                <?php
	                $i = 0;
	                while ($i < $widget_columns) : $i++;
	                    if (is_active_sidebar('header-'.$i)) : ?>

	                        <?php dynamic_sidebar('header-'.intval($i)); ?>

	                    <?php endif;
	                endwhile; ?>


	            <?php endif;
	            ?>

			</div>
		</header>
	</div>
	<!-- /.header-wrapper -->

	<div class="header-below-wrapper">

		<header role="contentinfo" id="header-below" itemscope="itemscope">
			<div class="header-below-inner">

	            <?php

	            if (is_active_sidebar('header-below-4')) {
	                $widget_columns = apply_filters('stormbringer_header_below_widget_regions', 4);
	            } elseif (is_active_sidebar('header-below-3')) {
	                $widget_columns = apply_filters('stormbringer_header_below_widget_regions', 3);
	            } elseif (is_active_sidebar('header-below-2')) {
	                $widget_columns = apply_filters('stormbringer_header_below_widget_regions', 2);
	            } elseif (is_active_sidebar('header-below-1')) {
	                $widget_columns = apply_filters('stormbringer_header_below_widget_regions', 1);
	            } else {
	                $widget_columns = apply_filters('stormbringer_header_below_widget_regions', 0);
	            }

	            if ($widget_columns > 0) : ?>


	                <?php
	                $i = 0;
	                while ($i < $widget_columns) : $i++;
	                    if (is_active_sidebar('header-below-'.$i)) : ?>

	                        <?php dynamic_sidebar('header-below-'.intval($i)); ?>

	                    <?php endif;
	                endwhile; ?>


	            <?php endif;
	            ?>

			</div>
		</header>
	</div>
	<!-- /.header-below-wrapper -->

	<?php do_action( 'stormbringer_header_after' ); ?>

	<div class="main-wrapper">
	<div id="main">
	  <div class="main-inner">