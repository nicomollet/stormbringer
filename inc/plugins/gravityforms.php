<?php

/**
 * Apply Bootstrap markup/classes to Gravity Forms - extended from stormbringer Theme (http://www.stormbringertheme.com)
 */
/*
* This filter is executed when a form fails validation, before the validation message is displayed.
* Use this filter to change the default validation message.
*/
function stormbringer_gform_validation_message($message, $form)
{
  $oldmessage = strip_tags($message);
  $message = '<div class="alert alert-error fade in">';
  $message .= '<a class="close" data-dismiss="alert">×</a>';
  $message .= '<strong>' . $oldmessage . '</strong>';
  $message .= '</div>';
  return $message;
}

add_filter('gform_validation_message', 'stormbringer_gform_validation_message', 10, 2);

/*
* This filter can be used to dynamically add/remove CSS classes to a field
*/
function stormbringer_gform_field_css_class($classes, $field, $form)
{
  $classes = str_replace('input-mini', '', $classes);
  $classes = str_replace('input-max', '', $classes);
  $classes = str_replace('input-append', '', $classes);
  $classes = str_replace('input-prepend', '', $classes);
  $classes = str_replace('icon-', 'dummy-', $classes);
  $classes .= " control-group";
  if ($field["failed_validation"] == 1) $classes .= " error";
  return $classes;
}

add_action('gform_field_css_class', 'stormbringer_gform_field_css_class', 10, 3);

/*
* This filter is executed when the form is displayed and can be used to completely
* change the form button tag (i.e. <input type="submit">).
*/
function stormbringer_gform_submit_button($button, $form)
{
  return "
      <button class='btn btn-primary' id='gform_submit_button_{$form["id"]}'>
      <span>" . $form["button"]["text"] . "</span>
      </button>
      ";
}

add_filter('gform_submit_button', 'stormbringer_gform_submit_button', 10, 2);

/*
* This filter is executed when the form is displayed and can be used to completely change
* the form tag (i.e. <form method="post">).
*/
function stormbringer_gform_form_tag($form_tag, $form)
{
  $class = "form ";
  if ($form["labelPlacement"] == "right_label") $class .= "form-horizontal";
  if ($form["labelPlacement"] == "top_label") $class .= "form-vertical";
  if ($form["labelPlacement"] == "left_label") $class .= "form-inline";
  $class .= ' ' . $form['cssClass'];
  //$form_tag = preg_replace("|action='(.*?)'|", "action='custom_handler.php'", $form_tag);
  //$form_tag = str_replace("<form",'<form class="'.$class.' '.$form['cssClass'].'"',$form_tag);
  $form_tag = preg_replace("|class='(.*?)'|", "class='" . $class . "'", $form_tag);
  return $form_tag;
}

add_filter("gform_form_tag", "stormbringer_gform_form_tag", 10, 2);


