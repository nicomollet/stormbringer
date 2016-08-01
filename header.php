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

<body <?php body_class(''); ?> data-grid-framework="bo" data-grid-color="yellow" data-grid-opacity="0.2" data-grid-zindex="-30" data-grid-nbcols="12">

<!--[if lt IE 7]>
<p id="browsernotsupported" class="alert"><?php _e('You are using an outdated browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'stormbringer');?></p>
<![endif]-->

<div id="wrapper">

  <header role="banner" id="header">

    <?php if(is_home()) : ?>
        <h1 id="logo">
            <a href="<?php echo home_url(); ?>" title="<?php echo esc_attr(get_bloginfo('description')); ?>"><?php bloginfo('name'); ?></a>
        </h1>
    <?php else : ?>
        <p id="logo">
            <a href="<?php echo home_url(); ?>" title="<?php echo esc_attr(get_bloginfo('description')); ?>"><?php bloginfo('name'); ?></a>
        </p>
    <?php endif;?>

    <nav id="navigation" role="navigation" class="navbar-stuckonscrolltop">
      <div class="navigation-inner">
	      <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation-collapse" aria-expanded="false" aria-controls="navbar">
			      <span class="sr-only">Toggle navigation</span>
			      <span class="icon-bar top-bar"></span>
			      <span class="icon-bar middle-bar"></span>
			      <span class="icon-bar bottom-bar"></span>
		      </button>
		      <a class="navbar-brand" title="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
	      </div>

        <div class="collapse navbar-collapse" id="navigation-collapse">
          <?php wp_nav_menu(array('theme_location' => 'main_nav', 'depth' => 2, 'container' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new stormbringer_Navbar_Nav_Walker(), 'fallback_cb' => false)); ?>

	        <?php
	        // Theme My Login menu
	        if(class_exists( 'Theme_My_Login')) :
		        $current_user = wp_get_current_user();
	        ?>
	        <ul class="nav navbar-nav navbar-right navbar-account">
		        <?php
		        $args = array(
			        'numberposts' => '-1',
			        'post_type' => 'page',
			        'meta_key' => '_tml_action',
			        'meta_value' => array('register', 'login', 'lostpassword', 'resetpass', 'logout', 'profile'),
		        );
		        $get_tml_actions_posts = get_posts($args);
		        foreach($get_tml_actions_posts as $post){
			        $action = get_post_meta($post->ID, '_tml_action',true);
			        $link[$action] = get_permalink($post->ID);
			        $title[$action] = $post->post_title;
		        }
		        if ( 0 == $current_user->ID ) : // logged out
		        ?>
			        <li><a href="<?php echo $link['login']; ?>"><?php echo $title['login']; ?></a></li>
			        <li><a href="<?php echo $link['register']; ?>"><?php echo $title['register']; ?></a></li>
		        <?php else : // logged in ?>
			        <li class="dropdown">
				        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $current_user->user_login;?> <span class="caret"></span></a>
				        <ul class="dropdown-menu" role="menu">
					        <li><a href="<?php echo $link['profile']; ?>"><?php echo $title['profile']; ?></a></li>
					        <li class="divider"></li>
					        <li><a href="<?php echo $link['logout']; ?>"><?php echo $title['logout']; ?></a></li>
				        </ul>
			        </li>
		        <?php endif; ?>
	        </ul>
	        <?php endif; ?>

	        <?php
	        // Woocommerce shopping cart
	        if (current_theme_supports('woocommerce')) :
	        ?>
	        <ul class="nav navbar-nav navbar-right navbar-shoppingcart">
		        <?php echo stormbringer_shoppingcart_menu(); ?>
	        </ul>
	        <?php endif; ?>


        </div>
        <!-- /.navbar-collapse -->


      </div>
    </nav>
    <!-- #navigation -->

  </header>

  <div class="main-wrapper">
    <div id="main">
      <div class="main-inner">