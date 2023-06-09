<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function agov_whitlam_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  agov_whitlam_preprocess_html($variables, $hook);
  agov_whitlam_preprocess_page($variables, $hook);
}
// */

/**
 * Implements hook_preprocess_html().
 */
function agov_whitlam_preprocess_html(&$variables, $hook) {
  // Add google fonts.
  drupal_add_html_head_link(array(
    "href" => "//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700",
    "rel" => "stylesheet",
    "type" => "text/css",
  ));
}

/**
 * Override or insert variables into the page templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function agov_whitlam_preprocess_page(&$variables, $hook) {
  // Search page title should tell you if there are results.
  if (arg(0) === 'search' && arg(1) != '') {
    $variables['title'] = t('Search Results');
  }
}

/**
 * Override or insert variables into the node templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function agov_whitlam_preprocess_node(&$variables, $hook) {
  $node = $variables['node'];
  $variables['date'] = format_date($node->created, 'custom', 'j M Y');
  $variables['submitted'] = t('By !username on !datetime', array('!username' => $variables['name'], '!datetime' => $variables['date']));

  // Optionally, run node-type-specific preprocess functions, like
  // agov_whitlam_preprocess_node_page() or
  // agov_whitlam_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }

  if ($variables['type'] == 'footer_teaser' &&  $variables['teaser'] == TRUE) {
    $field_reference_path = $variables['field_reference'][0]['entity']->path['alias'];

    if (isset($field_reference_path)) {
      $variables['node_url'] = check_url($field_reference_path);
      unset($variables['content']['field_reference']);
    }
  }
}

/**
 * Implements hook_process_node().
 */
function agov_whitlam_process_node(&$variables) {
  // Override agov_zen's dynamic title tag for compact view modes
  // but only if Display Suite HASN'T already been used.
  if (!isset($variables['rendered_by_ds']) || $variables['rendered_by_ds'] != TRUE) {
    if (isset($variables['view_mode']) && $variables['view_mode'] === 'compact') {
      // Most compact views don't have a h2 preceding them
      // so we need to set the node title tag back to h2.
      $variables['title_tag'] = 'h2';

      // The following views DO have a h2 title preceding
      // the compact node title.
      $view_names = array('latest_updates');
      if (isset($variables['view']) && in_array($variables['view']->name, $view_names)) {
        $variables['title_tag'] = 'h3';
      }
    }
  }
}

/**
 * Override or insert variables into the comment templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
function agov_whitlam_preprocess_comment(&$variables, $hook) {
  $comment = $variables['comment'];
  $variables['submitted'] = t('<span class="field author">!username</span> - <span class="field date-month">!date</span>',
    array(
      '!username' => $variables['author'],
      '!date' => format_date($comment->created, 'custom', 'l d M, Y'),
    ));
  if (variable_get('comment_subject_field_' . $variables['node']->type, 1) == 0) {
    $variables['title'] = '';
  }
}

/**
 * Implements hook_preprocess_comment_wrapper().
 */
function agov_whitlam_preprocess_comment_wrapper(&$variables, $hook) {
  if ($variables['node']->comment_count) {
    $variables['total_comments_in_node'] = $variables['node']->comment_count;
  }
  else {
    $variables['total_comments_in_node'] = 0;
  }
}


/**
 * Override or insert variables into the region templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function agov_whitlam_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  if (strpos($variables['region'], 'sidebar_') === 0) {
    $variables['theme_hook_suggestions'] = array_diff(
      $variables['theme_hook_suggestions'], array('region__sidebar')
    );
  }
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function agov_whitlam_preprocess_block(&$variables, $hook) {
  $block = $variables['elements']['#block'];

  // Add a border to all the blocks in the sidebar_second region.
  if ($block->region === 'sidebar_second') {
    $variables['classes_array'][] = 'divider';
  }

  if ($block->delta === 'menu-quick-links') {
    $variables['classes_array'][] = 'nav-menu__wrapper';
  }
}

/**
 * Override variables into the icon_block bean templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 */
function agov_whitlam_preprocess_entity(&$variables) {
  $entity_type = $variables['elements']['#entity_type'];
  $entity = $variables['elements']['#entity'];

  if ($entity_type == 'bean' && $entity->type == 'icon_block') {
    $icon = field_get_items($entity_type, $entity, 'field_icon');
    $variables['box_icon'] = isset($icon[0]['value']) ? $icon[0]['value'] : NULL;

    $link_to = field_get_items($entity_type, $entity, 'field_link_to');
    if (isset($link_to[0]['url'])) {
      $variables['box_link_to'] = array(
        '#type' => 'link',
        '#href' => $link_to[0]['url'],
        '#title' => isset($link_to[0]['title']) ? $link_to[0]['title'] : $link_to[0]['url'],
      );
    }
    else {
      $variables['box_link_to'] = NULL;
    }

    $text = field_get_items($entity_type, $entity, 'field_bean_text');
    $variables['box_text'] = isset($text[0]['value']) ? $text[0]['value'] : NULL;

    // Create a custom theme hook suggestion for beans on the front page.
    if ($variables['is_front'] == TRUE) {
      $variables['theme_hook_suggestions'][] = 'bean__icon_block__front';
    }
  }
}

/**
 * Implements hook_form_alter().
 */
function agov_whitlam_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_api_page_search_form') {
    $form['#prefix'] = '<div class="search__wrapper">';
    $form['#suffix'] = '</div>';

    // Set placeholder and hide the label.
    $form['form']['keys_1']['#placeholder'] = t('Enter your keywords');
    $form['form']['keys_1']['#title_display'] = 'invisible';

    // Add the search icon.
    $form['form']['submit_1']['#prefix'] = '<div class="search__button-wrapper"><span class="fa fa-search search__icon" aria-hidden="true"></span>';
    $form['form']['submit_1']['#suffix'] = '</div>';
  }

  if ($form_id == 'search_api_page_search_form_default_search') {
    // Add the search icon.
    $form['submit_1']['#prefix'] = '<div class="search__button-wrapper"><span class="fa fa-search search__icon" aria-hidden="true"></span>';
    $form['submit_1']['#suffix'] = '</div>';
  }
}
