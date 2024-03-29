<?php

/**
 * Apply Bootstrap markup/classes to Gravity Forms
 */

// Gravity Forms: enable the inclusion of the hidden choice in the Field Label Visibility and Sub-Label Placement settings on the field Appearance tab in the form editor.
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

/**
 * Gravity Forms: field css classes
 *
 * @param string $classes
 * @param        $field
 * @param        $form
 *
 * @return array|string|string[]
 */
function stormbringer_gform_field_css_class(string $classes, $field, $form)
{
	$form_css = $form['cssClass'] ?? '';

	$classes = str_replace('input-mini', '', $classes);
	$classes = str_replace('input-max', '', $classes);
	$classes = str_replace('input-append', '', $classes);
	$classes = str_replace('input-prepend', '', $classes);
	$classes = str_replace('icon-', 'dummy-', $classes);
	//$classes = str_replace('gfield', 'form-group gfield', $classes);

	if ($field['type'] == 'textarea' || $field['type'] == 'text' || $field['type'] == 'email' || $field['type'] == 'name') {
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

/**
 * Gravity Forms: submit Button
 *
 * @param $button
 * @param $form
 *
 * @return mixed|string
 */
function stormbringer_gform_submit_button($button, $form)
{
	//$button = str_replace('<input type=\'submit\' ','<button ', $button);
	$button = str_replace('gform_button button','gform_button btn btn-primary btn-lg', $button);
	//$button = str_replace('/>', '>', $button);
	$button = '<div class="form-actions">'.$button.'</div>';
	return $button;
}
add_filter('gform_submit_button', 'stormbringer_gform_submit_button', 10, 2);

/**
 * Gravity Forms: next button
 *
 * @param $button
 * @param $form
 *
 * @return string
 */
function stormbringer_gform_next_button($button, $form): string {
	return '<div class="form-actions form-actions-next">'.str_replace('gform_next_button button','gform_next_button button btn btn-primary',$button).'</div>';
}
add_filter('gform_next_button', 'stormbringer_gform_next_button', 10, 2);

/**
 * Gravity Forms: previous button
 *
 * @param $button
 * @param $form
 *
 * @return string
 */
function stormbringer_gform_previous_button($button, $form): string {
	return '<div class="form-actions form-actions-previous">'.str_replace('gform_previous_button button','btn btn-link',$button).'</div>';
}
add_filter('gform_previous_button', 'stormbringer_gform_previous_button', 10, 2);

/**
 * Gravity Forms: is executed when the form is displayed and can be used to completely change the form tag (i.e. <form method="post">).
 *
 * @param $form_tag
 * @param $form
 *
 * @return array|string|string[]
 */
function stormbringer_gform_form_tag( $form_tag, $form ) {
	$form_css = $form['cssClass'] ?? '';
	$class    = "form ";
	if ( $form["labelPlacement"] == "right_label" ) {
		$class .= "form-horizontal";
	}
	if ( $form["labelPlacement"] == "top_label" ) {
		$class .= "form-vertical";
	}
	if ( $form["labelPlacement"] == "left_label" ) {
		$class .= "form-horizontal form-horizontal-leftlabel";
	}
	$class    .= ' ' . $form_css;
	$form_tag = preg_replace( "|class='(.*?)'|", "", $form_tag );
	$form_tag = str_replace( "<form", '<form class="' . $class . '"', $form_tag );

	return $form_tag;
}
add_filter('gform_form_tag', 'stormbringer_gform_form_tag', 10, 2);

/**
 * Gravity Forms: is executed before creating the field's content, allowing users to completely modify the way the field is rendered. It can also be used to create custom field types. It is similar to gform_field_input, but provides more flexibility.
 *
 * @param $content
 * @param $field
 * @param $value
 * @param $lead_id
 * @param $form_id
 *
 * @return array|string|string[]|null
 */
function stormbringer_gform_field_content($content, $field, $value, $lead_id, $form_id)
{
	global $form_css;
	if(!$form_css){
		$form_css='';
		$forminfo = RGFormsModel::get_form_meta($form_id);
		$form_css = $forminfo['cssClass'] ?? '';
	}

	//$content = str_replace('gfield_label', 'gfield_label control-label', $content);
	$content = str_replace('datepicker', 'form-control', $content);
	$content = str_replace('gfield_label', 'control-label gfield_label', $content);
	$content = str_replace('gfield_checkbox', 'gfield_checkbox', $content);
	$content = str_replace('gfield_radio', 'gfield_radio', $content);
	$content = str_replace('gfield_error', 'gfield_error has-error', $content);
	$content = str_replace('validation_message', 'help-block', $content);
	$content = str_replace('ginput_container', 'form-input ginput_container', $content);
	$content = str_replace('small', 'form-control input-sm', $content);
	$content = str_replace('medium', 'form-control input-md', $content);
	$content = str_replace('large', 'form-control input-lg', $content);
	$content = str_replace('gfield_description', 'help-block gfield_description', $content);
	$content = str_replace('help-inline help-block', 'help-block', $content);
	$content = str_replace('type=\'password\'', 'type=\'password\' class="form-control"', $content);


	// Different cases for each field types

	$inline='';
	if (strpos($field['cssClass'], 'field-inline') !== false){
		$inline='-inline';
	}

	if ($field['type'] == 'select') {
		$content = str_replace('<select', '<select data-width="auto"', $content);
	}

	if ($field['type'] == 'radio' || $field['type'] == 'checkbox') {
		$content = preg_replace("/[\n\r\t]/","",$content);
		$content = str_replace("  "," ",$content);
		//$content = preg_replace('/<\/div>(<div class=\'help-inline\'>.*?<\/div>)/', '\\1</div>', $content);
		$content = preg_replace('/<input(.*?)><label(.*?)>(.*?)<\/label>/', (!$inline ? '<div class="' . $field['type'] . '">' : '') . '<label class="' . ($inline ? $field['type'] . $inline : '') . '"\\2><input\\1>\\3</label>' . (!$inline ? '</div>' : ''), $content); // insert input into label tag
		//$content = preg_replace('/<label(.*?)>(.*?)<\/label>/', '\\2', $content); //removes only the label
		if (strpos($field['cssClass'], 'field-disabled') !== false)
			$content = str_replace('<input', '<input disabled=\'disabled\'', $content);
		if (strpos($field['cssClass'], 'field-force') !== false)
			$content = str_replace('<input', '<input data-force=\'1\'', $content);
	}

	if ($field['type'] == 'name' || $field['type'] == 'address') {
		$content = str_replace('type=\'text\'', 'type="text" class="form-control"', $content);
	}

	if ($field['type'] == 'email') {
		$content = str_replace("class=''", "", $content);
		$content = str_replace("type='email'", "type='email' class='form-control'", $content);
	}

	if ($field['type'] == 'time') {
		$content = str_replace("class=''", "", $content);
		$content = str_replace("type='number'", "type='number' class='form-control form-control-auto'", $content);
	}

	$content = preg_replace("#\r|\n#", "", $content);
	$content = preg_replace('/\>\s+\</m', '><', $content);

	return $content;
}
add_filter('gform_field_content', 'stormbringer_gform_field_content', 10, 5);


/**
 * Gravity Forms: is executed when creating the checkbox items, it can be used to manipulate the items string before it gets added to the checkbox list.
 *
 * @param $choices
 * @param $field
 *
 * @return string
 */
function stormbringer_gform_field_choices($choices, $field): string {
	$choices = strip_tags($choices, '<input><label>');
	return $choices;
}
add_filter('gform_field_choices', 'stormbringer_gform_field_choices', 10, 5);

/**
 * Gravity Forms: replace form tag content
 *
 * @param string $content
 * @param       $form
 *
 * @return string
 */
function stormbringer_gform_get_form_filter( string $content, $form): string {
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

	$content = str_replace( '<li ', '<div ', $content );
	$content = str_replace( '<ul ', '<div ', $content );
	$content = str_replace( '</li>', '</div>', $content );
	$content = str_replace( '</ul>', '</div>', $content );
	$content = str_replace( 'hasDatepicker', '', $content );
	$content = str_replace( 'datepicker_no_icon', '', $content );
	//$content = str_replace( 'datepicker', '', $content );

	return $content;
}
add_filter('gform_get_form_filter', 'stormbringer_gform_get_form_filter', 10, 2);

/**
 * Gravity Forms: body class for activation with userregistration
 *
 * @param string[] $classes
 *
 * @return array
 */
function stormbringer_body_class_useractivation( $classes ) {

	if (function_exists('rgget')) {
		if (rgget('page') == 'gf_activation') {
			$classes[] = 'gf-activation';
		}
	}
	return $classes;

}
add_filter('body_class', 'stormbringer_body_class_useractivation');

