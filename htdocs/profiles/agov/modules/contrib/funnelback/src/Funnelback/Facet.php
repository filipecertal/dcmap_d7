<?php

/**
 * @file
 * Contains Funnelback\Facet
 */


namespace Funnelback;

/**
 * A search facet.
 */
class Facet {

  const TYPE_TYPE = "type";

  const TOPIC_TYPE = "topic";

  const SITE_TYPE = "site";

  /**
   * The facet name.
   * Name of the category ("type", "topic" or "site").
   *
   * @var string
   * @see http://docs.funnelback.com/modernui-datamodel/com/funnelback/publicui/search/model/padre/Category.html#clusters
   */
  protected $name;

  /**
   * The raw facet data.
   *
   * @var array
   */
  protected $facetData;

  /**
   * The facet items.
   *
   * @var \Funnelback\FacetItem[]
   */
  protected $facetItems;

  /**
   * Creates a new facet.
   *
   * @param array $facet_data
   *   The raw facet data.
   */
  public function __construct($facet_data) {
    $this->facetData = $facet_data;
    $this->name = $facet_data->name;
    $this->facetItems = $this->buildFacetItems($facet_data->clusters);
  }

  /**
   * Gets the raw facet data.
   *
   * @return array
   *   The raw facet data.
   */
  public function getFacetData() {
    return $this->facetData;
  }

  /**
   * Gets the facet name.
   *
   * @return string
   *   The facet name.
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Gets the facet items.
   *
   * @return \Funnelback\FacetItem[]
   *   The facet items.
   */
  public function getFacetItems() {
    return $this->facetItems;
  }

  /**
   * Builds a list of facet items.
   *
   * @param array $facet_item_data
   *   The raw facet item data.
   *
   * @return \Funnelback\FacetItem[]
   *   The list of facet items.
   */
  protected function buildFacetItems($facet_item_data) {
    $facet_items = array();
    foreach ($facet_item_data as $facet_item_datum) {
      $facet_items[] = new FacetItem($facet_item_datum);
    }
    return $facet_items;
  }

}
