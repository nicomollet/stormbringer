<?php


function stormbringer_dequeue_select2() {
	wp_dequeue_style( 'select2' );
	wp_deregister_style( 'select2' );
	wp_dequeue_script( 'select2' );
	wp_deregister_script( 'select2' );
}
add_action( 'wp_enqueue_scripts', 'stormbringer_dequeue_select2', 100 );

function stormbringer_dequeue_gridlist() {
	//wp_dequeue_style( 'grid-list-layout' );
	//wp_deregister_style( 'grid-list-layout' );
	wp_dequeue_style( 'grid-list-button' );
	wp_deregister_style( 'grid-list-button' );
	if ( ! function_exists( 'hustle_activated' ) && ! is_admin_bar_showing() ) {
		wp_dequeue_style( 'dashicons' );
		wp_deregister_style( 'dashicons' );
	}
}
add_action( 'wp_enqueue_scripts', 'stormbringer_dequeue_gridlist', 100 );

/**
 * Woocommerce: Customize add to cart link
 */
function stormbringer_woocommerce_loop_add_to_cart_link( $html, $product ) {

	$class = 'btn btn-default';
	$html  = sprintf(
		'<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : 'button' ),
		esc_html( $product->add_to_cart_text() )
	);

	return $html;
}

//add_filter( 'woocommerce_loop_add_to_cart_link', 'stormbringer_woocommerce_loop_add_to_cart_link', 10, 2 );

/**
 * Woocommerce: Cart message
 *
 * @param $message
 * @param $product_id
 *
 * @return string
 */
function stormbringer_wc_add_to_cart_message( $message ) {

	$message = str_replace( 'button', 'btn btn-default', $message );

	return $message;
}

//add_filter('wc_add_to_cart_message', 'stormbringer_wc_add_to_cart_message' );

/**
 * Woocommerce: Change number or products per row to 3
 *
 * @return int
 */
function stormbringer_loop_columns() {
	return get_theme_mod('woocommerce_columns', 4); // 4 products per row
}

add_filter( 'loop_shop_columns', 'stormbringer_loop_columns', 1, 10 );

/**
 * Woocommerce: Related products number
 *
 * @param $args
 *
 * @return mixed
 */
function stormbringer_related_products_args( $args ) {
	$args['posts_per_page'] = get_theme_mod('woocommerce_columns', 4); // 4 related products
	$args['columns'] = get_theme_mod('woocommerce_columns', 4); // arranged in 4 columns
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'stormbringer_related_products_args' );

/**
 * WooCommerce pre_get_posts for number of products per page, based on number of columns
 * @param $query
 */
function stormbringer_woocommerce_products_per_page( $query ) {
	if ( (is_shop() || is_product_category() || is_product()) && $query->is_main_query() ) {
		$query->set( 'posts_per_page', 3 * get_theme_mod('woocommerce_columns', 4) );
	}
}
add_action( 'pre_get_posts', 'stormbringer_woocommerce_products_per_page' );

/**
 * Woocommerce: Replace the 'x' in WooCommerce cart.php with text because 'x' is not helpfull at all for screenreader users
 *
 * @link https://gist.github.com/Willem-Siebe/dc34719917e77fcecbc6.
 *
 * @param $wsis_html
 * @param $cart_item_key
 *
 * @return string
 */
function wsis_woocommerce_remove_item( $wsis_html, $cart_item_key ) {
	$button    = __( 'Remove this item', 'woocommerce' );
	$button    = '<span class="glyphicon glyphicon-remove"></span>';
	$wsis_html = sprintf(
		'<a href="%s" class="remove" title="%s"><span class="wsis-remove-item">%s</span></a>',
		esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
		__( 'Remove this item', 'woocommerce' ), $button
	);

	return $wsis_html;
}

add_filter( 'woocommerce_cart_item_remove_link', 'wsis_woocommerce_remove_item', 10, 2 );

/**
 * Woocommerce: Customize form fields
 *
 * @param      $args
 * @param      $key
 * @param null $value
 *
 * @return mixed
 */
