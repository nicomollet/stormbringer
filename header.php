<!doctype html>
<!--[if IEMobile 7 ]>
<html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
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
/*
* Print the <title> tag based on what is being viewed.
*/
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

?></title>

<?php wp_head(); ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e('Feed','stormbringer');?>" href="<?php echo home_url(); ?>/feed/">

<?php
// check current user
global $current_user;
global $user_level;
get_currentuserinfo();
?>

</head>

<body <?php body_class(); ?>>

<!--[if lt IE 7]><p id="browsernotsupported"><?php _e('Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> to experience this site.','stormbringer');?></p><![endif]-->

<header role="banner" id="header">

  <div id="inner-header" class="clearfix">

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container nav-container">
          <nav role="navigation">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span></span>
              <span class="icon-bar-text"><?php _e('Menu','stormbringer');?></span>
              <span></span>
            </a>
            <?php if (NAVBAR_SITENAME==true ) { // Show site name in navbar? ?>
              <a class="brand" id="logo" title="<?php echo esc_attr(get_bloginfo('description')); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
            <?php } // site name in navbar ?>


            <div class="nav-collapse">
              <?php
              wp_nav_menu(array(
                               'menu' => 'main_nav', /* menu name */
                               'menu_class' => 'nav',
                               'theme_location' => 'main_nav', /* where in the theme it's assigned */
                               'container' => 'false', /* container class */
                               'depth' => '2', /* suppress lower levels for now */
                               'walker' => new stormbringer_Navbar_Nav_Walker(),
                               'fallback_cb' => 'stormbringer_menu_fallback'
                          )
              );
              ?>


              <?php if ( NAVBAR_SEARCH==true ) { ?>
                <form role="search" class="navbar-search pull-right" action="<?php echo site_url(); ?>" id="searchform" method="get">
                  <label class="assistive-text" for="s"><?php _e('Search', 'stormbringer'); ?></label>
                  <input type="text" placeholder="<?php _e('Search...', 'stormbringer'); ?>" id="s" name="s" class="search-query">
                  <input type="submit" value="<?php _e('Search', 'stormbringer'); ?>" id="searchsubmit" name="submit" class="btn btn-primary">
                </form>
              <?php } // end if search bar ?>

              <?php if ( NAVBAR_LOGIN==true ) { ?>
                <?php if (!is_user_logged_in()) : ?>
                  <a href="#modal-login" data-toggle="modal" class="btn btn-primary pull-right"><?php _e('Login', 'wpbootstrap'); ?></a>
                <?php else : ?>
                  <ul class="nav pull-right">
                      <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $current_user->user_login;?><b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href=""><?php _e('Profile', 'wpbootstrap'); ?></a></li>
                          <li><a href=""><?php _e('Change password', 'wpbootstrap'); ?></a></li>
                          <li><a href="<?php echo wp_logout_url(apply_filters('the_permalink', get_permalink($post_id))); ?>"><?php _e('Logout', 'wpbootstrap'); ?></a></li>
                          <?php if ( current_user_can('administrator') ) :?>
                            <li class="divider"></li>
                            <li><a href="<?php echo admin_url(); ?>"><?php _e('Dashboard', 'wpbootstrap'); ?></a></li>
                          <?php endif;?>
                      </ul>
                      </li>
                  </ul>
                <?php endif; ?>
              <?php } // end if login bar ?>
              
            </div>

          </nav>




        </div>
      </div>
    </div>

  </div>
  <!-- end #inner-header -->

</header>
<!-- end header -->



<div id="wrap" class="<?php echo WRAP_CLASSES; ?>" role="document">


