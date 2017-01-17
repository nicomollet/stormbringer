<?php

// ********************************************
// Theme My Login
// ********************************************

function stormbringer_thememylogin_options($args){

  $defaults = array(
    'action_login' => __( 'Sign in', "stormbringer" ),
    'action_lostpassword' => __( 'Forgot your password', "stormbringer" ),
    'action_retrievepassword' => __( 'Forgot your password', "stormbringer" ),
    'action_resetpass' => __( 'Forgot your password', "stormbringer" ),
    'action_register' => __( 'Register', "stormbringer" ),
    'action_profile' => __( 'Your account', "stormbringer" ),
    'message_error' => __( 'Error', "stormbringer" ),
    'message_info' => __( 'Info', "stormbringer" ),
    'message_success' => __( 'Success', "stormbringer" ),
    'menu_login' => __( 'Sign in', "stormbringer" ),
    'menu_logout' => __( 'Loggout', "stormbringer" ),
  );
  $args = apply_filters( 'thememylogin_options', $args );

  $args = wp_parse_args( $args, $defaults );
  return $args;
}


function stormbringer_thememylogin_enqueue_scripts() {
  wp_deregister_script('password-strength');
  wp_dequeue_style('password-strength');
}

add_action('wp_enqueue_scripts', 'stormbringer_thememylogin_enqueue_scripts',60);

function stormbringer_thememylogin_init() {
  global $theme_my_login;
  remove_filter('the_title', array(&$theme_my_login, 'the_title'), 10, 2);
  //remove_filter('single_post_title', array(&$theme_my_login, 'single_post_title'));
  remove_filter('wp_setup_nav_menu_item', array(&$theme_my_login, 'wp_setup_nav_menu_item'));
  remove_action('wp_print_footer_scripts', array(&$theme_my_login, 'print_footer_scripts'));
  remove_action('login_head', array(&$theme_my_login, 'noindex'));
  //add_filter('tml_template','thememylogin_default_templates');

}
add_action( 'init', 'stormbringer_thememylogin_init' );





/*
function stormbringer_thememylogin_the_title( $title, $post_id = 0 ) {
  global $theme_my_login;

  if ( is_admin() )
    return $title;

  if ( $theme_my_login->is_login_page( $post_id ) ) {
    //print 'aaa';
  //if ( !in_the_loop() ) {
  //  $title = is_user_logged_in() ? __( 'Log Out555', 'stormbringer' ) : __( 'Log In666', 'stormbringer' );
  //} else {
    //print '<br>request_instance: '.$theme_my_login->request_instance;
    //print '<br>request_action: '.$theme_my_login->request_action;
  $action = empty( $theme_my_login->request_instance ) ? $theme_my_login->request_action : 'login';
  $title = Theme_My_Login_Template::get_title( $action );
  //}
  }
  return $title;
}
add_filter( 'the_title', 'stormbringer_thememylogin_the_title', 10, 2 );
*/

/*
function stormbringer_thememylogin_setup_nav_menu_item( $menu_item ) {
  global $theme_my_login;

  $args = stormbringer_thememylogin_options();

  if ( 'page' == $menu_item->object && $theme_my_login->is_login_page( $menu_item->object_id ) ) {
  if ( is_user_logged_in() ) {
  $menu_item->title = $args['menu_logout'];
  $menu_item->url = wp_logout_url();
  } else {
  $menu_item->title = $args['menu_login'];
  $menu_item->url = wp_login_url();
  }
  }
  return $menu_item;
}
add_filter( 'wp_setup_nav_menu_item', 'stormbringer_thememylogin_setup_nav_menu_item' );
*/

function stormbringer_thememylogin_errors($errors){

  $args = stormbringer_thememylogin_options();

  if($errors){

  if (strpos($errors, 'class="error"') !== false){
	  $class='error';
	  $newclass='danger';
  }
  if (strpos($errors, 'class="message"') !== false){
	  $class='success';
	  $newclass='success';
  }


  $errors = str_replace(strtoupper(str_replace('!',':',__('Error!'))),'',strip_tags($errors,'<span><br>'));
  printf('<div class="alert alert-'.$newclass.'"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>'.$args['message_'.$class].'</h4><p>%s</p></div>',$errors);
  }
}

function stormbringer_thememylogin_title( $title, $action ) {

	$args = stormbringer_thememylogin_options();

	if ( is_user_logged_in() ) {
  $title = $args['action_profile'];
  } else {
  switch ( $action ) {
  case 'register' :
  $title = $args['action_register'];
  break;
  case 'lostpassword':
  $title = $args['action_lostpassword'];
  break;
  case 'retrievepassword':
  $title = $args['action_retrievepassword'];
  break;
  case 'resetpass':
  case 'rp':
  $title = $args['action_resetpass'];
  break;
  case 'login':
  default:
  $title = $args['action_login'];
  }
  }
  return $title;
}
add_filter( 'tml_title', 'stormbringer_thememylogin_title', 11, 2 );


/*
To edit the default configuration of Theme my Login, use this function in functions.php:

function custom_thememylogin_options(){
	$args = array(
		'action_login' => __( 'Identification', "stormbringer" ),
		'action_lostpassword' => __( 'Mot de passe oublié', "stormbringer" ),
		'action_retrievepassword' => __( 'Mot de passe oublié', "stormbringer" ),
		'action_resetpass' => __( 'Mot de passe oublié', "stormbringer" ),
		'action_register' => __( 'Créer un compte', "stormbringer" ),
		'action_profile' => __( 'Votre compte', "stormbringer" ),
		'message_error' => __( 'Erreur', "stormbringer" ),
		'message_info' => __( 'Info', "stormbringer" ),
		'message_success' => __( 'Succès', "stormbringer" ),
		'menu_login' => __( 'S\'identifier', "stormbringer" ),
		'menu_logout' => __( 'Se déconnecter', "stormbringer" ),
	);
	return $args;
}
add_filter('thememylogin_options', 'custom_thememylogin_options');
*/


function stormbringer_tml_template( $useTemplate, $templates ) {

	foreach( $templates as $template) {
		if($template=='login-form.php')$template='form-login.php';
		if($template=='register-form.php')$template='form-register.php';
		if($template=='profile-form.php')$template='form-profile.php';
		if($template=='lostpassword-form.php')$template='form-lostpassword.php';
		if($template=='resetpass-form.php')$template='form-resetpass.php';
		if (file_exists(  TEMPLATEPATH . '/' . $template )) {
			$useTemplate =  TEMPLATEPATH . '/' . $template  ;
			break;
		}
	}
	return $useTemplate ;

}
add_filter( 'tml_template', 'stormbringer_tml_template', 10, 3 );

// Menu icon for ThemeMyLogin
function thememylogin_menu_icon(){

	print '<style type="text/css">';
	print '#toplevel_page_theme_my_login .wp-menu-image img{display:none}';
	print '#toplevel_page_theme_my_login .wp-menu-image:before {';
	print ' content: "\f112" !important;';
	print '}';
	print '</style>';
}
add_action( 'admin_head', 'thememylogin_menu_icon',30 );