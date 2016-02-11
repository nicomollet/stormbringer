<?php

/**
 * owlcarousel shortcode usage: [gallery type="owlcarousel"] or the older [owlcarousel]
 */
class Jetpack_Owlcarousel_Shortcode {
	public $instance_count = 0;

	function __construct() {
		global $shortcode_tags;


		// Only if the owlcarousel shortcode has not already been defined.
		if ( ! array_key_exists( 'owlcarousel', $shortcode_tags ) ) {
			add_shortcode( 'owlcarousel', array( $this, 'shortcode_callback' ) );
			$needs_scripts = true;
		}

		// Only if the gallery shortcode has not been redefined.
		if ( isset( $shortcode_tags['gallery'] ) && 'gallery_shortcode' === $shortcode_tags['gallery'] ) {
			add_filter( 'post_gallery', array( $this, 'post_gallery' ), 1002, 2 );
			add_filter( 'jetpack_gallery_types', array( $this, 'add_gallery_type' ), 10 );
			$needs_scripts = true;
		}


		/**
		 * For the moment, comment out the setting for v2.8.
		 * The remainder should work as it always has.
		 * See: https://github.com/Automattic/jetpack/pull/85/files
		 */
		// add_action( 'admin_init', array( $this, 'register_settings' ), 5 );
	}

	/**
	 * Responds to the [gallery] shortcode, but not an actual shortcode callback.
	 *
	 * @param $value string An empty string if nothing has modified the gallery output, the output html otherwise
	 * @param $attr  array The shortcode attributes array
	 *
	 * @return string The (un)modified $value
	 */
	function post_gallery( $value, $attr ) {
		// Bail if somebody else has done something
		if ( ! empty( $value ) ) {
			return $value;
		}

		// If [gallery type="owlcarousel"] have it behave just like [owlcarousel]
		if ( ! empty( $attr['type'] ) && 'owlcarousel' == $attr['type'] ) {
			return $this->shortcode_callback( $attr );
		}

		return $value;
	}

	/**
	 * Add the Slideshow type to gallery settings
	 *
	 * @see Jetpack_Tiled_Gallery::media_ui_print_templates
	 *
	 * @param $types array An array of types where the key is the value, and the value is the caption.
	 *
	 * @return array
	 */
	function add_gallery_type( $types = array() ) {
		$types['owlcarousel'] = esc_html__( 'Owlcarousel', 'jetpack' );

		return $types;
	}


	function settings_select( $name, $values, $extra_text = '' ) {
		if ( empty( $name ) || empty( $values ) || ! is_array( $values ) ) {
			return;
		}
		$option = get_option( $name );
		?>
		<fieldset>
			<select name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>">
				<?php foreach ( $values as $key => $value ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $option ); ?>>
						<?php echo esc_html( $value ); ?>
					</option>
				<?php endforeach; ?>
			</select>
			<?php if ( ! empty( $extra_text ) ) : ?>
				<p class="description"><?php echo esc_html( $extra_text ); ?></p>
			<?php endif; ?>
		</fieldset>
		<?php
	}


