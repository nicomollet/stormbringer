<?php
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS',true);
define('ICL_DONT_LOAD_NAVIGATION_CSS',true);
define('ICL_DONT_LOAD_LANGUAGES_JS',true);

/* WPML language switcher without flag */
function stormbringer_languages_switcher(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    $inactives='';
    $actives='';
    if(!empty($languages)){
        echo '<div id="langswitcher"><div class="btn-group">';
        foreach($languages as $l) :
          if($l['active'])
            $actives='
              <button data-toggle="dropdown" class="btn dropdown-toggle">
              '.$l['language_code'].' <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
            ';
          else
            $inactives.= '
              <li>
                <a href="'.$l['url'].'" data-lang="'.$l['language_code'].'">'.$l['language_code'].'</a>
              </li>
            ';
        endforeach;
            
        echo $actives.$inactives;
        echo '</ul></div></div>';
    }
}

// Gravity Forms : body class for activation with userregistration
add_filter('body_class', 'stormbringer_body_class_wpmllang');
function stormbringer_body_class_wpmllang($classes = '') {

  // WPML language
  if (defined('ICL_LANGUAGE_CODE')) $classes[] = "lang-" . ICL_LANGUAGE_CODE;

  return $classes;

}

// Menu icon for WPML
function wpml_menu_icon(){

	print '<style type="text/css">';
	print '#toplevel_page_sitepress-multilingual-cms-menu-languages div.wp-menu-image img {display:none}';
	print '#toplevel_page_sitepress-multilingual-cms-menu-languages div.wp-menu-image:before {';
	print ' content: "\f326" !important;';
	print ' font-family: "dashicons" !important;';
	print '}';
	print '</style>';
}
add_action( 'admin_head', 'wpml_menu_icon',40 );
