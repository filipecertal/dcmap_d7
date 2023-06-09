<?php

/**
 * @file
 */

namespace Funnelback;

/**
 * Funnelback client.
 */
class DrupalClient implements ClientInterface {

  /**
   * The drupal_http_request result object.
   *
   * @var \stdClass
   */
  protected $httpResult;

  /**
   * The base url.
   *
   * @var string
   */
  protected $baseUrl;

  /**
   * The response format.
   *
   * Valid values are XML, JSON, and HTML.
   *
   * @var string
   *  The response format.
   */
  protected $format;

  /**
   * The search collection.
   *
   * @var string
   */
  protected $collection;

  /**
   * The search profile if required.
   *
   * @var string
   */
  protected $profile;

  /**
   * Creates a new Funnelback client.
   *
   * @param array $config
   *   The funnelback config.
   */
  public function __construct(array $config) {
    $this->baseUrl = $config['base_url'];
    $format = isset($config['format']) ? $config['format'] : self::JSON_FORMAT;
    $this->setFormat($format);
    $this->collection = $config['collection'];
    $this->profile = isset($config['profile']) ? $config['profile'] : NULL;
    $this->httpResult = NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function getBaseUrl() {
    return $this->baseUrl;
  }

  /**
   * {@inheritdoc}
   */
  public function getCollection() {
    return $this->collection;
  }

  /**
   * {@inheritdoc}
   */
  public function getProfile() {
    return $this->profile;
  }

  /**
   * Set the format to use.
   *
   * @param string $format
   *   The format.
   */
  protected function setFormat($format) {
    $format = trim(strtolower($format));
    if (!$this->isValidFormat($format)) {
      throw new \InvalidArgumentException(sprintf('Invalid format: %s. Allowed formats are %s',
        $format,
        implode(',', $this->allowedFormats())
      ));
    }
    $this->format = $format;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormat() {
    return $this->format;
  }

  /**
   * {@inheritdoc}
   */
  public function getResult() {
    return $this->httpResult;
  }

  /**
   * {@inheritdoc}
   */
  public function allowedFormats() {
    return array($this::JSON_FORMAT);
  }

  /**
   * {@inheritdoc}
   */
  public function search($params) {
    // Extend the request parameters.
    $params['collection'] = $this->getCollection();
    if ($this->getProfile() != NULL) {
      $params['profile'] = $this->getProfile();
    }

    $this->httpResult = $this->doRequest($params);

    return new Response($this->baseUrl, $this->httpResult);
  }

  /**
   * Checks if the format is allowed.
   *
   * @param string $format
   *   The response format.
   *
   * @return bool
   *   TRUE if the format is allowed.
   */
  protected function isValidFormat($format) {
    return in_array($format, $this->allowedFormats());
  }

  /**
   * Get an API path for the current format.
   *
   * @return bool|string
   *   The API Path, or FALSE.
   */
  public function getPath() {
    $api_path = FALSE;
    $format = $this->getFormat();

    if ($format == ClientInterface::XML_FORMAT) {
      $api_path = 's/search.xml';
    }
    if ($format == ClientInterface::JSON_FORMAT) {
      $api_path = 's/search.json';
    }
    if ($format == ClientInterface::HTML_FORMAT) {
      $api_path = 's/search.html';
    }

    return $api_path;
  }

  /**
   * Make a request.
   *
   * @param array $params
   *   The request parameters.
   *
   * @return object
   *   The response object.
   */
  protected function doRequest($params) {
    $base_url = $this->getBaseUrl();
    $api_path = $this->getPath();

    // Build the search URL with query params.
    $url = $base_url . $api_path . '?' . drupal_http_build_query($params);

    // Make the request.
    $response = drupal_http_request($url);
    $response->url = $url;

    return $response;
  }

}
