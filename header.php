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
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->

<head>
<meta charset="utf-8">

<title><?php wp_title( '|', true, 'right' );?></title>

<?php wp_head(); ?>

<?php
// check current user
global $current_user;
global $user_level;
get_currentuserinfo();
?>
<script type="text/javascript">
// add in-frame class
if(self !== top){
  document.documentElement.className ='in-frame';
}
</script>
</head>

<body <?php body_class(''); ?> data-grid-framework="bo" data-grid-color="yellow" data-grid-opacity="0.2" data-grid-zindex="-30" data-grid-nbcols="12">

<!--[if lt IE 7]>
<p id="browsernotsupported"><?php _e('Votre navigateur est obsolète, <a href="http://browsehappy.com/">téléchargez un
  navigateur plus moderne</a> pour une bonne utilisation de ce site.', 'stormbringer');?>
</p><![endif]-->

<div id="wrapper">

  <header role="banner" id="header">

    <nav id="navigation" role="navigation">
      <div class="navigation-inner">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" id="logo" title="<?php echo esc_attr(get_bloginfo('description')); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
        </div>

        <div class="collapse navbar-collapse" id="navigation-collapse">
          <?php wp_nav_menu(array('theme_location' => 'main_nav', 'depth' => 2, 'container' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new stormbringer_Navbar_Nav_Walker(), 'fallback_cb' => false)); ?>
        </div>
        <!-- /.navbar-collapse -->
      </div>
    </nav>
    <!-- #navigation -->

  </header>

  <div class="main-wrapper">
    <main id="main">
      <div class="main-inner">