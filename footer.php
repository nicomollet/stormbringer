<?php
/**
 * The template for displaying the Footer.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>

</div>
<!-- /.main-inner -->
</div>
<!-- /#main -->
</div>
<!-- /.main-wrapper -->


<nav id="navigation" role="navigation" class="navbar-stuckonscrolltop">

    <?php if (is_active_sidebar('navigation-above')) : ?>
		<div class="navigation-above">
            <?php dynamic_sidebar('navigation-above');?>
		</div>
    <?php endif; ?>

	<div class="navigation-inner clearfix">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation-collapse" aria-expanded="false" aria-controls="navigation-collapse">
				<span class="sr-only"><?php _e('Toggle navigation', 'stormbringer'); ?></span>
				<span class="button-label"><?php _e('Menu', 'stormbringer'); ?></span>
				<div class="button-bars">

					<span class="icon-bar top-bar"></span>
					<span class="icon-bar middle-bar"></span>
					<span class="icon-bar bottom-bar"></span>
				</div>
			</button>
			<a class="navbar-brand" title="<?php echo esc_attr(get_bloginfo('description')); ?>" href="<?php echo home_url(); ?>">
                <?php bloginfo( 'name' ); ?>
			</a>
		</div>

		<div class="collapse navbar-collapse" id="navigation-collapse">
            <?php wp_nav_menu( array(
                'theme_location'=> 'main_nav',
                'depth' => 2,
                'container' => false,
                'menu_class' => 'nav navbar-nav',
                'walker' => new stormbringer_Navbar_Nav_Walker(),
                'fallback_cb' => false,
            ) ); ?>

            <?php // Theme My Login menu
            if (class_exists( 'Theme_My_Login')) : $current_user=wp_get_current_user(); ?>
				<ul class="nav navbar-nav navbar-right navbar-account">
                    <?php $args=array( 'numberposts'=> '-1', 'post_type' => 'page', 'meta_key' => '_tml_action', 'meta_value' => array( 'register', 'login', 'lostpassword', 'resetpass', 'logout', 'profile', ), ); $get_tml_actions_posts = get_posts($args); foreach ($get_tml_actions_posts as $post) { $action = get_post_meta($post->ID, '_tml_action', true); $link[$action] = get_permalink($post->ID); $title[$action] = $post->post_title; } if (0 == $current_user->ID) : // logged out ?>
						<li>
							<a href="<?php echo $link['login']; ?>">
                                <?php echo $title[ 'login']; ?>
							</a>
						</li>
						<li>
							<a href="<?php echo $link['register']; ?>">
                                <?php echo $title[ 'register']; ?>
							</a>
						</li>
                    <?php else : // logged in ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $current_user->user_login; ?>
								<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="<?php echo $link['profile']; ?>">
                                        <?php echo $title[ 'profile']; ?>
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?php echo $link['logout']; ?>">
                                        <?php echo $title[ 'logout']; ?>
									</a>
								</li>
							</ul>
						</li>
                    <?php endif; ?>
				</ul>
            <?php endif; ?>

            <?php // Woocommerce shopping cart
            if (current_theme_supports( 'woocommerce')) : ?>
	            <ul class="nav navbar-nav navbar-right navbar-shoppingcart site-header-cart menu">
		            <li class="<?php echo esc_attr( $class ); ?>">
			            <a class="cart-contents" href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" title="<?php esc_attr_e(
                            'View your shopping cart', 'stormbringer'
                        ); ?>">
				            <span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span>
				            <span class="count"><?php echo wp_kses_data(
                                    sprintf(
                                        _n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'stormbringer'),
                                        WC()->cart->get_cart_contents_count()
                                    )
                                ); ?></span>
			            </a>
		            </li>
		            <li>
                        <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
		            </li>
	            </ul>
            <?php endif; ?>



		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.navigation-inner -->

    <?php if (is_active_sidebar('navigation-below')) : ?>
	    <div class="navigation-below">
			<?php dynamic_sidebar('navigation-below');?>
	    </div>
	<?php endif; ?>

</nav>
<!-- #navigation -->


<?php do_action( 'stormbringer_footer_before' ); ?>

<div class="footer-above-wrapper">

	<footer id="footer-above">
		<div class="footer-above-inner">

            <?php

            if (is_active_sidebar('footer-above-4')) {
                $widget_columns = apply_filters('stormbringer_footer_above_widget_regions', 4);
            } elseif (is_active_sidebar('footer-above-3')) {
                $widget_columns = apply_filters('stormbringer_footer_above_widget_regions', 3);
            } elseif (is_active_sidebar('footer-above-2')) {
                $widget_columns = apply_filters('stormbringer_footer_above_widget_regions', 2);
            } elseif (is_active_sidebar('footer-above-1')) {
                $widget_columns = apply_filters('stormbringer_footer_above_widget_regions', 1);
            } else {
                $widget_columns = apply_filters('stormbringer_footer_above_widget_regions', 0);
            }

            if ($widget_columns > 0) : ?>


                <?php
                $i = 0;
                while ($i < $widget_columns) : $i++;
                    if (is_active_sidebar('footer-above-'.$i)) : ?>

                        <?php dynamic_sidebar('footer-above-'.intval($i)); ?>

                    <?php endif;
                endwhile; ?>


            <?php endif;
            ?>

		</div>
	</footer>
</div>
<!-- /.footer-above-wrapper -->

<div class="footer-wrapper">

	<footer id="footer">
		<div class="footer-inner">

            <?php

            if (is_active_sidebar('footer-4')) {
                $widget_columns = apply_filters('stormbringer_footer_widget_regions', 4);
            } elseif (is_active_sidebar('footer-3')) {
                $widget_columns = apply_filters('stormbringer_footer_widget_regions', 3);
            } elseif (is_active_sidebar('footer-2')) {
                $widget_columns = apply_filters('stormbringer_footer_widget_regions', 2);
            } elseif (is_active_sidebar('footer-1')) {
                $widget_columns = apply_filters('stormbringer_footer_widget_regions', 1);
            } else {
                $widget_columns = apply_filters('stormbringer_footer_widget_regions', 0);
            }

            if ($widget_columns > 0) : ?>


                <?php
                $i = 0;
                while ($i < $widget_columns) : $i++;
                    if (is_active_sidebar('footer-'.$i)) : ?>

                        <?php dynamic_sidebar('footer-'.intval($i)); ?>

                    <?php endif;
                endwhile; ?>


            <?php endif;
            ?>

		</div>
	</footer>
</div>
<!-- /.footer-wrapper -->

<div class="footer-below-wrapper">

	<footer id="footer-below">
		<div class="footer-below-inner">

            <?php

            if (is_active_sidebar('footer-below-4')) {
                $widget_columns = apply_filters('stormbringer_footer_below_widget_regions', 4);
            } elseif (is_active_sidebar('footer-below-3')) {
                $widget_columns = apply_filters('stormbringer_footer_below_widget_regions', 3);
            } elseif (is_active_sidebar('footer-below-2')) {
                $widget_columns = apply_filters('stormbringer_footer_below_widget_regions', 2);
            } elseif (is_active_sidebar('footer-below-1')) {
                $widget_columns = apply_filters('stormbringer_footer_below_widget_regions', 1);
            } else {
                $widget_columns = apply_filters('stormbringer_footer_below_widget_regions', 0);
            }

            if ($widget_columns > 0) : ?>


                <?php
                $i = 0;
                while ($i < $widget_columns) : $i++;
                    if (is_active_sidebar('footer-below-'.$i)) : ?>

                        <?php dynamic_sidebar('footer-below-'.intval($i)); ?>

                    <?php endif;
                endwhile; ?>


            <?php endif;
            ?>

		</div>
	</footer>
</div>
<!-- /.footer-below-wrapper -->

<?php do_action( 'stormbringer_footer_after' ); ?>

</div>
<!-- /#wrapper -->

<?php wp_footer(); ?>
</body>
</html>