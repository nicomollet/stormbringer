<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'WP_Bootstrap_Owl_Carousel' ) ) {

  /**
   * WP_Bootstrap_Carousel class
   */
  class WP_Bootstrap_Owl_Carousel
  {
    var $version        = '0.0.1';

    /**
     * Constructor
     */
    public function __construct()
    {

      if ( ! is_admin() || defined( 'DOING_AJAX' ) ) :
        add_action( 'init',                 array( $this, 'init' ),                 10 );
        add_action( 'body_class',           array( $this, 'body_class' ),           10 );
      endif;

    }

    public function init()
    {

      add_shortcode( 'owl-carousel', array( $this, 'shortcode' ) );

      do_action( 'wp_bootstrap_carousel_init' );
    }
    public function shortcode( $atts )
    {
      $data       = (array) $this->get_data( $atts );
      $items      = (array) $data['query'];
      $vars       = (array) $data['vars'];
      $parent     = isset( $vars['id'] ) && (int) $vars['id'] ? (int) $vars['id'] : '';
      //$width_int  = str_replace( array( '%', 'px' ), '', $vars['width'] );

      global $post;


      $carousel = '';

      $carousel .= '<div id="owl-carousel-' . $vars['id'] . '"
      class="owl-carousel"
      data-loop="' . $vars['loop'] . '"
      data-margin="' . $vars['margin'] . '"
      data-center="' . $vars['center'] . '"
      data-controls="' . $vars['controls'] . '"
      data-indicators="' . $vars['indicators'] . '"
      data-autoplay="' . $vars['autoplay'] . '"
      data-timeout="' . $vars['timeout'] . '"
      data-items="' . $vars['items'] . '"
      data-slideby="' . $vars['slideby'] . '"
      data-responsive="' . $vars['responsive'] . '"
      data-animateout="' . $vars['animateout'] . '"
      data-animatein="' . $vars['animatein'] . '"
      >';

      /**
       * INDICATORS
       */
      /*if( $vars['controls'] )
      {
        $carousel .= '<ol class="carousel-indicators">';
        $o = 0;
        foreach ( $items as $item )
        {
          $carousel .= '<li data-target="#owl-carousel-' . $vars['id'] . '" data-slide-to="' . $o . '" class="' . ( ( $o == 0 ) ? "active" : "" ) . '"></li>'."\n";
          $o++;
        }
        $carousel .= '</ol>';
      }*/

      /**
       * ITEMS
       */
      //$carousel .= '<div class="carousel-inner">';

      $i = 0;
      foreach ( $items as $item_id => $item )
      {
        $full   = wp_get_attachment_image_src( $item_id, 'full', false );               // full size
        $thumb  = wp_get_attachment_image_src( $item_id, $vars['image_size'], false );  // thumbnail size
        $link = '';
        if($vars['link'] == 'file')$link=$full[0];
        if($vars['link'] == 'attachment')$link=get_attachment_link( $item_id );
        //$link   = ( $vars['file'] ) ? $full[0] : get_attachment_link( $item_id );
        $text   = wpautop( wptexturize( $item->post_content ) );

        $carousel .= '<div class="item-' . $item_id . '" class="' . ( ( $i == 0 ) ? "active" : "" ) . ' item">';
        if($link!='')$carousel .= '<a class="" rel="' . $vars['rel'] . '" href="' . $link . '">';
        $carousel .= '<img src="' . $thumb[0] . '" width="' . $vars['width'] . '" alt="' . $item->post_title . '"/>';
        if($link!='')$carousel .= '</a>';

        $carousel .= '<div class="carousel-caption">';

        $carousel .= '<h3 class="carousel-post-title">' . $item->post_title . '</h3>';

        $carousel .= apply_filters( 'owl_carousel_caption_text', $text, $item_id );

        $carousel .= '</div>'; // caption

        $carousel .= '</div>'; // item

        $i++;
      }

      //$carousel .= '</div>'; // carousel-inner

      /**
       * CONTROLS
       */
      /*if( $vars['controls'] )
        $carousel .= '
  <a class="carousel-control left" href="#owl-carousel-' . $vars['id'] . '" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
  <a class="carousel-control right" href="#owl-carousel-' . $vars['id'] . '" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>';
*/
      $carousel .= '</div>'; // carousel

      return $carousel;
    }

    public function get_data( $atts )
    {
      global $post;

      $id = intval( $post->ID );
      $thumbnail_id = get_post_meta( $id, '_thumbnail_id', true );
      $atts = shortcode_atts( apply_filters( 'stormbringer_owlcarousel_shortcode_atts', array(

          'post_parent'    => $id,
          'post_status'    => 'inherit',
          'post_type'      => 'attachment',
          'post_mime_type' => 'image',
          'exclude'        => $thumbnail_id,
          'order'          => 'ASC',
          'orderby'        => 'ID',


          'image_size' => 'large',
          'rel'        => '',
          'file'       => 1,
          'link'       => '', // file, attachment

          'margin'       => 0,
          'loop'       => 'true',
          'center'     => 'false',
          'controls'   => 'false',
          'indicators' => 'true',
          'autoplay'   => 'false',
          'timeout'    => '5000',
          'items'      => '4',
          'slideby'    => '4',
          'responsive' => null,
          'animateout' => 'fadeOut',
          'animatein' => '',

      ) ), $atts, 'owl-carousel' );
      // query vars
      $post_parent    = intval( $atts['post_parent'] );
      $post_status    = sanitize_text_field( $atts['post_status'] );
      $post_type      = sanitize_text_field( $atts['post_type'] );
      $post_mime_type = sanitize_text_field( $atts['post_mime_type'] );
      $exclude        = array_map( 'intval', explode( ',', $atts['exclude'] ) );
      $order          = sanitize_key( $atts['order'] );
      $orderby        = sanitize_key( $atts['orderby'] );
      $loop        = sanitize_key( $atts['loop'] );
      $margin        = sanitize_key( $atts['margin'] );
      $center        = sanitize_key( $atts['center'] );
      $controls        = sanitize_key( $atts['controls'] );
      $indicators        = sanitize_key( $atts['indicators'] );
      $autoplay        = sanitize_key( $atts['autoplay'] );
      $timeout        = sanitize_key( $atts['timeout'] );
      $items          = sanitize_key( $atts['items'] );
      $slideby        = sanitize_key( $atts['slideby'] );
      $responsive        = ( $atts['responsive'] );
      $animateout        = ( $atts['animateout'] );
      $animatein        = ( $atts['animatein'] );

      if ( 'RAND' == $order )
        $orderby = 'none';

      // display vars
      $image_size     = sanitize_text_field( $atts['image_size'] );
      $rel            = sanitize_text_field( $atts['rel'] );
      $file           = $this->wp_bc_bool( $atts['file'] );
      $link           = $this->wp_bc_bool( $atts['link'] );


      // query vars array
      $args = array(
        'post_parent'       => $post_parent,
        'post_status'       => $post_status,
        'post_type'         => $post_type,
        'post_mime_type'    => $post_mime_type,
        'exclude'           => $exclude,
        'order'             => $order,
        'orderby'           => $orderby,
      );

      // display vars array
      $vars = array(
          'id'         => $post_parent,
          'image_size' => $image_size,
          'rel'        => $rel,
          'file'       => $file,
          'link'       => $link,
          'loop'       => $loop,
          'margin'       => $margin,
          'center'     => $center,
          'controls'        => $controls,
          'indicators'        => $indicators,
          'autoplay'        => $autoplay,
          'timeout'        => $timeout,
          'items'        => $items,
          'slideby'        => $slideby,
          'responsive'        => $responsive,
          'animatein'        => $animatein,
          'animateout'        => $animateout,
      );

      // data array
      $data = array(
        'query' => get_children( $args ),
        'vars' => $vars
      );

      return $data;
    }

    public function body_class( $classes )
    {
      $classes[] = 'owl-carousel-' . sanitize_html_class( strtolower( wp_get_theme()->Name ) );

      return $classes;
    }

    /**
     * Convert string to boolean
     *
     * @since  WP Bootstrap Carousel 0.2.1
     * @param  string $value true/on/yes/1, or false/off/no/0
     * @return bool          true or false
     */
    private function wp_bc_bool( $value )
    {
      return filter_var( $value, FILTER_VALIDATE_BOOLEAN );
    }
  } // class




  /**
   * Init WP_Bootstrap_Carousel class
   *
   * Initializes the main plugin class
   *
   * @since WP Bootstrap Carousel 0.1
   */

  $GLOBALS['wp_bootstrap_owl_carousel'] = new WP_Bootstrap_Owl_Carousel();

} // class_exists check



