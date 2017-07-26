<?php

/**
 * Apply Bootstrap markup/classes to Gravity Forms - extended from stormbringer Theme (http://www.stormbringertheme.com)
 */
/*
//This filter is executed when a form fails validation, before the validation message is displayed.
//Use this filter to change the default validation message.
function stormbringer_gform_validation_message($message, $form)
{
  $oldmessage = strip_tags($message);
  $message = '<div class="alert alert-error fade in">';
  $message .= '<a class="close" data-dismiss="alert">&times;</a>';
  $message .= '<strong>' . $oldmessage . '</strong>';
  $message .= '</div>';
  return $message;
}
add_filter('gform_validation_message', 'stormbringer_gform_validation_message', 10, 2);

*/

// This filter is used to enable the inclusion of the hidden choice in the Field Label Visibility and Sub-Label Placement settings on the field Appearance tab in the form editor.
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );


// This filter can be used to dynamically add/remove CSS classes to a field
function stormbringer_gform_field_css_class($classes, $field, $form)
{
    $form_css = $form['cssClass'];

    $classes = str_replace('input-mini', '', $classes);
    $classes = str_replace('input-max', '', $classes);
    $classes = str_replace('input-append', '', $classes);
    $classes = str_replace('input-prepend', '', $classes);
    $classes = str_replace('icon-', 'dummy-', $classes);
    //$classes = str_replace('gfield', 'form-group gfield', $classes);

    if ($field["type"] == 'textarea' || $field["type"] == 'text' || $field["type"] == 'email' || $field["type"] == 'name') {
        if (strpos($form_css, 'form-placeholder') !== false)
            $classes .= " hide-label";

    }
    if(strpos($classes, 'gsection' ) === false){
        $classes .= " form-group";
    }else{

    }

    if ($field["failed_validation"] == 1) $classes .= " has-error";
    return $classes;
}
add_action('gform_field_css_class', 'stormbringer_gform_field_css_class', 10, 3);

// This filter is executed when the form is displayed and can be used to completely
//change the form button tag (i.e. <input type="submit">).

function stormbringer_gform_submit_button($button, $form)
{
	//$button = str_replace('<input type=\'submit\' ','<button ', $button);
	$button = str_replace('gform_button','gform_button btn btn-primary btn-lg', $button);
	//$button = str_replace('/>', '>', $button);
	$button = '<div class="form-actions">'.$button.'</div>';
    return $button;
}
add_filter('gform_submit_button', 'stormbringer_gform_submit_button', 10, 2);

function stormbringer_gform_next_button($button, $form)
{
    return '<div class="form-actions form-actions-next">'.str_replace('gform_next_button button','btn btn-primary',$button).'</div>';
}
add_filter('gform_next_button', 'stormbringer_gform_next_button', 10, 2);

function stormbringer_gform_previous_button($button, $form)
{
    return '<div class="form-actions form-actions-previous">'.str_replace('gform_previous_button button','btn btn-link',$button).'</div>';
}
add_filter('gform_previous_button', 'stormbringer_gform_previous_button', 10, 2);



//This filter is executed when the form is displayed and can be used to completely change
//the form tag (i.e. <form method="post">).

function stormbringer_gform_form_tag($form_tag, $form)
{
    $class = "form ";
    if ($form["labelPlacement"] == "right_label") $class .= "form-horizontal";
    if ($form["labelPlacement"] == "top_label") $class .= "form-vertical";
    if ($form["labelPlacement"] == "left_label") $class .= "form-horizontal form-horizontal-leftlabel";
    $class .= ' ' . $form['cssClass'];
    //$form_tag = preg_replace("|action='(.*?)'|", "action='custom_handler.php'", $form_tag);
    //$form_tag = str_replace("<form",'<form class="'.$class.' '.$form['cssClass'].'"',$form_tag);
    //$form_tag = preg_replace("|class='(.*?)'|", "class='" . $class . "'", $form_tag);
    $form_tag = preg_replace("|class='(.*?)'|", "", $form_tag);
    $form_tag = str_replace("<form",'<form class="'.$class.'"',$form_tag);
    return $form_tag;
}
add_filter("gform_form_tag", "stormbringer_gform_form_tag", 10, 2);


//This filter is executed before creating the field's content, allowing users to completely
//modify the way the field is rendered. It can also be used to create custom field types.
//It is similar to gform_field_input, but provides more flexibility.

