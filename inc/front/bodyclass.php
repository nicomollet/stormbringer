<?php
/**
 * Body class
 *
 * Customize body class with many classes
 *
 * @package StormBringer
 */
add_filter('body_class', 'stormbringer_body_class');

/**
 * Body class
 *
 * @param string $classes
 *
 * @return array|string
 */
function stormbringer_body_class( $classes = '' ) {
    global $current_user;

    $classes[] = 'wordpress';
    $classes[] = 'dir-'.get_bloginfo( 'text_direction' );
    $classes[] = 'locale-'.get_locale();
    $classes[] = ( is_child_theme() ? 'child-theme' : 'parent-theme' );

    // Multisite
    if ( is_multisite() ) {
        $classes[] = 'multisite';
        $classes[] = 'blog-' . get_current_blog_id();
    }

    // User role
    if(is_user_logged_in()):
        //$user = new WP_User( $current_user->ID ); // $user->roles
        $user = wp_get_current_user();
        //print_r($user);
        foreach($user->roles as $role){
            $classes[] = 'role-'.$role;
        }
    else:
        $classes[] = 'role-anonymous';
    endif;

    // Date classes
    $time = time() + ( get_option( 'gmt_offset' ) * 3600 );
    $classes[] = strtolower( gmdate( '\yY \mm \dd \hH l', $time ) );

    // Is the current user logged in
    $classes[] = ( is_user_logged_in() ) ? 'logged-in' : 'logged-out';

    // WP admin bar
    if ( is_admin_bar_showing() )
        $classes[] = 'admin-bar';

    // WPML language
    if (defined('ICL_LANGUAGE_CODE')) $classes[] = "lang-" . ICL_LANGUAGE_CODE;

    // Polylang language
    if(function_exists('pll_current_language')):
        $classes[] = "lang-" . pll_current_language();
    endif;

    // Merge base contextual classes with $classes
    $classes = array_merge( $classes, stormbringer_get_context() );

    return $classes;
}


/**
 * Hybrid's main contextual function.  This allows code to be used more than once without running
 * hundreds of conditional checks within the theme.  It returns an array of contexts based on what
 * page a visitor is currently viewing on the site.  This function is useful for making dynamic/contextual
 * classes, action and filter hooks, and handling the templating system.
 *
 * Note that time and date can be tricky because any of the conditionals may be true on time-/date-
 * based archives depending on several factors.  For example, one could load an archive for a specific
 * second during a specific minute within a specific hour on a specific day and so on.
 *
 * @since 0.7.0
 * @global $wp_query The current page's query object.
 * @global $hybrid The global Hybrid object.
 * @return array $classes Several contexts based on the current page.
 */
