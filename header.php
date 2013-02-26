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
    if (!class_exists('WPSEO_Admin')) { // check "Yoast Wordpress SEO" plugin
    wp_title('|');
  }
  else {
    global $page, $paged;

    wp_title('|', true, 'right');

    // Add the blog name.
    bloginfo('name');

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page()))
      echo " | $site_description";

    // Add a page number if necessary:
    if ($paged >= 2 || $page >= 2)
      echo ' | ' . sprintf(__('Page %s', 'stormbringer'), max($paged, $page));
  }
    ?></title>

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
<div id="top-border"></div>
<div id="header-container">
  <div class="container">
    <div class="row">

      <header role="banner" id="header" class="span12">

        <nav role="navigation" id="main-nav-container" class="">
          <a class="brand" id="logo" title="<?php echo esc_attr(get_bloginfo('description')); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
          <!-- Main menu -->
          <div id="main-nav">
            <div class="<?php echo apply_filters( 'stormbringer_main_navbar_class' , 'navbar navbar-inverse'); ?>">
              <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".main-menu">
                    <span></span>
                    <span class="icon-bar-text">Menu</span>
                    <span></span>
                  </a>
                  <div class="nav-collapse main-menu">
                    <?php wp_nav_menu( array( 'theme_location' => 'main_nav', 'container' => false, 'menu_class' => 'nav', 'walker' => new stormbringer_Navbar_Nav_Walker(), 'fallback_cb' => false )); ?>
                    <form role="search" class="navbar-search pull-right" action="<?php echo site_url(); ?>" id="searchform" method="get">
                      <label class="assistive-text" for="s">Search</label>
                      <input type="text" placeholder="Search ..." value="<?php echo esc_attr( get_search_query() ); ?>" id="s" name="s" class="search-query">
                      <input type="submit" value="Search" id="searchsubmit" name="submit" class="btn btn-primary">
                    </form>
                  </div><!-- .nav-collapse -->
                </div><!-- .container -->
              </div><!-- .navbar-inner -->
            </div><!-- .navbar -->
          </div><!-- #main-nav -->
          <!-- End Main menu -->


        </nav>
      </header>
    </div>
  </div>
</div>

<div id="main">
  <div class="container">
    <div class="row">


