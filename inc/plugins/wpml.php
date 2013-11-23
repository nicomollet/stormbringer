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