<?php

// Put Woocommerce Javascript at the end of the footer
remove_action('wp_footer', 'wc_print_js', 25);
add_action('wp_footer', 'wc_print_js', PHP_INT_MAX);

// Remove Woocommerce styles
define('WOOCOMMERCE_USE_CSS',false); // until Woocommerce 2.1
add_filter( 'woocommerce_enqueue_styles', '__return_false' ); // after Woocommerce 2.1

// Replace Woocommerce button class with Bootstrap
add_filter('woocommerce_loop_add_to_cart_link', 'stormbringer_commerce_switch_buttons');
function stormbringer_commerce_switch_buttons( $button ){
	$button = str_replace('button', 'btn btn-default', $button);
	return $button;
}

// Place a cart icon with number of items and total cost in the menu bar.
function stormbringer_shoppingcart_menu() {

	global $woocommerce;
	$viewing_cart = __('View your shopping cart', 'stormbringer');
	$start_shopping = __('Start shopping', 'stormbringer');
	$cart_url = $woocommerce->cart->get_cart_url();
	$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
	$cart_contents_count = $woocommerce->cart->cart_contents_count;
	$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'stormbringer'), $cart_contents_count);
	$cart_total = $woocommerce->cart->get_cart_total();
	// Uncomment the line below to hide nav menu cart item when there are no items in the cart
	// if ( $cart_contents_count > 0 ) {
	if ($cart_contents_count == 0) {
		$menu_item = '<li><a class="woo-menu-cart" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
	} else {
		$menu_item = '<li><a class="woo-menu-cart" href="'. $cart_url .'" title="'. $viewing_cart .'">';
	}
	$menu_item .= '<span class="glyphicon glyphicon-shopping-cart"></span> '.$cart_contents.' - '. $cart_total;
	$menu_item .= '</a></li>';

	echo $menu_item;

}