	function shortcode_callback( $attr ) {
		global $post;

		$attr = shortcode_atts(
			array(
				'trans'     => 'fade',
				'order'     => 'ASC',
				'orderby'   => 'menu_order ID',
				'id'        => $post->ID,
				'include'   => '',
				'exclude'   => '',
				'autostart' => true,
				'size'      => '',
				'loop'      => 'true',
				'margin'    => 0,
				'center'    => 'false',
				'controls'  => 'false',
				'indicators'=> 'true',
				'autoplay'  => 'false',
				'timeout'   => '5000',
				'items'     => '4',
				'slideby'   => '4',
				'responsive'=> '',
				'animateout'=> 'fadeOut',
				'animatein' => '',
			), $attr, 'owlcarousel'
		);

		if ( 'rand' == strtolower( $attr['order'] ) ) {
			$attr['orderby'] = 'none';
		}

		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] ) {
			$attr['orderby'] = 'menu_order ID';
		}

		if ( ! $attr['size'] ) {
			$attr['size'] = 'full';
		}

		// Don't restrict to the current post if include
		$post_parent = ( empty( $attr['include'] ) ) ? intval( $attr['id'] ) : null;

		$attachments = get_posts(
			array(
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'posts_per_page' => - 1,
				'post_parent'    => $post_parent,
				'order'          => $attr['order'],
				'orderby'        => $attr['orderby'],
				'include'        => $attr['include'],
				'exclude'        => $attr['exclude'],
			)
		);

		if ( count( $attachments ) < 1 ) {
			return false;
		}

		$gallery_instance = sprintf( 'owl-carousel-%d-%d', $attr['id'], ++$this->instance_count );

		$gallery = array();
		foreach ( $attachments as $attachment ) {
			$attachment_image_src   = wp_get_attachment_image_src( $attachment->ID, $attr['size'] );
			$attachment_image_menu_order   = $attachment->menu_order;
			$attachment_image_width   = $attachment_image_src[1]; // [url, width, height]
			$attachment_image_src   = $attachment_image_src[0]; // [url, width, height]
			$attachment_image_title = get_the_title( $attachment->ID );
			$attachment_image_alt   = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
			/**
			 * Filters the owlcarousel slide caption.
			 *
			 * @module shortcodes
			 *
			 * @since 2.3.0
			 *
			 * @param string wptexturize( strip_tags( $attachment->post_excerpt ) ) Post excerpt.
			 * @param string $attachment ->ID Attachment ID.
			 */
			$caption = apply_filters( 'jetpack_owlcarousel_slide_caption', wptexturize( strip_tags( $attachment->post_excerpt ) ), $attachment->ID );

			$gallery[] = (object) array(
				'src'     => (string) esc_url_raw( $attachment_image_src ),
				'menu_order'     => (string) $attachment_image_menu_order,
				'width'     => (string) $attachment_image_width,
				'id'      => (string) $attachment->ID,
				'title'   => (string) esc_attr( $attachment_image_title ),
				'alt'     => (string) esc_attr( $attachment_image_alt ),
				'caption' => (string) $caption,
			);
		}

		$js_attr = array(
			'gallery'   => $gallery,
			'selector'  => $gallery_instance,
			'trans'     => $attr['trans'] ? $attr['trans'] : 'fade',
			'autostart' => $attr['autostart'] ? $attr['autostart'] : 'true',
			'loop'     => $attr['loop'] ? $attr['loop'] : 'true',
			'margin'     => $attr['margin'] ? $attr['margin'] : 0,
			'center'     => $attr['center'] ? $attr['center'] : 'false',
			'controls'     => $attr['controls'] ? $attr['controls'] : 'false',
			'indicators'     => $attr['indicators'] ? $attr['indicators'] : 'true',
			'autoplay'     => $attr['autoplay'] ? $attr['autoplay'] : 'false',
			'timeout'     => $attr['timeout'] ? $attr['timeout'] : '5000',
			'items'     => $attr['items'] ? $attr['items'] : '4',
			'slideby'     => $attr['slideby'] ? $attr['slideby'] : '4',
			'responsive'     => $attr['responsive'] ? $attr['responsive'] : '',
			'animateout'     => $attr['animateout'] ? $attr['animateout'] : 'fadeOut',
			'animatein'     => $attr['animatein'] ? $attr['animatein'] : '',
		);

		// Show a link to the gallery in feeds.
		if ( is_feed() ) {
			return sprintf(
				'<a href="%s">%s</a>',
				esc_url( get_permalink( $post->ID ) . '#' . $gallery_instance . '-owlcarousel' ),
				esc_html__( 'Click to view owlcarousel.', 'jetpack' )
			);
		}

		return $this->gallery_shortcode( $js_attr );
	}

	/**
	 * Render the owlcarousel js
	 *
	 * Returns the necessary markup and js to fire a owlcarousel.
	 *
	 * @param $attr array Attributes for the owlcarousel.
	 *
	 * @uses $this->enqueue_scripts()
	 *
	 * @return string HTML output.
	 */
	function gallery_shortcode( $attr ) {

		$output = '';


		$output .= '<div id="' . $attr['selector'] . '"
	      class="owl-carousel"
	      data-loop="' . $attr['loop'] . '"
	      data-margin="' . $attr['margin'] . '"
	      data-center="' . $attr['center'] . '"
	      data-controls="' . $attr['controls'] . '"
	      data-indicators="' . $attr['indicators'] . '"
	      data-autoplay="' . $attr['autoplay'] . '"
	      data-timeout="' . $attr['timeout'] . '"
	      data-items="' . $attr['items'] . '"
	      data-slideby="' . $attr['slideby'] . '"
	      data-responsive="' . $attr['responsive'] . '"
	      data-animateout="' . $attr['animateout'] . '"
	      data-animatein="' . $attr['animatein'] . '"
	      >';


		$items = $attr['gallery'];

		$i = 0;
		foreach ( $items as $item_id => $item )
		{
			//$full   = wp_get_attachment_image_src( $item->ID, 'full', false );               // full size
			//$thumb  = wp_get_attachment_image_src( $item->ID, $vars['image_size'], false );  // thumbnail size
			//$link = '';
			//if($vars['link'] == 'file')$link=$full[0];
			//if($vars['link'] == 'attachment')$link=get_attachment_link( $item->ID );
			//$link   = ( $vars['file'] ) ? $full[0] : get_attachment_link( $item_id );
			//$text   = wpautop( wptexturize( $item->post_content ) );


			$output .= '<div data-menuorder="'.$item->menu_order.'" class="item-' . $item->id . '" class="' . ( ( $i == 0 ) ? "active" : "" ) . ' item">';
			$output .= '<img src="' . $item->src . '" width="' . $item->width . '" alt="' . $item->alt . '"/>';

			$output .= '<div class="carousel-caption">';

			$output .= '<h3 class="carousel-post-title">' . $item->title . '</h3>';

			$output .= apply_filters( 'owl_carousel_caption_text', $item->caption );

			$output .= '</div>'; // caption

			$output .= '</div>'; // item

			$i++;
		}
		$output .= '</div>'; // carousel

		/*$output .= '<p class="jetpack-owlcarousel-noscript robots-nocontent">' . esc_html__( 'This owlcarousel requires JavaScript.', 'jetpack' ) . '</p>';
		$output .= sprintf(
			'<div id="%s" class="owlcarousel-window jetpack-owlcarousel" data-trans="%s" data-autostart="%s" data-gallery="%s"></div>',
			esc_attr( $attr['selector'] . '-owlcarousel' ),
			esc_attr( $attr['trans'] ),
			esc_attr( $attr['autostart'] ),
			_wp_specialchars( wp_check_invalid_utf8( $gallery ), ENT_QUOTES, false, true )
		);*/

		return $output;
	}


	public static function init() {
		$gallery = new Jetpack_Owlcarousel_Shortcode;
	}
}

add_action( 'init', array( 'Jetpack_Owlcarousel_Shortcode', 'init' ) );