function stormbringer_form_field_args( $args, $key, $value = null ) {

	/*********************************************************************************************/
	/** This is not meant to be here, but it serves as a reference
	 * /** of what is possible to be changed. /**
	 *
	 * $defaults = array(
	 * 'type'              => 'text',
	 * 'label'             => '',
	 * 'description'       => '',
	 * 'placeholder'       => '',
	 * 'maxlength'         => false,
	 * 'required'          => false,
	 * 'id'                => $key,
	 * 'class'             => array(),
	 * 'label_class'       => array(),
	 * 'input_class'       => array(),
	 * 'return'            => false,
	 * 'options'           => array(),
	 * 'custom_attributes' => array(),
	 * 'validate'          => array(),
	 * 'default'           => '',
	 * );
	 * /*********************************************************************************************/

	// Start field type switch case

	$args['class'][] = 'formfield-'.$args['type'];

	switch ( $args['type'] ) {


		case "select" :  /* Targets all select input type elements, except the country and state select input types */
			$args['class'][] = 'form-group'; // Add a class to the field's html element wrapper
			$args['input_class'] = array( 'form-control', 'input-lgg' ); // Add a class to the form input itself
			//$args['custom_attributes']['data-plugin'] = 'select2';
			$args['label_class']       = array( 'control-label' );
			$args['custom_attributes'] = array(
				//'data-plugin'      => 'select2',
				'data-allow-clear' => 'true',
				'aria-hidden'      => 'true',
			); // Add custom data attributes to the form input itself
			break;

		case 'billing_country' :
		case 'country_select' :
		case 'country' : /* By default WooCommerce will populate a select with the country names */
			$args['input_class'] = array( 'form-control' );
			$args['class'][]     = 'form-group single-country';
			$args['label_class'] = array( 'control-label' );
			break;

		case "state" : /* By default WooCommerce will populate a select with state names */
			$args['class'][]     = 'form-group'; // Add class to the field's html element wrapper
			$args['input_class'] = array( 'form-control', 'input-lgg' ); // add class to the form input itself
			//$args['custom_attributes']['data-plugin'] = 'select2';
			$args['label_class']       = array( 'control-label' );
			$args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true', );
			break;


		case "password" :
		case "text" :
		case "email" :
		case "tel" :
		case "number" :
			$args['class'][] = 'form-group';
			//$args['input_class'][] = 'form-control input-lgg'; // will return an array of classes, the same as bellow
			$args['input_class'] = array( 'form-control', 'input-lgg' );
			$args['label_class'] = array( 'control-label' );
			break;

		case 'textarea' :
			$args['input_class'] = array( 'form-control', 'input-lgg' );
			$args['label_class'] = array( 'control-label' );
			break;

		case 'checkbox' :
			break;

		case 'radio' :
			break;

		default :
			$args['class'][]     = 'form-group';
			$args['input_class'] = array( 'form-control', 'input-lgg' );
			$args['label_class'] = array( 'control-label' );
			break;
	}

	return $args;
}
add_filter( 'woocommerce_form_field_args', 'stormbringer_form_field_args', 10, 3 );


/**
 * Woocommerce: customize payement button
 *
 * @param $button
 *
 * @return mixed
 */
function stormbringer_woocommerce_order_button_html( $button ) {

	$button = str_replace( 'button', 'button btn btn-block btn-lg btn-primary', $button );

	return $button;
}

//add_filter('woocommerce_order_button_html', 'stormbringer_woocommerce_order_button_html');

/**
 * Woocommerce: Account filter account menu item classes
 *
 * @param $classes
 * @param $endpoint
 *
 * @return array
 */
function stormbringer_woocommerce_account_menu_item_classes( $classes, $endpoint ) {
	global $wp;

	$classes[] = 'list-group-item';

	$current = isset( $wp->query_vars[ $endpoint ] );
	if ( 'dashboard' === $endpoint && ( isset( $wp->query_vars['page'] ) || empty( $wp->query_vars ) ) ) {
		$current = true;
	}
	if ( $current ) {
		$classes[] = 'active';
	}

	return $classes;
}

