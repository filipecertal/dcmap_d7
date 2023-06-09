<?php

/**
 * @file
 * Contains \Funnelback\ClientInterface
 */


namespace Funnelback;

/**
 * Provides an interface for the Funnelback client.
 */
interface ClientInterface {

  const XML_FORMAT = "xml";

  const JSON_FORMAT = "json";

  const HTML_FORMAT = "html";

  /**
   * Returns the base url.
   *
   * @return string
   *   The base url.
   */
  public function getBaseUrl();

  /**
   * The search collection.
   *
   * @return string
   *   The collection.
   */
  public function getCollection();

  /**
   * The search profile.
   *
   * @return string
   *   The profile or NULL if not set.
   */
  public function getProfile();

  /**
   * The default format.
   *
   * @return string
   *   The format.
   */
  public function getFormat();

  /**
   * Returns the allowed formats.
   *
   * @return array
   *   The allowed formats.
   */
  public function allowedFormats();

  /**
   * Perform a search query.
   *
   * @param array $params
   *   The search parameters.
   *
   * @return \Funnelback\Response
   *   The search response.
   */
  public function search($params);

}