function stormbringer_get_context() {
    global $post;

    // If $classes has been set, don't run through the conditionals again. Just return the variable
    if ( isset( $classes ) )
        return $classes;

    // Set some variables for use within the function
    $classes = array();
    $object = get_queried_object();
    $object_id = get_queried_object_id();


    // Front page of the site
    if ( is_front_page() )
        $classes[] = 'home';

    // Blog page
    if ( is_category() || is_singular('post') || is_tag() || is_post_type_archive('post') || is_search() || is_author()) {
        $classes[] = 'blog';

        // Category ancestors
        if(is_singular('post')){

            $categories = get_the_category( $post->ID );

            $topparentcategory = null;
            if(isset($categories[0]->term_id)){
                $ancestors = get_ancestors( $categories[0]->term_id, 'category' );
                if($ancestors) {
                    $cpt = 0;
                    foreach($ancestors as $ancestor){
                        $cpt++;
                        if($ancestor){
                            if($cpt==1){
                                $topparentcategory = $ancestor;
                            }
                            $classes[]  = 'category-'.$ancestor;
                        }
                    }

                    if(!empty($topparentcategory)){
                        $classes[]  = 'top-category-'.$topparentcategory;
                    }
                }
            }

            $ancestors = get_category_parents( $categories[0]->term_id, false, ':', true );
            if($ancestors) {
                $ancestors = explode(':',$ancestors);
                $cpt = 0;
                foreach($ancestors as $ancestor){
                    $cpt++;
                    if($ancestor){
                        if($cpt==1)$topparentcategory = $ancestor;
                        $classes[]  = 'category-'.$ancestor;
                    }
                }

                if($topparentcategory){
                    $classes[]  = 'top-category-'.$topparentcategory;
                }
            }
            foreach ((get_the_category($post->ID)) as $category){
                $classes[] = 'category-' . $category->category_nicename;
            }
        }

    }

    // Singular views
    elseif ( is_singular() ) {
        $classes[] = 'singular';
        $classes[] = "singular-{$object->post_type}";
        $classes[] = "singular-{$object->post_type}-{$object_id}";

        // Checks for custom template
        $template = str_replace(
            array("{$object->post_type}-template-", "{$object->post_type}-", '.php'), '',
            get_post_meta($object_id, "_wp_{$object->post_type}_template", true)
        );
        if ( ! empty($template)) {
            $classes[] = "{$object->post_type}-template-{$template}";
        }

        // Post format
        if (current_theme_supports('post-formats') && post_type_supports($object->post_type, 'post-formats')) {
            $post_format = get_post_format(get_queried_object_id());
            $classes[]   = ((empty($post_format) || is_wp_error($post_format)) ? "{$object->post_type}-format-standard"
                : "{$object->post_type}-format-{$post_format}");
        }

        // if there is no parent ID and it's not a single post page, category page, or 404 page, give it
        // a class of "parent-page"
        if ($object->post_parent < 1 && !is_single() && !is_archive() && !is_404()) {
            $classes[] = 'parent-page';
        }

        // parents top level
        $parents = array();
        $parents = get_post_ancestors($object_id);
        $classes[] = (end($parents) > 0 ? "level1-page-" . end($parents) : "level1-page-{$object_id}");

        // category
        foreach ((get_the_category($post->ID)) as $category):
            $classes[] = 'post-taxonomy-category-' . $category->category_nicename;
        endforeach;

        // Attachment mime types
        if ( is_attachment() ) {
            foreach ( explode( '/', get_post_mime_type() ) as $type )
                $classes[] = "attachment-{$type}";
        }
    }

    // Archive views
    elseif ( is_archive() ) {
        $classes[] = 'archive';

        /* Taxonomy archives. */
        if ( is_tax() || is_category() || is_tag() ) {
            $classes[] = 'taxonomy';
            $classes[] = "taxonomy-{$object->taxonomy}";
            $classes[] = "taxonomy-{$object->taxonomy}-" . sanitize_html_class( $object->slug, $object->term_id );
        }

        /* Post type archives. */
        elseif ( is_post_type_archive() ) {
            $post_type = get_post_type_object( get_query_var( 'post_type' ) );
            $classes[] = "archive-{$post_type->name}";
        }

        /* User/author archives. */
        elseif ( is_author() ) {
            $classes[] = 'user';
            $classes[] = 'user-' . sanitize_html_class( get_the_author_meta( 'user_nicename', $object_id ), $object_id );
        }

        /* Time/Date archives. */
        else {
            if ( is_date() ) {
                $classes[] = 'date';
                if ( is_year() )
                    $classes[] = 'year';
                if ( is_month() )
                    $classes[] = 'month';
                if ( get_query_var( 'w' ) )
                    $classes[] = 'week';
                if ( is_day() )
                    $classes[] = 'day';
            }
            if ( is_time() ) {
                $classes[] = 'time';
                if ( get_query_var( 'hour' ) )
                    $classes[] = 'hour';
                if ( get_query_var( 'minute' ) )
                    $classes[] = 'minute';
            }
        }
    }

    /* Search results. */
    elseif ( is_search() ) {
        $classes[] = 'search';
    }

    /* Error 404 pages. */
    elseif ( is_404() ) {
        $classes[] = 'error-404';
    }


    $google_fonts = get_theme_mod( 'google_fonts' );
    $typekit_id = get_theme_mod('typekit_id');
    if ( !($google_fonts || $typekit_id )) :
        $classes[] = 'wf-inactive';
    endif;
    return $classes;
}
