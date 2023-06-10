<?php
/**
 * @file
 * Metatag integration for the AGLS module.
 */

/**
 * Implements hook_metatag_info().
 */
function agls_metatag_info() {
  // Define the AGLS group.
  $info['groups']['agls'] = array(
    'label' => t('AGLS'),
    'description' => t('The <a href="http://www.agls.gov.au/">AGLS Metadata Standard</a> provides a set of metadata properties and associated usage guidelines to improve the visibility, manageability and interoperability of online information and services.'),
    'form' => array(
      '#weight' => 95,
    ),
  );

  $weight = 90;
  $defaults = array(
    'class' => 'DrupalTextMetaTag',
    'group' => 'agls',
  );

  // AGLS specific terms.
  $info['tags']['AGLSTERMS.act'] = array(
    'label' => t('Act'),
    'description' => t('A specific piece of legislation which requires or drives the creation or provision of the resource.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.aggregationLevel'] = array(
    'label' => t('Aggregation Level'),
    'description' => t('The level of aggregation of the described resource. There are only two valid values for this property—‘item’ or ‘collection’.'),
    'form' => array(
      'value' => array(
        '#type' => 'select',
        '#options' => array('item', 'collection'),
        '#empty_option' => t('- None -'),
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.availability'] = array(
    'label' => t('Availability'),
    'description' => t('How the resource can be obtained or accessed, or contact information. The availability property is primarily used for offline resources to provide information on how to obtain physical access to the resource. <em>Mandatory for offline resources</em>.'),
    'form' => array(
      'scheme' => array(
        '#description' => t('Possible values are AglsAgent, GOLD, or URI.'),
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.case'] = array(
    'label' => t('Case'),
    'description' => t('A specific piece of case law which requires or drives the creation or provision of the resource .'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.category'] = array(
    'label' => t('Category'),
    'description' => t('The generic type of the resource being described. There are only three valid values for this property—"service", "document" or "agency".'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.dateLicenced'] = array(
    'label' => t('Date licenced'),
    'description' => t('Date a license was applied or became effective.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.documentType'] = array(
    'label' => t('Document type'),
    'description' => t('The form of the described resource where the value of category is "document". Document is used in its widest sense and includes resources such as text, images, sound files and software.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.function'] = array(
    'label' => t('Function'),
    'description' => t('The business function to which the resource relates (Recommended if dcterms:subject is not used). AGIFT is the recommended thesaurus for Australian government agencies.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['dcterms.isBasisFor'] = array(
    'label' => t('Is Basis For (Dublin Core)'),
    'description' => t('A related resource that is a performance, production, derivation, translation or interpretation of the described resource.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['dcterms.isBasedOn'] = array(
    'label' => t('Is Based On (Dublin Core)'),
    'description' => t('A related resource of which the described resource is a performance, production, derivation, translation or interpretation.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.jurisdiction'] = array(
    'label' => t('Jurisdiction'),
    'description' => t('The name of the political/administrative entity covered by the described resource.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.mandate'] = array(
    'label' => t('Mandate'),
    'description' => t('A specific legal instrument which requires or drives the creation or provision of the resource. The property is useful to indicate the specific legal instrument which requires the resource being described to be created or provided. The value of this property may a text string describing a specific Act, Regulation or Case, or a URI pointing to the legal instrument in question'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.protectiveMarking'] = array(
    'label' => t('Protective marking'),
    'description' => t('A protective marking applied to the described resource.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.regulation'] = array(
    'label' => t('Regulation'),
    'description' => t('A specific regulation which requires or drives the creation or provision of the resource.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.rightsHolder'] = array(
    'label' => t('Rights holder'),
    'description' => t('A person or organisation owning or managing rights over the resource.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.spatial'] = array(
    'label' => t('Spatial'),
    'description' => t('Spatial characteristics of the resource.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['AGLSTERMS.serviceType'] = array(
    'label' => t('Service type'),
    'description' => t('The form of the described resource where the value of category is "service".'),
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
