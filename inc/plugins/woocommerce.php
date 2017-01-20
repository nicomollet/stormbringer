<?php

/**
 * Woocommerce: Customize add to cart link
 */
function stormbringer_woocommerce_loop_add_to_cart_link( $html, $product ) {

    $class = 'btn btn-default';
    $html = sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
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
function stormbringer_wc_add_to_cart_message($message) {

    $message = str_replace('button', 'btn btn-default', $message);
    return $message;
}

//add_filter('wc_add_to_cart_message', 'stormbringer_wc_add_to_cart_message' );

/**
 * Woocommerce: Change number or products per row to 3
 *
 * @return int
 */
function stormbringer_loop_columns() {
    return 3; // 3 products per row
}
add_filter('loop_shop_columns', 'stormbringer_loop_columns', 1, 10);


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
    $cart_item_key = $cart_item_key;
    $button = __( 'Remove this item', 'woocommerce' );
    $button = '<span class="glyphicon glyphicon-remove"></span>';
    $wsis_html = sprintf( '<a href="%s" class="remove" title="%s"><span class="wsis-remove-item">%s</span></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ), $button);
    return $wsis_html;
}

add_filter ( 'woocommerce_cart_item_remove_link', 'wsis_woocommerce_remove_item', 10, 2 );

/**
 * Woocommerce: Customize form fields
 *
 * @param      $args
 * @param      $key
 * @param null $value
 *
 * @return mixed
 */
function wc_form_field_args($args, $key, $value = null)
{

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

    $args['class'][] = $args['type'];

    switch ($args['type']) {

        case "select" :  /* Targets all select input type elements, except the country and state select input types */
            $args['class'][]
                                 = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag
            $args['input_class'] = array('form-control', 'input-lgg'); // Add a class to the form input itself
            //$args['custom_attributes']['data-plugin'] = 'select2';
            $args['label_class']       = array('control-label');
            $args['custom_attributes'] = array('data-plugin' => 'select2', 'data-allow-clear' => 'true',
                                               'aria-hidden' => 'true',); // Add custom data attributes to the form input itself
            break;

        case 'country_select' :
        case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
            //$args['input_class'] = array('form-control');
            $args['class'][]     = 'form-group single-country';
            $args['label_class'] = array('control-label');
            break;

        case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
            $args['class'][]     = 'form-group'; // Add class to the field's html element wrapper
            $args['input_class'] = array('form-control', 'input-lgg'); // add class to the form input itself
            //$args['custom_attributes']['data-plugin'] = 'select2';
            $args['label_class']       = array('control-label');
            $args['custom_attributes'] = array('data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',);
            break;


        case "password" :
        case "text" :
        case "email" :
        case "tel" :
        case "number" :
            $args['class'][] = 'form-group';
            //$args['input_class'][] = 'form-control input-lgg'; // will return an array of classes, the same as bellow
            $args['input_class'] = array('form-control', 'input-lgg');
            $args['label_class'] = array('control-label');
            break;

        case 'textarea' :
            $args['input_class'] = array('form-control', 'input-lgg');
            $args['label_class'] = array('control-label');
            break;

        case 'checkbox' :
            break;

        case 'radio' :
            break;

        default :
            $args['class'][]     = 'form-group';
            $args['input_class'] = array('form-control', 'input-lgg');
            $args['label_class'] = array('control-label');
            break;
    }

    return $args;
}
//add_filter('woocommerce_form_field_args', 'wc_form_field_args', 10, 3);


/**
 * Woocommerce: customize payement button
 *
 * @param $button
 *
 * @return mixed
 */
function strombringer_woocommerce_order_button_html($button){

    $button = str_replace('button', 'button btn btn-block btn-lg btn-primary', $button);
    return $button;
}
//add_filter('woocommerce_order_button_html', 'strombringer_woocommerce_order_button_html');

/**
 * Woocommerce: Account filter account menu item classes
 *
 * @param $classes
 * @param $endpoint
 *
 * @return array
 */
function custom_woocommerce_account_menu_item_classes( $classes, $endpoint ) {
    global $wp;

    // Set current item class.
    $current = isset( $wp->query_vars[ $endpoint ] );
    if ( 'dashboard' === $endpoint && ( isset( $wp->query_vars['page'] ) || empty( $wp->query_vars ) ) ) {
        $current = true;
    }

    if ( $current ) {
        $classes[] = 'active';
    }

    return $classes;
}
add_filter( 'woocommerce_account_menu_item_classes', 'custom_woocommerce_account_menu_item_classes', 10, 2 );