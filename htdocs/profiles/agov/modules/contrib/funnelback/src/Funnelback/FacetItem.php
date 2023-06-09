<?php

/**
 * @file
 * Contains Funnelback\FacetItem
 */

namespace Funnelback;

/**
 * A facet data item.
 */
class FacetItem {

  /**
   * The label.
   *
   * @var string
   */
  protected $label;

  /**
   * The count.
   *
   * @var int
   */
  protected $count;

  /**
   * The query string.
   *
   * @var string
   */
  protected $query;

  /**
   * The href string.
   *
   * @var string
   */
  protected $href;

  /**
   * The raw facet item data.
   *
   * @var array
   */
  protected $facetItemData;

  /**
   * Creates a new facet item.
   *
   * @param array $facet_item_data
   *   The raw facet item data.
   */
  public function __construct($facet_item_data) {
    $this->facetItemData = $facet_item_data;
    $this->label = $facet_item_data->label;
    $this->count = $facet_item_data->count;
    $this->query = $facet_item_data->query;
    $this->href = $facet_item_data->href;

    $params = array();
    $href_query = substr($this->href, strpos($this->href, '?') + 1);
    $href_query_parts = explode('&', $href_query);
    foreach ($href_query_parts as $href_query_part) {
      list($key, $value) = explode("=", $href_query_part, 2);
      $value_decoded = urldecode($value);
      $params[$key] = $value_decoded;
    }

    $this->params = $params;
  }

  /**
   * Gets the count.
   *
   * @return int
   *   The count.
   */
  public function getCount() {
    return $this->count;
  }

  /**
   * Gets the raw facet item data.
   *
   * @return array
   *   The raw facet item data.
   */
  public function getFacetItemData() {
    return $this->facetItemData;
  }

  /**
   * Gets the label.
   *
   * @return string
   *   The label.
   */
  public function getLabel() {
    return $this->label;
  }

  /**
   * Gets the query string param.
   *
   * @return string
   *   The query string param.
   */
  public function getQuery() {
    return $this->query;
  }

  /**
   * Gets the href.
   *
   * @return string
   *   The href string.
   */
  public function getHref() {
    return $this->href;
  }

  /**
   * Gets the params.
   *
   * @return array
   *   Array of url query parameters.
   */
  public function getParams() {
    return $this->params;
  }

}
