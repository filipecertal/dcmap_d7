<?php

/**
 * @file
 * Contains Funnelback\Response
 */

namespace Funnelback;

/**
 * The Funnelback search response.
 */
class Response {

  /**
   * The base url.
   *
   * @var string
   */
  protected $baseUrl;

  /**
   * The http response.
   *
   * @var \stdClass
   */
  protected $httpResponse;

  /**
   * The json response body.
   *
   * @var array
   */
  protected $responseJson;

  /**
   * The return code.
   *
   * @var int
   */
  protected $returnCode;

  /**
   * The facets, grouped by category.
   *
   * @var array
   */
  protected $facets;

  /**
   * The result summary.
   *
   * @var \Funnelback\ResultSummary
   */
  protected $resultsSummary;

  /**
   * The results.
   *
   * @var \Funnelback\Result[]
   */
  protected $results;

  /**
   * The search query.
   *
   * @var string
   */
  protected $query;

  /**
   * The total time taken in millis.
   *
   * @var int
   */
  protected $totalTimeMillis;

  /**
   * Creates a new Funnelback response.
   *
   * @param string $base_url
   *   Relative urls are prepended with this string.
   * @param \stdClass $http_response
   *   The http response.
   */
  public function __construct($base_url, \stdClass $http_response) {
    $this->baseUrl = $base_url;
    $this->httpResponse = $http_response;
    $this->responseJson = json_decode($http_response->data);
    $this->query = $this->responseJson->question->query;
    $response = $this->responseJson->response;
    $this->returnCode = $response->returnCode;
    $this->totalTimeMillis = $response->performanceMetrics->totalTimeMillis;
    $result_packet = $response->resultPacket;
    $this->resultsSummary = new ResultSummary(isset($result_packet->resultsSummary) ? $result_packet->resultsSummary : NULL);
    $this->results = $this->buildResults(isset($result_packet->results) ? $result_packet->results : NULL);
    $this->facets = $this->buildFacets(isset($result_packet->contextualNavigation) ? $result_packet->contextualNavigation->categories : NULL);
  }

  /**
   * Gets the http response.
   *
   * @return \stdClass
   *   The return code.
   */
  public function getHttpResponse() {
    return $this->httpResponse;
  }

  /**
   * Gets the return code.
   *
   * @return int
   *   The return code.
   */
  public function getReturnCode() {
    return $this->returnCode;
  }

  /**
   * Gets the summary.
   *
   * @return \Funnelback\ResultSummary
   *   The results summary.
   */
  public function getResultsSummary() {
    return $this->resultsSummary;
  }

  /**
   * Gets the results.
   *
   * @return \Funnelback\Result[]
   *   The results.
   */
  public function getResults() {
    return $this->results;
  }

  /**
   * Gets the facets.
   *
   * @return \Funnelback\Facet[]
   *   The facets.
   */
  public function getFacets() {
    return $this->facets;
  }

  /**
   * Gets the query.
   *
   * @return string
   *   The query.
   */
  public function getQuery() {
    return $this->query;
  }

  /**
   * Gets the time taken in millis.
   *
   * @return int
   *   The time taken in millis.
   */
  public function getTotalTimeMillis() {
    return $this->totalTimeMillis;
  }

  /**
   * Builds a list of results from the results data.
   *
   * @param array $results_data
   *   The results data.
   *
   * @return \Funnelback\Result[]
   *   The results.
   */
  protected function buildResults($results_data) {
    $results = array();
    if (!empty($results_data)) {
      foreach ($results_data as $result_data) {
        $results[] = new Result($result_data, $this->baseUrl);
      }
    }
    return $results;
  }

  /**
   * Builds a list of facets grouped by category.
   *
   * @param array $facets_data
   *   The raw facet data.
   *
   * @return array
   *   A list of facets grouped by category.
   */
  protected function buildFacets($facets_data) {
    $facets = array();
    if (!empty($facets_data)) {
      foreach ($facets_data as $facet_data) {
        $facet = new Facet($facet_data);
        $facets[$facet->getName()] = $facet;
      }
    }
    return $facets;
  }

}
