<?php
/**
 * @file
 * agov_beans.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function agov_beans_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'basic_content';
  $bean_type->label = 'Basic content';
  $bean_type->options = '';
  $bean_type->description = '';
  $export['basic_content'] = $bean_type;

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'icon_block';
  $bean_type->label = 'Icon Block';
  $bean_type->options = '';
  $bean_type->description = 'A block that provides a field for displaying a font awesome icon. See http://fortawesome.github.io/Font-Awesome/';
  $export['icon_block'] = $bean_type;

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'image_and_text';
  $bean_type->label = 'Image and Text';
  $bean_type->options = '';
  $bean_type->description = 'Provides an image and text block.';
  $export['image_and_text'] = $bean_type;

  return $export;
}