/*
* This filter is executed before creating the field's content, allowing users to completely
* modify the way the field is rendered. It can also be used to create custom field types.
* It is similar to gform_field_input, but provides more flexibility.
*/
function stormbringer_gform_field_content($content, $field, $value, $lead_id, $form_id)
{
  $content = str_replace('gfield_label', 'gfield_label control-label', $content);
  $content = str_replace('gfield_error', 'gfield_error error', $content);
  $content = str_replace('validation_message', 'help-inline', $content);
  $content = str_replace('ginput_container', 'ginput_container controls', $content);
  $content = str_replace('small', 'input-small', $content);
  $content = str_replace('medium', 'input-medium', $content);
  $content = str_replace('large', 'input-large', $content);
  $content = str_replace('gfield_description', 'gfield_description help-block', $content);

  // validation message
  if ($field["failed_validation"] == 1) {
    $content = str_replace('help-block help-inline', 'help-inline', $content);
    $content = preg_replace('/<\/div>(<div class=\'help-block\'>.*?<\/div>)/', '</div>', $content);
  } else
    $content = preg_replace('/<\/div>(<div class=\'help-block\'>.*?<\/div>)/', '\\1</div>', $content);
  $content = preg_replace('/<\/div>(<div class=\'help-inline\'>.*?<\/div>)/', '\\1</div>', $content);

  // append button
  $button = false;
  if (strpos($field["cssClass"], 'buttontext-') !== false) {
    $button_value = substr($field["cssClass"], strpos($field["cssClass"], 'buttontext-') + 11);
    $button = true;
  }

  // append/prepend icon
  if ($field["type"] == 'text' || $field["type"] == 'email') {

    // placeholder
    if (GRAVITYFORMS_PLACEHOLDER == true)
      $content = str_replace('/>', ' placeholder=\'' . $field['label'] . '\'/>', $content);
    if (strpos($field["cssClass"], 'field_disabled') !== false)
      $content = str_replace('/>', ' disabled=\'disabled\'/>', $content);
    if (strpos($field["cssClass"], 'field_force') !== false)
      $content = str_replace('/>', ' data-force=\'1\'/>', $content);
    if (strpos($field["cssClass"], 'input-append') !== false) {
      //$content = str_replace('controls','controls input-append',$content);
      $field["cssClass"] = trim(str_replace('input-append', '', $field["cssClass"]));
      $field["cssClass"] = trim(str_replace('input-mini', '', $field["cssClass"]));
      $field["cssClass"] = trim(str_replace('input-max', '', $field["cssClass"]));
      $field["cssClass"] = trim(str_replace('button-', 'btn-', $field["cssClass"]));
      if ($button == true)
        $content = str_replace('/>', '/><button type="button" class="btn ' . $field["cssClass"] . '">' . $button_value . '</button></div>', $content);
      else
        $content = str_replace('/>', '/><span class="add-on"><i class="' . $field["cssClass"] . '"></i></span></div>', $content);
      $content = str_replace('<input', '<div class="input-append"><input', $content);
    }
    if (strpos($field["cssClass"], 'input-prepend') !== false) {
      //$content = str_replace('controls','controls input-prepend',$content);
      $field["cssClass"] = trim(str_replace('input-prepend', '', $field["cssClass"]));
      $field["cssClass"] = trim(str_replace('input-mini', '', $field["cssClass"]));
      $field["cssClass"] = trim(str_replace('input-max', '', $field["cssClass"]));
      $content = str_replace('<input', '<div class="input-prepend"><span class="add-on"><i class="' . $field["cssClass"] . '"></i></span><input', $content);
      $content = str_replace('/>', '/></div>', $content);
    }
  }
  // field size : mini, max
  if (strpos($field["cssClass"], 'input-mini') !== false) {
    $content = str_replace('input-small', 'input-mini', $content);
    $content = str_replace('input-medium', 'input-mini', $content);
    $content = str_replace('input-large', 'input-mini', $content);
  }
  if (strpos($field["cssClass"], 'input-max') !== false) {
    $content = str_replace('input-small', 'input-max', $content);
    $content = str_replace('input-medium', 'input-max', $content);
    $content = str_replace('input-large', 'input-max', $content);
  }

  if ($field["type"] == 'textarea') {
    // placeholder
    if (GRAVITYFORMS_PLACEHOLDER == true)
      $content = str_replace('<textarea', '<textarea placeholder="' . $field['label'] . '"', $content);
    if (strpos($field["cssClass"], 'field_disabled') !== false)
      $content = str_replace('<textarea', '<textarea disabled=\'disabled\'', $content);
    if (strpos($field["cssClass"], 'field_force') !== false)
      $content = str_replace('<textarea', '<textarea data-force=\'1\'', $content);
  }
  if ($field["type"] == 'select') {
    if (strpos($field["cssClass"], 'field_disabled') !== false)
      $content = str_replace('<select', '<select disabled=\'disabled\'', $content);
    if (strpos($field["cssClass"], 'field_force') !== false)
      $content = str_replace('<select', '<select data-force=\'1\'', $content);
  }
  if ($field["type"] == 'radio') {
    if (strpos($field["cssClass"], 'field_disabled') !== false)
      $content = str_replace('<input', '<input disabled=\'disabled\'', $content);
    if (strpos($field["cssClass"], 'field_force') !== false)
      $content = str_replace('<input', '<input data-force=\'1\'', $content);
  }

  return $content;
}

add_filter("gform_field_content", "stormbringer_gform_field_content", 10, 5);

/*
* This filter is executed when creating the checkbox items.
* It can be used to manipulate the items string before it gets added to the checkbox list.
*/
function stormbringer_gform_field_choices($choices, $field)
{
  $choices = strip_tags($choices, '<input><label>');
  return '<div class="' . $field["type"] . '">' . $choices . '</div>';
}

add_filter("gform_field_choices", "stormbringer_gform_field_choices", 10, 5);

/*
* This filter can be used to dynamically change the confirmation message or redirect URL for a form
*/
add_filter("gform_confirmation", "stormbringer_gform_confirmation", 10, 4);
function stormbringer_gform_confirmation($confirmation, $form, $lead, $ajax)
{
  return stormbringer_alert(array("type" => "success"), $confirmation);
}


//add_filter("gform_cdata_open", "stormbringer_gform_cdata_open", 10, 4);
function stormbringer_gform_cdata_open($content)
{
  return 'document.onload = function() {';
}

//add_filter("gform_cdata_close", "stormbringer_gform_cdata_close", 10, 4);
function stormbringer_gform_cdata_close($content)
{
  return '}';
}

add_filter("gform_get_form_filter", "stormbringer_gform_get_form_filter", 10, 4);
function stormbringer_gform_get_form_filter($content)
{
  $content = str_replace('gform_footer', 'gform_footer form-actions', $content);
  $content = str_replace('gform_page_footer', 'gform_page_footer form-actions', $content);
  return $content;
}

