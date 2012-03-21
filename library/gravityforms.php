<?php

/**
 * Apply Bootstrap markup/classes to Gravity Forms - extended from stormbringer Theme (http://www.stormbringertheme.com)
 */
if (class_exists('RGForms')) {// check if Gravity Forms is installed
  // disables Gravity Forms styles
  update_option('rg_gforms_disable_css', 1);

  /*
   * This filter is executed when a form fails validation, before the validation message is displayed.
   * Use this filter to change the default validation message.
   */
  function stormbringer_gform_validation_message($message, $form) {
    $message = '<div class="alert alert-error fade in">';
    $message .= '<a class="close" data-dismiss="alert">×</a>';
    $message .= '<strong>'.__('There was a problem with your submission. Errors have been highlighted below.','stormbringer').'</strong>';
    $message .= '</div>';
    return $message;
  }
  add_filter('gform_validation_message', 'stormbringer_gform_validation_message', 10, 2);

  /*
   * This filter can be used to dynamically add/remove CSS classes to a field
   */
  function stormbringer_gform_field_css_class($classes, $field, $form) {
    $classes .= " control-group";
    if($field["failed_validation"]==1)$classes .= " error";
    return $classes;
  }
  add_action('gform_field_css_class', 'stormbringer_gform_field_css_class', 10, 3);

  /*
   * This filter is executed when the form is displayed and can be used to completely
   * change the form button tag (i.e. <input type="submit">).
   */
  function stormbringer_gform_submit_button($button, $form) {
      return "<button class='btn btn-primary' id='gform_submit_button_{$form["id"]}'><span>".__("Submit","stormbringer")."</span></button>";
  }
  add_filter('gform_submit_button', 'stormbringer_gform_submit_button', 10, 2);

  /*
   * This filter is executed when the form is displayed and can be used to completely change
   * the form tag (i.e. <form method="post">).
   */
  function stormbringer_gform_form_tag($form_tag, $form){
    $class="form ";
    if($form["labelPlacement"]=="right_label")$class.="form-horizontal";
    if($form["labelPlacement"]=="top_label")$class.="form-vertical";
    if($form["labelPlacement"]=="left_label")$class.="form-inline";

    //$form_tag = preg_replace("|action='(.*?)'|", "action='custom_handler.php'", $form_tag);
    $form_tag = str_replace("<form",'<form class="'.$class.'"',$form_tag);
    return $form_tag;
  }
  add_filter("gform_form_tag", "stormbringer_gform_form_tag", 10, 2);


  /*
   * This filter is executed before creating the field's content, allowing users to completely
   * modify the way the field is rendered. It can also be used to create custom field types.
   * It is similar to gform_field_input, but provides more flexibility.
   */
  function stormbringer_gform_field_content($content, $field, $value, $lead_id, $form_id){
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
  add_filter("gform_field_content", "stormbringer_gform_field_content", 10, 5);

  /*
   * This filter is executed when creating the checkbox items.
   * It can be used to manipulate the items string before it gets added to the checkbox list.
   */
  function stormbringer_gform_field_choices($choices, $field){
    $choices =  strip_tags($choices, '<input><label>');
    return '<div class="'.$field["type"].'">'.$choices.'</div>';
  }
  add_filter("gform_field_choices", "stormbringer_gform_field_choices", 10, 5);

}

?>