/*
To edit default vars of the Carousel, use this function in functions.php:
function custom_owlcarousel_shortcode_atts($defaults){
  $args = array(
    'order'             => 'ASC', // Order
    'orderby'           => 'ID', // Orderby
    'image_size'        => 'large', // Image size
    'rel'               => '', // Rel attribute
    'file'              => 0, // Link image to attachement page
    'link'              => '', // Link image to attachement page
    'loop'           => 'true', // Owlcarousel loop
    'margin'           => 0, // Owlcarousel margin
    'center'           => 'false', // Owlcarousel center
    'controls'           => 'false', // Owlcarousel nav
    'indicators'           => 'true', // Owlcarousel dots
    'autoplay'           => 'false', // Owlcarousel autoplay
    'timeout'           => '5000', // Owlcarousel autoplayTimeout
    'items'           => '4', // Owlcarousel items
    'slideby'           => '4', // Owlcarousel slideBy
    'responsive'           => null, // Owlcarousel responsive
    'animateout'           => 'fadeOut', // Owlcarousel animateOut
    'animatein'           => '', // Owlcarousel animateIn
  );
  $args = wp_parse_args( $args, $defaults );
  return $args;
}
add_filter('stormbringer_owlcarousel_shortcode_atts', 'custom_owlcarousel_shortcode_atts');
*/