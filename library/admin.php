<?php
function editpost($content)
{
  global $post,$user_level;
  if ($user_level > 0){
    $content .='<a href="'.get_edit_post_link($post->ID).'" class="btn btn-success edit-post "><i class="icon-pencil icon-white"></i> '.__("Modifier", "stormbringer").'</a>';
    $content = '<div class="the-content">'.$content.'</div>';
  }

  return $content ;
}
add_filter('the_content', 'editpost');