add_filter( 'woocommerce_account_menu_item_classes', 'stormbringer_woocommerce_account_menu_item_classes', 10, 2 );


if ( ! function_exists( 'stormbringer_handheld_footer_bar' ) ) {
	/**
	 * Display a menu intended for use on handheld devices
	 *
	 * @since 0.3.2
	 */
	function stormbringer_handheld_footer_bar() {
		$links = array(
			'my-account' => array(
				'priority' => 10,
				'callback' => 'stormbringer_handheld_footer_bar_account_link',
			),
			'search'     => array(
				'priority' => 20,
				'callback' => 'stormbringer_handheld_footer_bar_search',
			),
			'cart'       => array(
				'priority' => 30,
				'callback' => 'stormbringer_cart_items_number',
			),
		);

		if ( wc_get_page_id( 'myaccount' ) === - 1 ) {
			unset( $links['my-account'] );
		}

		if ( wc_get_page_id( 'cart' ) === - 1 ) {
			unset( $links['cart'] );
		}
		if(!is_woocommerce()){
			$links = [];
		}

		$links = apply_filters( 'stormbringer_handheld_footer_bar_links', $links );
		if(count($links)>0):
			?>
			<div class="stormbringer-handheld-footer-bar <?php echo (WC()->cart->get_cart_contents_count() == 0?'cart-empty':'cart-notempty'); ?>" >
				<ul class="columns-<?php echo count( $links ); ?>">
					<?php foreach ( $links as $key => $link ) : ?>
						<li class="<?php echo esc_attr( $key ); ?>">
							<?php
							if ( $link['callback'] ) {
								call_user_func( $link['callback'], $key, $link );
							}
							?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php
		endif;
	}
}

if ( ! function_exists( 'stormbringer_handheld_footer_bar_search' ) ) {
	/**
	 * The search callback function for the handheld footer bar
	 *
	 * @since 2.0.0
	 */
	function stormbringer_handheld_footer_bar_search() {
		echo '<a href=""><span class="glyphicon glyphicon-search"></span><span class="text-hide">' . esc_attr__( 'Search', 'stormbringer' )
		     . '</span></a>';
		stormbringer_product_search();
	}
}

if ( ! function_exists( 'stormbringer_handheld_footer_bar_account_link' ) ) {
	/**
	 * The account callback function for the handheld footer bar
	 *
	 * @since 2.0.0
	 */
	function stormbringer_handheld_footer_bar_account_link() {
		echo '<a href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '">
        <span class="glyphicon glyphicon-user"></span>
        <span class="text-hide">' . esc_attr__( 'My Account', 'stormbringer' ) . '</span>
        </a>';
	}
}
add_action( 'stormbringer_footer_before', 'stormbringer_handheld_footer_bar', 999 );

if ( ! function_exists( 'stormbringer_product_search' ) ) {
	/**
	 * Display Product Search
	 *
	 * @since  1.0.0
	 * @uses   is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function stormbringer_product_search() { ?>
		<div class="site-search">
			<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
		</div>
		<?php
	}
}

/**
 * WooCommerce: product form classes
 *
 * @param $ob_get_clean
 *
 * @return mixed
 */
function stormbringer_get_product_search_form( $ob_get_clean ) {
	$ob_get_clean = str_replace( 'class="search-field"', 'class="search-field form-control"', $ob_get_clean );
	$ob_get_clean = str_replace( 'type="submit"', 'type="submit" class="btn btn-default"', $ob_get_clean );

	return $ob_get_clean;
}

;
add_filter( 'get_product_search_form', 'stormbringer_get_product_search_form', 10, 1 );

/**
 * WooCommerce: variations select class
 *
 * @param $args
 *
 * @return mixed
 */
function stormbringer_woocommerce_dropdown_variation_attribute_options_args( $args ) {
	$args['class'] = 'form-control';

	return $args;
}
add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'stormbringer_woocommerce_dropdown_variation_attribute_options_args' );