//  woocommerce-twitterbootstrap plugin: https://github.com/bassjobsen/woocommerce-twitterbootstrap
if(!class_exists('WooCommerce_Twitter_Bootstrap'))
{

	class WooCommerce_Twitter_Bootstrap
	{

		/*
		* Construct the plugin object
		*/
		public function __construct()
		{
			load_plugin_textdomain( 'wootb', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
			// register actions
			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('admin_menu', array(&$this, 'add_menu'));
			add_filter( 'init', array(&$this, 'init' ) );

			$plugin = plugin_basename(__FILE__);
			add_filter("plugin_action_links_$plugin", array( $this,'plugin_settings_link'));
		}
// END public

		function init()
		{
			remove_shortcode( 'featured_products' );
			add_shortcode( 'featured_products', array(&$this, 'featured_products' ));
			remove_shortcode( 'recent_products' );
			add_shortcode( 'recent_products', array(&$this, 'recent_products' ));

			add_action( 'wp_enqueue_scripts', array(&$this, 'woocommerce_twitterbootstrap_setstylesheets'), 99 );
			add_action( 'shop_loop', array($this, 'bs_shop_loop'), 99 );
			add_action( 'woocommerce_before_single_product_summary', array(&$this, 'woocommerce_before_single_product_summary_bs'), 1 );
			add_action( 'woocommerce_before_single_product_summary', array(&$this, 'woocommerce_before_single_product_summary_bs_end'), 100 );
			add_action( 'woocommerce_after_single_product_summary', array(&$this, 'woocommerce_after_single_product_summary_bs'), 1 );
			/* thumbnails */
			add_action('bs_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10);
			add_action('bs_before_shop_loop_item_title',array(&$this, 'bs_get_product_thumbnail'),10,3);
			add_action('woocommerce_after_shop_loop',array(&$this, 'endsetupgrid'),1);
			add_action('woocommerce_before_shop_loop',array(&$this, 'setupgrid'),999);

			/* the grid display */
			/*
			|  	columns		| mobile 	| tablet 	| desktop	|per page 	|
			----------------------------------------------------|-----------|
			|		1		|	1		|	1		|	1		| 	10		|
			|---------------------------------------------------|-----------|
			|		2		|	1		|	2		|	2		|	10		|
			|---------------------------------------------------|-----------|
			|		3		|	1		|	1		|	3		|	 9		|
			|---------------------------------------------------|-----------|
			|		3(1)	|	1		|	2		|	3		|	12		|
			|---------------------------------------------------|-----------|
			|		4		|	1		|	2		|	4		|	12		|
			|---------------------------------------------------|-----------|
			|		5		|	n/a		|	n/a		|	n/a		|	n/a	    |
			|---------------------------------------------------|-----------|
			|		6		|	2		|	4		|	6		|	12		|
			|---------------------------------------------------|-----------|
			|		>=6		|	n/a		|	n/a		|	n/a		|	n/a		|
			|---------------------------------------------------------------|

			*/

// Store column count for displaying the grid
			global $woocommerce_loop;

			if ( empty( $woocommerce_loop['columns'] ) )
			{
				$woocommerce_loop['columns'] = get_option('number_of_columns', 4 );
			}


			if($woocommerce_loop['columns']==3)
			{
				add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 10 );
			}
			elseif($woocommerce_loop['columns']>2)
			{
				add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 10 );
			}

			define('WooCommerce_Twitter_Bootstrap_grid_classes', $this->get_grid_classes($woocommerce_loop));

		}

		/**
		 * Activate the plugin
		 **/
		public static function activate()
		{
			// Do nothing
		}
// END public static function activate

		/**
		 * Deactivate the plugin
		 *
		 **/
		public static function deactivate()
		{
			// Do nothing
		}
// END public static function deactivate

		/**
		 * hook into WP's admin_init action hook
		 * */
		public function admin_init()
		{
			// Set up the settings for this plugin

			$this->init_settings();
			// Possibly do additional admin_init tasks
		}
// END public static function activate - See more at: http://www.yaconiello.com/blog/how-to-write-wordpress-plugin/#sthash.mhyfhl3r.JacOJxrL.dpuf

		/** * Initialize some custom settings */
		public function init_settings()
		{
			// register the settings for this plugin
			register_setting('woocommerce-twitterbootstrap-group', 'number_of_columns');
			register_setting('woocommerce-twitterbootstrap-group', 'tbversion');
			register_setting('woocommerce-twitterbootstrap-group', 'wootb_size');
		} // END public function init_custom_settings()


		/** * add a menu */
		public function add_menu()
		{
			add_options_page('WooCommerce Twitter Bootstrap Settings', 'WooCommerce Bootstrap', 'manage_options', 'woocommerce-twitterbootstrap', array(&$this, 'plugin_settings_page'));
		} // END public function add_menu()

		/** * Menu Callback */
		public function plugin_settings_page()
		{
			if(!current_user_can('manage_options'))
			{
				wp_die(__('You do not have sufficient permissions to access this page.'));

			}

			// Render the settings template
			//include(sprintf("%s/settings.php", dirname(__FILE__)));
			$this->showform();
		}
// END public function plugin_settings_page()

		function showform()
		{
			?>
			<div class="wrap">

				<h2>WooCommerce Twitter Bootstrap <?php echo __('Settings','stormbringer');?></h2>

				<form method="post" action="options.php">
					<?php settings_fields('woocommerce-twitterbootstrap-group'); ?>
					<table class="form-table">
						<tr valign="top">
							<th scope="row">
								<label for="setting_a"><?php echo __('Number of columns per row','stormbringer');?></label></th>
							<td>
								<select name="number_of_columns" id="number_of_columns">

									<?php

									$numberofcolumns = (get_option('number_of_columns'))?get_option('number_of_columns'):4;

									foreach(array(1,2,3,4,6) as $number)
									{
										?><option value="<?php echo $number ?>" <?php echo ($numberofcolumns==$number)?' selected="selected"':''?>><?php echo $number ?></option><?php
									}
									?>
								</select>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row">
								<label for="tbversion"><?php echo __('Twitter\'s Bootstrap version','stormbringer');?></label></th>
							<td>
								<?php
								$tbversion = (get_option('tbversion'))?get_option('tbversion'):3;
								?>
								<input type="radio" value="2" name="tbversion" <?php echo ($tbversion==2)?' checked="checked"':''?>>Twitter's Bootstrap 2.x (2.3.2)<br>
								<input type="radio" value="3" name="tbversion"<?php echo ($tbversion==3)?' checked="checked"':''?>>Twitter's Bootstrap 3.x<br>
							</td>
						</tr>


						<tr valign="top">
							<th scope="row">
								<label for="wootb_size"><?php echo __('Image size','stormbringer');?></label></th>
							<td>
								<p><?php echo __('Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).','stormbringer');?></p>
								<?php

								$wootb_size = (get_option('wootb_size'))?get_option('wootb_size'):'medium';


								?>
								<input type="text" value="<?php echo $wootb_size; ?>" name="wootb_size" id="wootb_size">

							</td>
						</tr>

					</table>
					<?php submit_button(); ?> </form>
			</div>
		<?php
		}
		/**
		 * Output featured products
		 *
		 * @access public
		 * @param array $atts
		 * @return string
		 */
		function featured_products( $atts )
		{

			extract(shortcode_atts(array(
				'per_page' => 12,
				'columns' => 4,
				'orderby' => 'date',
				'order' => 'desc',
				'content_product_template' => 'content-product'
			), $atts));

			$args = array(
				'post_type'=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'=> 1,
				'posts_per_page' => $per_page,
				'orderby' => $orderby,
				'order' => $order,
				'meta_query' => array(
					array(
						'key' => '_visibility',
						'value' => array('catalog', 'visible'),
						'compare' => 'IN'
					),
					array(
						'key' => '_featured',
						'value' => 'yes'
					)
				)
			);

			return $this->showproductspeciallist($args,$content_product_template,$columns);

		}
		/**
		 * Recent Products shortcode
		 *
		 * @access public
		 * @param array $atts
		 * @return string
		 */
		public function recent_products( $atts )
		{

			global $woocommerce;

			extract(shortcode_atts(array(
				'per_page' => '12',
				'columns' => '4',
				'orderby' => 'date',
				'order' => 'desc',
				'content_product_template' => 'content-product'
			), $atts));

			$meta_query = $woocommerce->query->get_meta_query();

			$args = array(
				'post_type'=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'=> 1,
				'posts_per_page' => $per_page,
				'orderby' => $orderby,
				'order' => $order,
				'meta_query' => $meta_query
			);

			return $this->showproductspeciallist($args,$content_product_template,$columns);

		}
		function showproductspeciallist($args,$content_product_template,$columns=null)
		{

			global $woocommerce_loop;
			ob_start();

			$products= new WP_Query( $args );

			$woocommerce_loop['columns'] = ($columns)?$columns:get_option( 'number_of_columns', 4 );

			if ( $products->have_posts() )
			{
				$this->bs_shop_loop($products,$content_product_template,$columns);
			}

			wp_reset_postdata();
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';
		}
		function woocommerce_twitterbootstrap_setstylesheets()
		{
			//wp_register_style ( 'woocommerce-twitterbootstrap', plugins_url( 'css/woocommerce-twitterboostrap.css' , __FILE__ ), 'woocommerce' );
			//wp_enqueue_style ( 'woocommerce-twitterbootstrap');
		}
		function get_grid_classes($woocommerce_loop)
		{
			/* the grid display */
			/*
			|  	columns		| mobile 	| tablet 	| desktop	|per page 	|
			----------------------------------------------------|-----------|
			|		1		|	1		|	1		|	1		| 	10		|
			|---------------------------------------------------|-----------|
			|		2		|	1		|	2		|	2		|	10		|
			|---------------------------------------------------|-----------|
			|		3		|	1		|	1		|	3		|	9		|
			|---------------------------------------------------|-----------|
			|		4		|	1		|	2		|	4		|	12		|
			|---------------------------------------------------|-----------|
			|		5		|	n/a		|	n/a		|	n/a		|	n/a	    |
			|---------------------------------------------------|-----------|
			|		6		|	2		|	4		|	6		|	12		|
			|---------------------------------------------------|-----------|
			|		>=6		|	n/a		|	n/a		|	n/a		|	n/a		|
			|---------------------------------------------------------------|
			*
			*
			*/

			/* the grid display Twitter's Bootstrap 2.x*/
			/*
			|  	columns		| mobile / tablet| desktop	|per page |
			------------------------------------------------------|
			|		1		|	1		     |	1		| 	10	  |
			|-----------------------------------------------------|
			|		2		|	1		     |	2	    |	10	  |
			|-----------------------------------------------------|
			|		3		|	1			 |	3		|	9     |
			|-----------------------------------------------------|
			|		4		|	1		     |	4	    |   12	  |
			|-----------------------------------------------------|
			|		5		|	n/a		     |	n/a		|	n/a	  |
			|-----------------------------------------------------|
			|		6		|	2		     |	4		|	12	  |
			|-----------------------------------------------------|
			|		>=6		|	n/a		     |	n/a		|	n/a	  |
			|-----------------------------------------------------|
			*
			*
			*/
			if(get_option( 'tbversion', 3 )==2)
			{
				switch($woocommerce_loop['columns'])
				{
					case 6: $classes = 'span2'; break;
					case 4: $classes = 'span3'; break;
					case 3: $classes = 'span4'; break;
					case 31: $classes = 'span4'; break;
					case 2: $classes = 'span6'; break;
					default: $classes = 'span12';
				}
			}
			else
			{
				switch($woocommerce_loop['columns'])
				{

					case 6: $classes = 'col-xs-6 col-sm-3 col-md-2'; break;
					case 4: $classes = 'col-xs-12 col-sm-6 col-md-3'; break;
					case 3: $classes = 'col-xs-12 col-sm-12 col-md-4'; break;
					case 31: $classes = 'col-xs-12 col-sm-6 col-md-4'; break;
					case 2: $classes = 'col-xs-12 col-sm-6 col-md-6'; break;
					default: $classes = 'col-xs-12 col-sm-12 col-md-12';

				}
			}
			return $classes;
		}
		function bs_product_loop(&$woocommerce_loop,$classes,$template='content-product')
		{
			if(!file_exists( $template = get_stylesheet_directory() . '/'.$template.'.php' ))
			{
				//$template = WP_PLUGIN_DIR.'/'.str_replace( basename( __FILE__), "", plugin_basename(__FILE__) ).'bs-content-product.php';
				//from: http://wordpress.stackexchange.com/questions/119064/what-should-i-use-instead-of-wp-content-dir-and-wp-plugin-dir
				$template = plugin_dir_path( __FILE__ ). 'content-product.php';
			}


			include($template);


			if(get_option( 'tbversion', 3 )==3)// only for version 3+
			{
				if($woocommerce_loop['columns'] == 6)
				{
					if(0 == ($woocommerce_loop['loop'] % 6)){?><div class="clearfix visible-md visible-lg"></div><?php }
					if(0 == ($woocommerce_loop['loop'] % 4)){?><div class="clearfix visible-sm"></div><?php }
					if(0 == ($woocommerce_loop['loop'] % 2)){?><div class="clearfix visible-xs"></div><?php }
				}
				elseif($woocommerce_loop['columns'] == 4)
				{
					if(0 == ($woocommerce_loop['loop'] % 4)){?><div class="clearfix visible-md visible-lg"></div><?php }
					if(0 == ($woocommerce_loop['loop'] % 2)){?><div class="clearfix visible-sm"></div><?php }
				}
				elseif($woocommerce_loop['columns'] == 3)
				{
					if(0 == ($woocommerce_loop['loop'] % 3)){?><div class="clearfix visible-md visible-lg"></div><?php }
				}
				elseif($woocommerce_loop['columns'] == 31)
				{
					if(0 == ($woocommerce_loop['loop'] % 3)){?><div class="clearfix visible-md visible-lg"></div><?php }
					if(0 == ($woocommerce_loop['loop'] % 2)){?><div class="clearfix visible-sm"></div><?php }
				}
				elseif($woocommerce_loop['columns'] == 2)
				{
					if(0 == ($woocommerce_loop['loop'] % 2)){?><div class="clearfix invisible-xs"></div><?php }
				}
			}
			$woocommerce_loop['loop']++;



		}
		function bs_shop_loop($product=null,$template='content-product',$columns=null)
		{

			$woocommerce_loop = array('loop'=>0,'columns' => ($columns)?$columns:get_option( 'number_of_columns', 4 ));


			/* double check */
			if($woocommerce_loop['columns']!=31 && ( $woocommerce_loop['columns']>6 || in_array($woocommerce_loop['columns'],array(5,7)))) { return; }


			// Increase loop count
			$woocommerce_loop['loop']++;

			ob_start();
			woocommerce_product_subcategories(array('before'=>'<div class="clearfix"></div><div class="subcategories"><div class="row">','after'=>'</div></div>'));
			$subcategories = ob_get_contents();
			ob_end_clean();
			$classes = $this->get_grid_classes($woocommerce_loop);

			echo preg_replace(array('/<li[^>]*>/','/<\/li>/'),array('<div class="'.$classes.'">','</div>'),$subcategories);

			if($product)
			{

				?><div class="clearfix"></div><div class="products"><div class="row"><?php

				while ( $product->have_posts()) : $product->the_post();
					$this->bs_product_loop($woocommerce_loop,$classes,$template);
				endwhile;

			}
			else
			{
				?><div class="clearfix"></div><div class="products"><div class="row"><?php

				while ( have_posts() ) : the_post();
					$this->bs_product_loop($woocommerce_loop,$classes);
				endwhile;

			}
			if($woocommerce_loop['columns']==31)$woocommerce_loop['columns']=3;
			if ( 0 != ($woocommerce_loop['loop']-1) % $woocommerce_loop['columns'] )
			{

				?><div class="<?php echo $classes?>"></div><?php

				while ( 0 != $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
				{
					$woocommerce_loop['loop']++;
					?><div class="<?php echo $classes?>"></div><?php
				}

			}

			?></div></div><?php

		}



		/**
		 * Output the start of the page wrapper.
		 *
		 * @access public
		 * @return void
		 */
		function woocommerce_output_content_wrapper_bs() {

			//woocommerce_get_template( 'shop/wrapper-start.php' );
		}

		/**
		 * Output the end of the page wrapper.
		 *
		 * @access public
		 * @return void
		 */
		function woocommerce_output_content_wrapper_end_bs() {
			//woocommerce_get_template( 'shop/wrapper-end.php' );
		}



		function woocommerce_before_single_product_summary_bs()
		{

			if(get_option( 'tbversion', 3 )==2)
			{
				$bssingleproductclass = 'span6';
			}
			else
			{
				$bssingleproductclass = 'col-sm-6';
			}

			echo '<div class="row"><div class="'.$bssingleproductclass.' bssingleproduct">';

		}



		function woocommerce_before_single_product_summary_bs_end()
		{ echo '</div>
<div class="col-sm-6 bssingleproduct">';
		}

		function woocommerce_after_single_product_summary_bs()
		{ echo '</div>
</div>';
		}

		function bs_get_product_thumbnail()
		{
			global $post;
			$wootb_size = get_option( 'wootb_size', 'medium');

			if(preg_match('/array\(.+\);?/',$wootb_size))
			{
				eval('$wootb_size='.str_replace(';','',$wootb_size).';');
			}

			$thumbnail = get_the_post_thumbnail($post->ID,$wootb_size );
			if(empty($thumbnail))
			{

				/*if(!file_exists( $template = get_stylesheet_directory() . '/woocommerce-twitterbootstrap/placeholder.php' ))
				{
					//$template = WP_PLUGIN_DIR.'/'.str_replace( basename( __FILE__), "", plugin_basename(__FILE__) ).'placeholder.php';
					$template = plugin_dir_path( __FILE__ ). 'placeholder.php';
				}
				include($template);*/
				echo '<img class="img-response" alt="Placeholder" src="' . plugin_dir_url('woocommerce/assets/images/placeholder.png') .'placeholder.png">';
				//return;
			}

			$doc = new DOMDocument();
			$doc->loadHTML('<?xml encoding="'.DB_CHARSET.'">' . $thumbnail );
			$images = $doc->getElementsByTagName('img');
			foreach ($images as $image) {
				$image->setAttribute('class',$image->getAttribute('class').' img-responsive');
				$image->removeAttribute('height');
				$image->removeAttribute('width');
//see: http://stackoverflow.com/questions/6321481/printing-out-html-content-from-domelement-using-nodevalue
				echo $doc->saveXML($image); break;
			}

		}

		function endsetupgrid()
		{
			ob_end_clean();
			$this->bs_shop_loop();
		}

		function setupgrid()
		{
			ob_start();
		}

		function plugin_settings_link($links)
		{
			$settings_link = '<a href="options-general.php?page=woocommerce-twitterbootstrap">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}


	} // END class
}

if(class_exists('WooCommerce_Twitter_Bootstrap'))
{ // Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('WooCommerce_Twitter_Bootstrap', 'activate'));
	register_deactivation_hook(__FILE__, array('WooCommerce_Twitter_Bootstrap', 'deactivate'));

	new WooCommerce_Twitter_Bootstrap();
}
