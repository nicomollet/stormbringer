<?php
/**
 * The template for displaying the Header.
 *
 * @package StormBringer
 * @since StormBringer 0.1
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
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->

<head>
  <meta charset="utf-8">

  <title>
  <?php
    wp_title( '|', true, 'right' );
  ?>
  </title>

  <?php wp_head(); ?>
  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e('Flux RSS', 'stormbringer');?>" href="<?php echo home_url(); ?>/feed/">

  <?php
  // check current user
  global $current_user;
  global $user_level;
  get_currentuserinfo();
  ?>
  <script type="text/javascript">
  // add in-frame class
  if(self !== top){
    document.documentElement.className ='in-iframe';
  }
  </script>
</head>

<body <?php body_class(''); ?> data-grid-framework="bo" data-grid-color="blue" data-grid-opacity="0.5" data-grid-zindex="10" data-grid-nbcols="12">

<!--[if lt IE 7]>
<p id="browsernotsupported"><?php _e('Votre navigateur est obsolète, <a href="http://browsehappy.com/">téléchargez un navigateur plus moderne</a> pour une bonne utilisation de ce site.', 'stormbringer');?>
</p><![endif]-->

<div id="header-container">
  <div class="container">
    <div class="row">

      <header role="banner" id="header" class="span12">

        <div id="main-menu-container">
          <div class="<?php echo apply_filters( 'stormbringer_main_navbar_class' , 'navbar navbar-inverse'); ?>">
            <div class="navbar-inner">
              <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".main-menu">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </a>
                <a class="brand" id="logo" title="<?php echo esc_attr(get_bloginfo('description')); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
                <nav role="navigation" class="main-menu nav-collapse collapse navbar-responsive-collapse">
                  <?php wp_nav_menu( array( 'theme_location' => 'main_nav', 'container' => false, 'menu_class' => 'nav', 'walker' => new stormbringer_Navbar_Nav_Walker(), 'fallback_cb' => false )); ?>
                </nav><!-- .nav-collapse -->
              </div><!-- .container -->
            </div><!-- .navbar-inner -->
          </div><!-- .navbar -->
        </div><!-- #main-nav -->

      </header>
    </div>
  </div>
</div>

<div id="main">
  <div class="container">
    <div class="row">


