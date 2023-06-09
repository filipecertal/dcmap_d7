<?php
/**
 * @file
 * agov_blog.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function agov_blog_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function agov_blog_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function agov_blog_node_info() {
  $items = array(
    'blog_article' => array(
      'name' => t('Blog Article'),
      'base' => 'node_content',
      'description' => t('Use <em>Blog articles</em> to reach your target audience directly. The top <em>Blog articles</em> will be displayed in the "Latest updates" section on the Front Page.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
