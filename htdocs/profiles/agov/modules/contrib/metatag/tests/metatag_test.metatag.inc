<?php

/**
 * @file
 * Metatag API implementations for the Metatag Test module.
 */

/**
 * Implements hook_metatag_config_default().
 *
 * @todo Expand to cover more meta tags.
 *
 * @see MetatagTestBase::getTestDefaults()
 */
function metatag_test_metatag_config_default() {
  $configs = array();

  $config = new stdClass();
  $config->instance = 'test';
  $config->api_version = 1;
  $config->disabled = FALSE;
  $config->config = array(
    'description' => array('value' => 'Test description'),
  );
  $configs[$config->instance] = $config;

  $config = new stdClass();
  $config->instance = 'test:foo';
  $config->api_version = 1;
  $config->disabled = FALSE;
  $config->config = array(
    'title' => array('value' => 'Test title'),
    'abstract' => array('value' => 'Test foo abstract'),
    'description' => array('value' => 'Test foo description'),
    'test:foo' => array('value' => 'foobar'),
  );
  $configs[$config->instance] = $config;

  return $configs;
}

/**
 * Implements hook_metatag_config_default_alter().
 */
function metatag_test_metatag_config_default_alter(array &$configs) {
  if (isset($configs['test:foo'])) {
    $configs['test:foo']->config['title']['value'] = 'Test altered title';
  }
}

/**
 * Implements hook_metatag_info().
 */
function metatag_test_metatag_info() {
  $info['groups']['testing'] = array(
    'label' => t('Testing'),
    'form' => array(
      '#weight' => 100,
    ),
  );

  $info['tags']['test:foo'] = array(
    'label' => t('Foo meta tag'),
    'description' => t('Testing metatag.'),
    'class' => 'DrupalTextMetaTag',
    'group' => 'testing',
  );

  $info['tags']['test:multifoo'] = array(
    'label' => t('Multi foo meta tag'),
    'description' => t('Testing metatag.'),
    'class' => 'DrupalTextMetaTag',
    'group' => 'testing',
    'multiple' => TRUE,
  );

  $info['tags']['test:nodesc'] = array(
    'label' => t('Meta tag with no description attribute'),
    'class' => 'DrupalTextMetaTag',
    'multiple' => TRUE,
  );

  return $info;
}
