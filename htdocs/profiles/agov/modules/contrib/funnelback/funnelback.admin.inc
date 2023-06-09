<?php

/**
 * @file
 * Admin functions for the funnelback module.
 */

/**
 * Form builder for the Funnelback settings page.
 */
function funnelback_admin_form($form, &$form_state) {

  $form['description'] = array(
    '#value' => 'These are the settings for Funnelback search integration.',
    '#prefix' => '<div>',
    '#suffix' => '</div>',
  );
  $form['funnelback_base_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Base Url'),
    '#description' => t('The base url for the Funnelback XML interface (excluding trailing slash).'),
    '#size' => 60,
    '#maxlength' => 255,
    '#default_value' => variable_get('funnelback_base_url', 'https://example.funnelback.com/search/'),
    '#required' => TRUE,
  );
  $form['funnelback_api_format'] = array(
    '#type' => 'select',
    '#title' => t('API Format'),
    '#description' => t('The API format used to return data'),
    '#options' => array(
      // HTML requests are not currently supported.
      // FUNNELBACK_API_HTML => t('HTML'),
      // XML requests supported has been removed.
      // FUNNELBACK_API_XML => t('XML'),
      FUNNELBACK_API_JSON => t('JSON'),
    ),
    '#default_value' => variable_get('funnelback_api_format', FUNNELBACK_API_XML),
    '#required' => TRUE,
  );
  $form['funnelback_collection'] = array(
    '#type' => 'textfield',
    '#title' => t('Collection Name'),
    '#description' => t('The Funnelback collection name'),
    '#size' => 30,
    '#maxlength' => 255,
    '#default_value' => variable_get('funnelback_collection', 'example'),
    '#required' => TRUE,
  );
  $form['funnelback_profile'] = array(
    '#type' => 'textfield',
    '#title' => t('Profile Name'),
    '#description' => t('(Optional) Funnelback profile name, only if required by Funnelback.'),
    '#size' => 30,
    '#maxlength' => 255,
    '#default_value' => variable_get('funnelback_profile', NULL),
  );
  $form['funnelback_debug_mode'] = array(
    '#type' => 'select',
    '#title' => t('Debugging'),
    '#options' => array(
      FUNNELBACK_DEBUG_NONE => t('None'),
      FUNNELBACK_DEBUG_LOG => t('Log requests'),
      FUNNELBACK_DEBUG_VERBOSE => t('Verbose output'),
    ),
    '#default_value' => variable_get('funnelback_debug_mode', FUNNELBACK_DEBUG_NONE),
  );

  return system_settings_form($form);
}

/**
 * Form validation callback for the funnelback admin form.
 */
function funnelback_admin_form_validate($form, &$form_state) {

  return system_settings_form($form);
}
