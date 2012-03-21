<?php

// apply Bootstrap markup/classes to Gravity Forms (in progress)
if (class_exists('RGForms')) {
  update_option('rg_gforms_disable_css', 1);

  // error message class
  function roots_gform_validation_message($message, $form) {
    $message = '<div class="alert alert-error fade in">';
    $message .= '<a class="close" data-dismiss="alert">×</a>';
    $message .= '<strong>There was a problem with your submission. Errors have been highlighted below.</strong>';
    $message .= '</div>';
    return $message;
  }
  add_filter('gform_validation_message', 'roots_gform_validation_message', 10, 2);

  // field class
  function roots_gform_field_css_class($classes, $field, $form) {
    $classes .= " control-group";
    if($field["failed_validation"]==1)$classes .= " error";
    //print_r($field);
    return $classes;
  }
  add_action('gform_field_css_class', 'roots_gform_field_css_class', 10, 3);

  // button class
  function roots_gform_submit_button($button, $form) {
      return "<button class='btn btn-primary' id='gform_submit_button_{$form["id"]}'><span>Submit</span></button>";
  }
  add_filter('gform_submit_button', 'roots_gform_submit_button', 10, 2);

}

function form_tag($form_tag, $form){
  $class="form ";
  if($form["labelPlacement"]=="right_label")$class.="form-horizontal";
  if($form["labelPlacement"]=="top_label")$class.="form-vertical";
  if($form["labelPlacement"]=="left_label")$class.="form-inline";

  //$form_tag = preg_replace("|action='(.*?)'|", "action='custom_handler.php'", $form_tag);
  $form_tag = str_replace("<form",'<form class="'.$class.'"',$form_tag);
  return $form_tag;
}
add_filter("gform_form_tag", "form_tag", 10, 2);



function subsection_field($content, $field, $value, $lead_id, $form_id){
  //print_r($field);
  $content = str_replace('gfield_label','control-label',$content);
  $content = str_replace('gfield_error','error',$content);
  $content = str_replace('validation_message','help-inline',$content);
  $content = str_replace('ginput_container','controls',$content);
  $content = str_replace('medium','input-medium',$content);
  $content = str_replace('small','input-small',$content);
  $content = str_replace('large','input-large',$content);
  $content = str_replace('gfield_description','help-block',$content);
  if($field["failed_validation"]==1){
    $content = str_replace('help-block help-inline','help-inline',$content);
    $content = preg_replace('/<\/div>(<div class=\'help-block\'>.*?<\/div>)/', '</div>', $content);
  }
  else
    $content = preg_replace('/<\/div>(<div class=\'help-block\'>.*?<\/div>)/', '\\1</div>', $content);
  $content = preg_replace('/<\/div>(<div class=\'help-inline\'>.*?<\/div>)/', '\\1</div>', $content);

  return $content;
}
add_filter("gform_field_content", "subsection_field", 10, 5);

function choices_field($choices, $field){
  $choices =  strip_tags($choices, '<input><label>');
  return '<div class="'.$field["type"].'">'.$choices.'</div>';
}
add_filter("gform_field_choices", "choices_field", 10, 5);

?>