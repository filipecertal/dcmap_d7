<?php
/**
 * @file
 * Administration pages for the 'TOC filter' module.
 */

/**
 * Form builder; Settings page for the 'TOC filter' module.
 *
 * @ingroup forms
 */
function toc_filter_admin_settings() {
  $form['toc_filter_header_tag'] = [
    '#type' => 'select',
    '#title' => t('Header tag'),
    '#description' => t('The selected header tag is used to generate the table of contents when the TOC filter is assigned to an input format.'),
    '#options' => [
      'h1' => 'h1',
      'h2' => 'h2',
      'h3' => 'h3',
      'h4' => 'h4',
      'h5' => 'h5',
      'h6' => 'h6',
    ],
    '#required' => 1,
    '#default_value' => variable_get('toc_filter_header_tag', 'h3'),
  ];

  $form['toc_filter_default_top'] = [
    '#type' => 'checkbox',
    '#title' => t('Insert table of contents by default'),
    '#description' => t('Check to automatically place a Table of Contents at the top.'),
    '#default_value' => variable_get('toc_filter_default_top', '0'),
  ];

  $form['toc_filter_default_type'] = [
    '#type' => 'select',
    '#title' => t('Default Type'),
    '#description' => t('Select the type of list that should be inserted by default.'),
    '#default_value' => variable_get('toc_filter_default_type', 'ul'),
    '#options' => [
      'faq' => 'faq',
      'ol' => 'ol',
      'number' => 'number',
      'ul',
      'bullet',
      'jump-menu',
      'menu',
    ],
    '#states' => [
      'disabled' => [
        ':input[name="toc_filter_default_top"]' => ['checked' => FALSE],
      ],
    ],
  ];

  $form['toc_filter_bullet_default_title'] = [
    '#type' => 'textfield',
    '#title' => t('Un-order (bullet) list default title'),
    '#default_value' => variable_get('toc_filter_bullet_default_title', ''),
  ];

  $form['toc_filter_number_default_title'] = [
    '#type' => 'textfield',
    '#title' => t('Order (number) list default title'),
    '#default_value' => variable_get('toc_filter_number_default_title', ''),
  ];

  $form['toc_filter_faq_default_title'] = [
    '#type' => 'textfield',
    '#title' => t('FAQ default title'),
    '#default_value' => variable_get('toc_filter_faq_default_title', ''),
  ];

  if (module_exists('ctools')) {
    $form['toc_filter_jump_menu_default_title'] = [
      '#type' => 'textfield',
      '#title' => t('Jump menu default title'),
      '#default_value' => variable_get('toc_filter_jump_menu_default_title', ''),
      '#description' => t('The jump menu title will appear as the first item in the select menu.'),
    ];
  }

  $form['toc_filter_smooth_scroll'] = [
    '#type' => 'checkbox',
    '#title' => t('Enable smooth scrolling'),
    '#description' => t('Smooth scrolling will be applied to all anchor links'),
    '#default_value' => variable_get('toc_filter_smooth_scroll', '1'),
  ];

  $form['toc_filter_smooth_scroll_duration'] = [
    '#type' => 'select',
    '#title' => t('Smooth scrolling duration'),
    '#default_value' => variable_get('toc_filter_smooth_scroll_duration', ''),
    '#options' => [
      'slow' => 'slow',
      '' => 'medium',
      'fast' => 'fast',
    ],
  ];

  return system_settings_form($form);
}