/**
 * WooCommerce: remove some CSS styles in frontend
 *
 * @param $enqueue_styles
 *
 * @return mixed
 */
function stormbringer_woocommerce_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );        // Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation

	return $enqueue_styles;
}
add_filter( 'woocommerce_enqueue_styles', 'stormbringer_woocommerce_dequeue_styles' );

/**
 * Woocommerce: active menu item "shop" on all subpages of shop (cart and checkout)
 *
 * @param $classes
 * @param $item
 * @param $args
 *
 * @return array
 */
function stormbringer_woocommerce_pages_menu_item_classes( $classes, $item, $args ) {
	$woocommerce_shop_page_id = get_option( 'woocommerce_shop_page_id' );
	if( (is_cart() || is_checkout() ) && $item->object == 'page' && $item->object_id == $woocommerce_shop_page_id) {
		$classes[] = 'current-menu-item active';
	}
	return array_unique( $classes );
}
add_filter( 'nav_menu_css_class', 'stormbringer_woocommerce_pages_menu_item_classes', 10, 3 );


/**
 * Woocommerce: Shortcode [woocommerce_cart_link] for displaying a link to basket
 *
 * @param $atts
 *
 * @return string
 */
function woocommerce_cart_count_shortcode( $atts ) {
	if(is_admin()) return '';

	$defaults = array(
		'icon_class'         => 'glyphicon glyphicon-shopping-cart',
		'show_count'         => true,
		'show_amount'        => true,
		'link_class'         => 'link-cart',
	);
	$atts = shortcode_atts( $defaults, $atts );

	$icon_html = '<span class="'.$atts['icon_class'] . '"></span>';

	$link_class = $atts['link_class'];
	$link_url = "";

	$cart_count_html = "";
	$cart_amount_html = "";
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

		if ( true == $atts['show_amount'] ) {
			$cart_amount_html = wp_kses_data(WC()->cart->get_cart_subtotal());
		}


		if ( WC()->cart->get_cart_contents_count() > 0 ) {
			if ( true == $atts['show_count'] ) {
				$cart_count_html = '('.wp_kses_data(
						sprintf(
							_n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'stormbringer'),
							WC()->cart->get_cart_contents_count()
						)
					).')';
			}
			$link_url = esc_url(wc_get_cart_url());
		} else {
			$woocommerce_shop_page_id = get_option( 'woocommerce_shop_page_id' );
			$link_url = get_permalink( $woocommerce_shop_page_id );
		}
	}

	$html  = '<a href="' . $link_url .'" class="'.$link_class.'">';
	$html .= $icon_html . ' <span class="amount">'.$cart_amount_html .'</span> <span class="count">'. $cart_count_html.'</span>';
	$html .= '</a>';
	return $html;
}
add_shortcode( 'woocommerce_cart_link', 'woocommerce_cart_count_shortcode' );

/**
 * WooCommerce: Shortcode [woocommerce_account_link] for displaying a link to account
 *
 * @param $atts
 *
 * @return string
 */
function woocommerce_account_link_shortcode( $atts ) {
	if(is_admin()) return '';

	$defaults = array(
		'icon_class' => 'glyphicon glyphicon-user',
		'link_class' => 'link-account',
	);
	$atts = shortcode_atts( $defaults, $atts );

	$icon_html = '<span class="'.$atts['icon_class'] . '"></span>';

	$link_class = $atts['link_class'];
	$link_url = "";
	$page_name = "";

	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

		$woocommerce_account_page_id = get_option( 'woocommerce_myaccount_page_id' );
		$link_url = get_permalink( $woocommerce_account_page_id );
		$page = get_post( $woocommerce_account_page_id );
		if(!empty($page)){
			$page_name = esc_html($page->post_title);
		}
	}

	$html  = '<a href="' . $link_url .'" class="'.$link_class.'">';
	$html .= $icon_html . ' '. $page_name;
	$html .= '</a>';
	return $html;
}
add_shortcode( 'woocommerce_account_link', 'woocommerce_account_link_shortcode' );



