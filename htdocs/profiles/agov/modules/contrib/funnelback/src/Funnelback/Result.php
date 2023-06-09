<?php

/**
 * @file
 * Contains Funnelback\Result
 */

namespace Funnelback;

/**
 * A Funnelback search result.
 */
class Result {

  /**
   * The title.
   *
   * @var string
   */
  protected $title;

  /**
   * The date.
   *
   * @var string
   */
  protected $date;

  /**
   * The summary.
   *
   * @var string
   */
  protected $summary;

  /**
   * The live url.
   *
   * @var string
   */
  protected $liveUrl;

  /**
   * The cache url.
   *
   * @var string
   */
  protected $cacheUrl;

  /**
   * The click url.
   *
   * @var string
   */
  protected $clickUrl;

  /**
   * The result data.
   *
   * @var array
   */
  protected $resultData;

  /**
   * Creates a new result.
   *
   * @param \stdClass $result_data
   *   The raw result data.
   * @param string $base_url
   *   The base url tobe prepended to relative urls.
   */
  public function __construct($result_data, $base_url) {
    $this->cacheUrl = $this->basedUrl($base_url, $result_data->cacheUrl);
    $this->cacheUrl = $this->basedUrl($base_url, $result_data->cacheUrl);
    $this->clickUrl = $this->basedUrl($base_url, $result_data->clickTrackingUrl);
    $date = new \DateTime('now', new \DateTimeZone("UTC"));
    // Remove milliseconds.
    $date->setTimestamp($result_data->date / 1000);
    $this->date = $date;
    $this->liveUrl = $this->basedUrl($base_url, $result_data->liveUrl);
    $this->summary = $result_data->summary;
    $this->title = $result_data->title;
    $this->fileType = isset($result_data->fileType) ? $result_data->fileType : FALSE;
    $this->fileSize = isset($result_data->fileSize) ? $result_data->fileSize : FALSE;
    $this->resultData = $result_data;
  }

  /**
   * Gets the title.
   *
   * @return string
   *   The title.
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Gets the file type.
   *
   * @return string
   *   The file type.
   */
  public function getFileType() {
    return $this->fileType;
  }

  /**
   * Gets the file size.
   *
   * @return mixed
   *   File size in bytes or FALSE.
   */
  public function getFileSize() {
    return $this->fileSize;
  }

  /**
   * Gets the date.
   *
   * @return \DateTime
   *   The date.
   */
  public function getDate() {
    return $this->date;
  }

  /**
   * Gets the summary.
   *
   * @return string
   *   The summary.
   */
  public function getSummary() {
    return $this->summary;
  }

  /**
   * Gets the live url.
   *
   * @return string
   *   The live url.
   */
  public function getLiveUrl() {
    return $this->liveUrl;
  }

  /**
   * Gets the cache url.
   *
   * @return string
   *   The cache url.
   */
  public function getCacheUrl() {
    return $this->cacheUrl;
  }

  /**
   * Gets the click url.
   *
   * @return string
   *   The click url.
   */
  public function getClickUrl() {
    return $this->clickUrl;
  }

  /**
   * Gets the raw result data.
   *
   * @return array
   *   The raw result data.
   */
  public function getResultData() {
    return $this->resultData;
  }

  /**
   * Prepend relative URL with the base url.
   *
   * @param string $base_url
   *   The base url.
   * @param string $src_url
   *   The source url
   *
   * @return string
   */
  protected function basedUrl($base_url, $src_url) {
    $url = $src_url;
    if (!empty($url) && strpos($src_url, 'http') !== 0) {
      $url = $base_url . $url;
    }
    return $url;
  }

}
