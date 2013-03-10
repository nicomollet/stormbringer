<?php
// ********************************************
// Theme My Login
// ********************************************
/*
function thememylogin_shortcode_lostpassword() {
  return  do_shortcode('[stormbringer default_action="lostpassword" show_title=0 login_template="form-login.php" register_template="form-register.php" lostpassword_template="form-lostpassword.php" resetpass_template="form-resetpass.php" profile_template="form-profile.php"]');
}
add_shortcode('form-lostpassword', 'thememylogin_shortcode_lostpassword');

function thememylogin_shortcode_register() {
  return  do_shortcode('[stormbringer default_action="register" show_title=0 login_template="form-login.php" register_template="form-register.php" lostpassword_template="form-lostpassword.php" resetpass_template="form-resetpass.php" profile_template="form-profile.php"]');
}
add_shortcode('form-register', 'thememylogin_shortcode_register');

function thememylogin_shortcode_login() {
  return  do_shortcode('[stormbringer default_action="login" show_title=0 login_template="form-login.php" register_template="form-register.php" lostpassword_template="form-lostpassword.php" resetpass_template="form-resetpass.php" profile_template="form-profile.php"]');
}
add_shortcode('form-login', 'thememylogin_shortcode_login');

function thememylogin_shortcode_resetpass() {
  return  do_shortcode('[stormbringer default_action="resetpass" show_title=0 login_template="form-login.php" register_template="form-register.php" lostpassword_template="form-lostpassword.php" resetpass_template="form-resetpass.php" profile_template="form-profile.php"]');
}
add_shortcode('form-resetpass', 'thememylogin_shortcode_resetpass');

function thememylogin_shortcode_profile() {
  return  do_shortcode('[stormbringer default_action="profile" show_title=0 login_template="form-login.php" register_template="form-register.php" lostpassword_template="form-lostpassword.php" resetpass_template="form-resetpass.php" profile_template="form-profile.php"]');
}
add_shortcode('form-profile', 'thememylogin_shortcode_profile');
*/

/*
//changing the default registration form
function thememylogin_default_templates($link){
//var_dump($link);
//exit;
//$link = dirname(__FILE__).'/form-login.php';
//$link = 'form-login.php';
$link = str_replace(get_stylesheet_directory().'/','',$link);
$link = str_replace(TML_ABSPATH . '/templates/','',$link);
$link = str_replace('-form','',$link);
//print_r('<br>555');
//print_r($link );
$link = locate_template('form-'.$link);
return $link;
}
*/

function stormbringer_thememylogin_options(){

  $defaults = array(
    'action_login' => __( 'Identification', "stormbringer" ),
    'action_lostpassword' => __( 'Mot de passe oublié', "stormbringer" ),
    'action_retrievepassword' => __( 'Mot de passe oublié', "stormbringer" ),
    'action_resetpass' => __( 'Mot de passe oublié', "stormbringer" ),
    'action_register' => __( 'Créer un compte', "stormbringer" ),
    'action_profile' => __( 'Votre compte', "stormbringer" ),
    'message_noaccount' => __('Pas encore de compte','stormbringer'),
    'message_error' => __( 'Erreur', "stormbringer" ),
    'message_info' => __( 'Info', "stormbringer" ),
    'message_success' => __( 'Success', "stormbringer" ),
    'menu_login' => __( 'S\'identifier', "stormbringer" ),
    'menu_logout' => __( 'Se déconnecter', "stormbringer" ),
  );
  /* Apply filters to the arguments. */
  $args = apply_filters( 'thememylogin_options', $args );

  /* Parse the arguments and extract them for easy variable naming. */
  $args = wp_parse_args( $args, $defaults );
  return $args;
}

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


function stormbringer_thememylogin_errors($errors){

  $args = stormbringer_thememylogin_options();

  if($errors){

  if (strpos($errors, 'class="error"') !== false)
  $class='error';
  if (strpos($errors, 'class="message"') !== false)
  $class='success';

  $errors = str_replace(strtoupper(str_replace('!',':',__('Error!'))),'',strip_tags($errors,'<span><br>'));
  printf('<div class="alert alert-'.$class.'"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>'.$args['message_'.$class].'</h4>%s</div>',$errors);
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