function stormbringer_gform_field_content($content, $field, $value, $lead_id, $form_id)
{
    global $form_css;
    if(!$form_css){
        $form_css='';
        $forminfo = RGFormsModel::get_form_meta($form_id);
        $form_css = $forminfo['cssClass'];
    }

    //$content = str_replace('gfield_label', 'gfield_label control-label', $content);
    $content = str_replace('gfield_label', 'control-label gfield_label', $content);
    $content = str_replace('gfield_checkbox', 'gfield_checkbox', $content);
    $content = str_replace('gfield_radio', 'gfield_radio', $content);
    $content = str_replace('gfield_error', 'gfield_error has-error', $content);
    $content = str_replace('validation_message', 'help-inline', $content);
    $content = str_replace('ginput_container', 'form-input ginput_container', $content);
    $content = str_replace('small', 'form-control input-sm', $content);
    $content = str_replace('medium', 'form-control input-md', $content);
    $content = str_replace('large', 'form-control input-lg', $content);
    $content = str_replace('gfield_description', 'help-block gfield_description', $content);
    $content = str_replace('help-inline help-block', 'help-block', $content);
    $content = str_replace('type=\'password\'', 'type=\'password\' class="form-control"', $content);


    // validation message
    // if ($field["failed_validation"] == 1) {
    //  $content = str_replace('help-block help-inline', 'help-inline', $content);
    //$content = preg_replace('/<\/div>(<div class=\'help-block\'>.*?<\/div>)/', '</div>', $content);
    //} else
    //$content = preg_replace('/<\/div>(<div class=\'help-block\'>.*?<\/div>)/', '\\1</div>', $content);
    /*
      $content = preg_replace('/<\/div>(<div class=\'help-inline\'>.*?<\/div>)/', '\\1</div>', $content); //1st time for description
      $content = preg_replace('/<\/div>(<div class=\'help-inline\'>.*?<\/div>)/', '\\1</div>', $content); //2nd time for error

      // append button
      $button = false;
      if (strpos($field["cssClass"], 'buttontext-') !== false) {
        $button_value = substr($field["cssClass"], strpos($field["cssClass"], 'buttontext-') + 11);
        $button = true;
      }
    */
    // field-inline
    $inline='';
    if (strpos($field["cssClass"], 'field-inline') !== false){
        $inline='-inline';
    }
    /*
      // append/prepend icon
      if ($field["type"] == 'text' || $field["type"] == 'email' || $field["type"] == 'name') {

        // placeholder
        //if (GRAVITYFORMS_PLACEHOLDER == true)
        //if ($form_css == 'placeholder')
        if (strpos($form_css, 'form-placeholder') !== false){
          if($field["type"] == 'name'){
            foreach($field["inputs"] as $key=>$value){

              $content = str_replace('name=\'input_'.$value['id'].'\'', 'name=\'input_'.$value['id'].'\' placeholder=\'' . $value['label'] . '\'', $content);
              $content = str_replace('<label', '<label class=\'hide\'', $content);
            }

          }
        else{
            $content = str_replace('/>', ' placeholder=\'' . $field['label'] . '\'/>', $content);
          }
        }

        // input-small for name
        if($field["type"] == 'name'){
          foreach($field["inputs"] as $key=>$value){
            $content = str_replace('name=\'input_'.$value['id'].'\'', 'name="input_'.$value['id'].'" input class=\'input-mini input-name-'.($key+1).'\'', $content);
          }
        }
        if (strpos($field["cssClass"], 'field-disabled') !== false)
          $content = str_replace('/>', ' disabled=\'disabled\'/>', $content);
        if (strpos($field["cssClass"], 'field-force') !== false)
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
        if (strpos($form_css, 'form-placeholder') !== false)
          $content = str_replace('<textarea', '<textarea placeholder="' . $field['label'] . '"', $content);
        if (strpos($field["cssClass"], 'field-disabled') !== false)
          $content = str_replace('<textarea', '<textarea disabled=\'disabled\'', $content);
        if (strpos($field["cssClass"], 'field-force') !== false)
          $content = str_replace('<textarea', '<textarea data-force=\'1\'', $content);

      }
      if ($field["type"] == 'select') {
        if (strpos($field["cssClass"], 'field-disabled') !== false)
          $content = str_replace('<select', '<select disabled=\'disabled\'', $content);
        if (strpos($field["cssClass"], 'field-force') !== false)
          $content = str_replace('<select', '<select data-force=\'1\'', $content);
      }

    */

    if ($field["type"] == 'select') {
        $content = str_replace('<select', '<select data-width="auto"', $content);
    }

    if ($field["type"] == 'radio' || $field["type"] == 'checkbox') {
        $content = preg_replace("/[\n\r\t]/","",$content);
        $content = str_replace("  "," ",$content);
        //$content = preg_replace('/<\/div>(<div class=\'help-inline\'>.*?<\/div>)/', '\\1</div>', $content);
        $content = preg_replace('/<input(.*?)><label(.*?)>(.*?)<\/label>/', (!$inline ? '<div class="' . $field["type"] . '">' : '') . '<label class="' . ($inline ? $field["type"] . $inline : '') . '"\\2><input\\1>\\3</label>' . (!$inline ? '</div>' : ''), $content); // insert input into label tag
        //$content = preg_replace('/<label(.*?)>(.*?)<\/label>/', '\\2', $content); //removes only the label
        if (strpos($field["cssClass"], 'field-disabled') !== false)
            $content = str_replace('<input', '<input disabled=\'disabled\'', $content);
        if (strpos($field["cssClass"], 'field-force') !== false)
            $content = str_replace('<input', '<input data-force=\'1\'', $content);
    }

	if ($field["type"] == 'name' || $field["type"] == 'address') {
		$content = str_replace('type=\'text\'', 'type="text" class="form-control"', $content);
	}

    return $content;
}
add_filter("gform_field_content", "stormbringer_gform_field_content", 10, 5);


