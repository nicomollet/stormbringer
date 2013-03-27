<?php
/**
 * Carousel shortcode
 *
 * @package StormBringer
 * @since StormBringer 0.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Stormbringer_Bootstrap_Carousel' ) ) {

  /**
   * Stormbringer_Bootstrap_Carousel class
   */
  class Stormbringer_Bootstrap_Carousel
  {
    var $version = '0.1.1';
    var $plugin_dir_url = '';

    function Stormbringer_Bootstrap_Carousel()
    {
      $this->__construct();
    }
    function __construct()
    {
      $this->plugin_dir_url = trailingslashit( plugins_url( dirname( plugin_basename( __FILE__ ) ) ) );

      if ( ! is_admin() || defined( 'DOING_AJAX' ) ) :

        add_action( 'init', array( &$this, 'init' ), 10 );


      endif;

    }
    function init()
    {
      add_shortcode( 'carousel', array( &$this, 'shortcode' ) );

      do_action( 'stormbringer_bootstrap_carousel_init' );
    }
    function shortcode( $atts )
    {
      $data       = (array) $this->get_data( $atts );
      $items      = (array) $data['query'];
      $vars       = (array) $data['vars'];
      $parent     = isset( $vars['id'] ) && (int) $vars['id'] ? (int) $vars['id'] : '';
      $width_int  = $vars['width'];
      $interval  = $vars['interval'];
      $pause  = $vars['pause'];
      $start  = $vars['start'];

      global $post;

      if( ! $parent || ! $items )
        return apply_filters( 'stormbringer_bootstrap_carousel_no_results', false );

      if( is_feed() )
        return apply_filters(
          'stormbringer_bootstrap_carousel_feed',
          '<a href="' . get_permalink( $post ) . '#bootstrap-carousel-' . $vars['id'] . '">' . __( 'Click here to view the embedded slideshow.', 'wp_bootstrap_carousel' ) . '</a>',
          $vars
        );


      $carousel = '';

      $carousel .= '
<div id="bootstrap-carousel-' . $vars['id'] . '" class="carousel' . ( ( $vars['slide'] ) ? " slide" : "" ) . '"'.($width_int?' style="width:' . $width_int. ';"':'').($interval?' data-interval="' . $interval. '"':'').($pause?' data-pause="' . $pause. '"':'').' >
';
      $i = 0;
      $carousel_indicators ='';
      $carousel_inner ='';
      foreach ( $items as $item_id => $item )
      {
        $carousel_indicators .= '<li data-target="#bootstrap-carousel-' . $vars['id'] . '" data-slide-to="'.$i.'"'.($i==0?' class="active"':'').'></li>';
        $full   = wp_get_attachment_image_src( $item_id, 'full', false );               // full size
        $thumb  = wp_get_attachment_image_src( $item_id, $vars['image_size'], false );  // thumbnail size
        $link   = ( $vars['file'] ) ? $full[0] : get_attachment_link( $item_id );
        $text   = wpautop( wptexturize( $item->post_content ) );

        $carousel_inner .= '<div id="item-' . $item_id . '" class="' . ( ( $i == 0 ) ? "active" : "" ) . ' item">
                <a class="' . ( ( $vars['file'] && $vars['thickbox'] ) ? "thickbox " : "" ) . '" rel="' . $vars['rel'] . '" href="' . $link . '"><img src="' . $thumb[0] . '" width="' . $vars['width'] . '" alt="' . $item->post_title . '"/></a>';

        $carousel_inner .= '<div class="carousel-caption">';

        $carousel_inner .= '<h4>' . $item->post_title;

        if( $vars['comments'] && comments_open( $item_id ) ) :

          $comments = ( get_comments_number( $item_id ) != 0 ) ? sprintf( _n( '1 Comment', '%1$s Comments', get_comments_number( $item_id ), 'wp_bootstrap_carousel' ), number_format_i18n( get_comments_number( $item_id ) ) ) : __( '0 Comments', 'wp_bootstrap_carousel' );

          $carousel_inner .= '<span class="carousel-comments-link">
                    <a href="' . get_comments_link( $item_id ) . '" rel="bookmark">' . $comments . '</a>
                </span>';

        endif;

        $carousel_inner .= '</h4>';
        $carousel_inner .= apply_filters( 'stormbringer_bootstrap_carousel_caption_text', $text, $item_id );
        $carousel_inner .= '</div>';
        $carousel_inner .= '</div>';
        $i++;
      }
      $carousel .= '<ol class="carousel-indicators">'.$carousel_indicators.'</ol>';
      $carousel .= '<div class="carousel-inner">'.$carousel_inner.'</div>';
      $carousel .='
<a class="carousel-control left" href="#bootstrap-carousel-' . $vars['id'] . '" data-slide="prev">' . __( '&lsaquo;', 'wp_bootstrap_carousel' ) . '</a>
<a class="carousel-control right" href="#bootstrap-carousel-' . $vars['id'] . '" data-slide="next">' . __( '&rsaquo;', 'wp_bootstrap_carousel' ) . '</a>
</div>';
      if($start==1) :
        $carousel .= '
        <script type="text/javascript">
        $(document).ready(function() {
          $("#bootstrap-carousel-' . $vars['id'] . '").carousel();
        });
        </script>
        ';
      endif;
      return $carousel;
    }
    public function get_data( $atts )
    {
      global $post, $content_width;

      $id = intval( $post->ID );
      $thumbnail_id = get_post_meta( $id, '_thumbnail_id', true );

      $defaults = array(

        'post_parent'       => $id,
        'post_status'       => 'inherit',
        'post_type'         => 'attachment',
        'post_mime_type'    => 'image',
        'exclude'           => $thumbnail_id,
        'order'             => 'ASC',
        'orderby'           => 'ID',

        'width'             => ( isset( $content_width ) ) ? $content_width : '',
        'image_size'        => 'large',
        'rel'               => '',
        'file'              => 0,
        'comments'          => 0,
        'slide'             => 1,

        'interval'          => 5000,
        'pause'             => 'hover',
        'start'             => 1,
        'thickbox'          => 0,

      );
      $atts = apply_filters( 'stormbringer_bootstrap_carousel_shortcode_atts', $atts );

      $atts = wp_parse_args( $atts, $defaults );

/*
      $atts = shortcode_atts( apply_filters( 'stormbringer_bootstrap_carousel_shortcode_atts', array(

        'post_parent'       => $id,
        'post_status'       => 'inherit',
        'post_type'         => 'attachment',
        'post_mime_type'    => 'image',
        'exclude'           => $thumbnail_id,
        'order'             => 'ASC',
        'orderby'           => 'ID',

        'width'             => ( isset( $content_width ) ) ? $content_width : '',
        'image_size'        => 'large',
        'rel'               => '',
        'file'              => 0,
        'comments'          => 0,
        'slide'             => 1,

        'interval'          => 3000,
        'pause'             => 'hover',
        'start'             => 1,
        'thickbox'          => 0,

      ) ), $atts);*/

      // query vars
      $post_parent    = intval( $atts['post_parent'] );
      $post_status    = $atts['post_status'];
      $post_type      = sanitize_text_field( $atts['post_type'] );
      $post_mime_type = sanitize_text_field( $atts['post_mime_type'] );
      $exclude        = array_map( 'intval', explode( ',', $atts['exclude'] ) );
      $order          = sanitize_key( $atts['order'] );
      $orderby        = sanitize_key( $atts['orderby'] );

      if ( 'RAND' == $order )
        $orderby = 'none';

      // display vars
      $width          = $atts['width'];
      $image_size     = sanitize_text_field( $atts['image_size'] );
      $rel            = sanitize_text_field( $atts['rel'] );
      $file           = (bool)$atts['file'];
      $comments       = (bool)$atts['comments'];
      $slide          = (bool)$atts['slide'];

      // js vars
      $interval       = intval( $atts['interval'] );
      $pause          = sanitize_text_field( $atts['pause'] );
      $start          = sanitize_text_field( $atts['start'] );
      $thickbox       = (bool)$atts['thickbox'];

      // query vars array
      $args = array(
        'post_parent'       => $post_parent,
        'post_status'       => $post_status,
        'post_type'         => $post_type,
        'post_mime_type'    => $post_mime_type,
        'exclude'           => $exclude,
        'order'             => $order,
        'orderby'           => $orderby
      );

      // display vars array
      $vars = array(
        'id'                => $post_parent,
        'width'             => $width,
        'image_size'        => $image_size,
        'rel'               => $rel,
        'file'              => $file,
        'comments'          => $comments,
        'slide'             => $slide,

        'interval'          => $interval,
        'pause'             => $pause,
        'start'             => $start,
        'thickbox'          => $thickbox,
      );

      // data array
      $data = array(
        'query' => get_children( $args ),
        'vars' => $vars
      );

      return $data;
    }


  } // class

  /**
   * Init Stormbringer_Bootstrap_Carousel class
   *
   * Initializes the main plugin class
   *
   * @since WP Bootstrap Carousel 0.1
   */

  $GLOBALS['wp_bootstrap_carousel'] = new Stormbringer_Bootstrap_Carousel();

} // class_exists check