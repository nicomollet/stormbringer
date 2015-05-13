<?php

// Remove unnecessary dashboard widgets
function stormbringer_remove_dashboard_widgets()
{
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'normal');
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
    // Remove  WordPress Welcome Panel
    remove_action('welcome_panel', 'wp_welcome_panel');
}

add_action('admin_init', 'stormbringer_remove_dashboard_widgets');

// Admin color scheme
function stormbringer_admin_color_schemes()
{
    $theme_dir = get_template_directory_uri();

    // http://themergency.com/generators/admin-color-scheme-generator/
    wp_admin_css_color('stormbringer', 'StormBringer',
        $theme_dir . '/inc/admin/colors.css', // path
        array('#8e0c70', '#5f084b', '#e0feff', '#006F71'), // colors
        array('base' => '#f3f1f3', 'focus' => '#ffffff', 'current' => '#ffffff') // icons
    );
}

add_action('admin_init', 'stormbringer_admin_color_schemes');


// Remove WP menu in admin toolbar
function stormbringer_remove_wp_logo_from_admin_bar()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'stormbringer_remove_wp_logo_from_admin_bar', 7);