// This filter is executed when creating the checkbox items.
// It can be used to manipulate the items string before it gets added to the checkbox list.

function stormbringer_gform_field_choices($choices, $field)
{
    $choices = strip_tags($choices, '<input><label>');
    if (strpos($field["cssClass"], 'field-inline') !== false){
        return $choices;
    }
    else{
        return $choices;
        //return '<div id="input_' . $field["formId"] . '_' . $field["id"] . '" class="'.$field["type"].'">' . $choices . '</div>';
    }
    //return '<div class="' . $field["type"] . '">' . $choices . '</div>';
    //return '<div id="input_' . $field["formId"] . '_' . $field["id"] . '">' . $choices . '</div>';

}

add_filter("gform_field_choices", "stormbringer_gform_field_choices", 10, 5);

/*
// This filter can be used to dynamically change the confirmation message or redirect URL for a form
add_filter("gform_confirmation", "stormbringer_gform_confirmation", 10, 4);
function stormbringer_gform_confirmation($confirmation, $form, $lead, $ajax){
  if($form['confirmation']['type']=='message')
    return stormbringer_alert(array("type"=>"success"),$confirmation);
  else
    return $confirmation;
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
*/
add_filter("gform_get_form_filter", "stormbringer_gform_get_form_filter", 10, 4);
function stormbringer_gform_get_form_filter($content)
{
    $content = str_replace('gfield_required', 'form-required gfield_required', $content);

    //$content = str_replace('gform_description', 'form-description gform_description', $content);
    $content = preg_replace('/(<span class=\'gform_description\'>.*?<\/span>)/', '<p class="form-description gform_description">\\1</p>', $content);

    $content = str_replace('gform_title', 'form-title gform_title', $content);
    $content = str_replace('gform_wrapper"', 'form-wrapper gform_wrapper"', $content);
    $content = str_replace('gform_heading', 'form-header gform_heading', $content);
    $content = str_replace('gform_body', 'form-body gform_body', $content);
    $content = str_replace('class=\'gform_fields', 'class=\'form-fields', $content);
    $content = str_replace('gform_footer', 'form-group gform_footer', $content);
    $content = str_replace('gsection_title', 'form-section-title gsection_title', $content);
    $content = str_replace('gsection_description', 'form-section-description gsection_description', $content);
    $content = str_replace('gsection', 'form-section gsection', $content);
    $content = str_replace('gform_page_footer', 'form-actions gform_page_footer', $content);
    $content = str_replace('\'validation_error', '\'alert alert-danger validation_error', $content);
    //$content = str_replace('div class="radio"', 'div', $content);
    //$content = str_replace('div class="checkbox"', 'div', $content);
    //$content = str_replace('right_label', '', $content);
    //$content = str_replace('left_label', '', $content);
    //$content = str_replace('top_label', '', $content);
    //$content = str_replace('ginput_container', '', $content);

    //$content = preg_replace('/<ul class=\'gfield_checkbox\'(.*?)>(.*?)<\/ul>/', '\\2', $content);
    //$content = preg_replace('/<ul class=\'gfield_radio\'(.*?)>(.*?)<\/ul>/', '\\2', $content);

    $content = str_replace('<li ', '<div ', $content);
    $content = str_replace('<ul ', '<div ', $content);
    $content = str_replace('</li>', '</div>', $content);
    $content = str_replace('</ul>', '</div>', $content);


    return $content;
}


// Gravityforms to footer
add_filter("gform_init_scripts_footer", "gravityforms_footer_noblockrender");
function gravityforms_footer_noblockrender() {
    return true;
}
add_filter( 'gform_cdata_open', 'wrap_gform_cdata_open' );
function wrap_gform_cdata_open( $content = '' ) {
    $content = 'document.addEventListener( "DOMContentLoaded", function() { ';
    return $content;
}
add_filter( 'gform_cdata_close', 'wrap_gform_cdata_close' );
function wrap_gform_cdata_close( $content = '' ) {
    $content = ' }, false );';
    return $content;
}

// Gravity Forms : body class for activation with userregistration
add_filter('body_class', 'stormbringer_body_class_useractivation');
function stormbringer_body_class_useractivation($classes = '') {

    if (function_exists('rgget')) {
        if (rgget('page') == 'gf_activation') {
            $classes[] = 'gf-activation';
        }
    }
    return $classes;

}