/**
 * Woocommerce Grid/List Toggle: style
 *
 * @param $output
 * @param $grid_view
 * @param $list_view
 *
 * @return string
 */
function stormbringer_gridlist_toggle_button_output($output, $grid_view, $list_view){
	$output = sprintf( '<nav class="gridlist-toggle"><a href="#" id="grid" title="%1$s"><span class="dashicons dashicons-grid-view"></span> <em>%1$s</em></a><a href="#" id="list" title="%2$s"><span class="dashicons dashicons-exerpt-view"></span> <em>%2$s</em></a></nav>', $grid_view, $list_view );

	$output= '';
	$output.=sprintf( '
	  <div class="btn-group gridlist-toggle" role="group">
	  <a href="#" type="button" class="btn btn-default" id="grid" title="%1$s"><span class="glyphicon glyphicon-th"></span><span class="hide">  %1$s</span></a>
	  <a href="#" type="button" class="btn btn-default" id="list" title="%2$s"><span class="glyphicon glyphicon-list"></span><span class="hide">%2$s</span></a>
	  </div>
	', $grid_view, $list_view );
	/*$output.=sprintf( '
	  <div class="btn-group gridlist-toggle" role="group">
	  <button type="button" class="btn btn-default" id="grid" title="%1$s"><span class="glyphicon glyphicon-th"></span><span class="hide">  %1$s</span></button>
	  <button type="button" class="btn btn-default" id="list" title="%2$s"><span class="glyphicon glyphicon-list"></span><span class="hide">%2$s</span></button>
	  </div>
	', $grid_view, $list_view );*/

	return $output;
}
add_filter( 'gridlist_toggle_button_output', 'stormbringer_gridlist_toggle_button_output',10, 3 );

/**
 * WooCommerce product list item before
 */
function stormbringer_woocommerce_before_shop_loop_item(){
	echo '<div class="product-loop-inner">';
}
add_action('woocommerce_before_shop_loop_item', 'stormbringer_woocommerce_before_shop_loop_item', -999);
add_action('woocommerce_before_subcategory', 'stormbringer_woocommerce_before_shop_loop_item', -999);


/**
 * WooCommerce product list item after
 */
function stormbringer_woocommerce_after_shop_loop_item(){
	echo '</div>';
}
add_action('woocommerce_after_shop_loop_item', 'stormbringer_woocommerce_after_shop_loop_item', 999);
add_action('woocommerce_after_subcategory', 'stormbringer_woocommerce_after_shop_loop_item', 999);

/**
 * WooCommerce Cart Fragments
 * Ensure cart contents update when products are added to the cart via AJAX
 *
 * @param  array $fragments Fragments to refresh via AJAX.
 * @return array            Fragments to refresh via AJAX
 */
function stormbringer_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();
	stormbringer_cart_contents();
	$fragments['a.cart-contents'] = ob_get_clean();

	ob_start();
	stormbringer_cart_items_number();
	$fragments['a.cart-items-number'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'stormbringer_cart_fragment' );


/**
 * WooCommerce Cart Link
 * Displayed a link to the cart including the number of items present and the cart total
 *
 * @return void
 * @since  1.0.0
 */
function stormbringer_cart_items_number() {
	?>
	<a class="cart-items-number" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'stormbringer' ); ?>">
		<span class="glyphicon glyphicon-shopping-cart"></span>
		<span class="badge badge-count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
	</a>
	<?php
}


/**
 * WooCommerce Cart Contents
 * Displayed a link to the cart including the number of items present and the cart total
 *
 * @return void
 * @since  1.0.0
 */
function stormbringer_cart_contents() {
	?>
	<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'stormbringer' ); ?>">
		<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'storefront' ), WC()->cart->get_cart_contents_count() ) );?></span>
	</a>
	<?php
}