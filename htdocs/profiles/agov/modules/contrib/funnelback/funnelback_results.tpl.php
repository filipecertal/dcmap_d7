<?php
/**
 * @file
 * Template file for funnelback results.
 */

?>
<div id="funnelback-results-page">

  <?php if ($summary->getTotal() > 0): ?>

    <div id="funnelback-summary">
      <?php print $summary->getStart() ?> - <?php print $summary->getEnd() ?>
      search results of <?php print $summary->getTotal() ?>
      for <strong><?php print funnelback_dress_query($params['query']); ?></strong>
    </div>

    <?php if (!empty($best_bets)): ?>
      <div id="funnelback-bestbets">

        <?php foreach($best_bets as $best_bet): ?>

          <div class="funnelback-bestbet">
            <h4>Recommended</h4>
            <h3><a href="<?php print $best_bet['click_url'] ?>" title="<?php print $best_bet['live_url'] ?>"><?php print $best_bet['title'] ?></a></h3>
            <p class="desc"><?php print $best_bet['desc'] ?></p>
            <p><cite><?php print $best_bet['live_url'] ?></cite></p>
          </div>

        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>

  <?php // always show spelling options ?>

  <?php if (!empty($spell)): ?>
    <div id="funnelback-spell">
      <p>Did you mean:
        <?php foreach ($spell as $suggestion): ?>
          <a href='?<?php print $suggestion['url'] ?>'><?php print $suggestion['text'] ?></a>
        <?php endforeach; ?>
      </p>
    </div>
  <?php endif; ?>

  <?php if ($summary->getTotal() > 0): ?>

    <ul id="funnelback-results">
      <?php foreach ($results->getResults() as $result): ?>
        <li class="funnelback-result file-type-<?php print ($result->getFileType() ? $result->getFileType() : 'none'); ?>">
          <h3>
            <a href="<?php print $result->getClickUrl() ?>" title="<?php print $result->getLiveUrl() ?>"><?php print $result->getTitle() ?></a>
          </h3>
          <p>
            <?php if ($result->getDate()): ?>
                <span class="date"><?php print $result->getDate()->format('d-m-Y'); ?></span>
            <?php endif; ?>
            <span class="summary"><?php print $result->getSummary(); ?></span>
          </p>
          <p>
            <?php if ($result->getFileSize()): ?>
              <span class="filesize"><?php print funnelback_formatBytes($result->getFileSize()); ?></span> -
              <span class="filetype_label"><?php print $result->getFileType(); ?></span>
              <a href="<?php print $result->getCacheUrl(); ?>">View as HTML</a><br />
            <?php endif; ?>
            <cite><?php print $result->getLiveUrl(); ?></cite> - <a href="<?php print $result->getCacheUrl(); ?>">Cached</a>
          </p>
        </li>
      <?php endforeach; ?>
    </ul>

  <?php else: ?>

    <?php if (isset($params['query'])): ?>
      <p>Your search for <strong><?php print $params['query'] ?></strong> did not return any results.
      <p>Please ensure that you:
      <ul class="no-result">
        <li>are not using any advanced search operators like + - | " etc.</li>
        <li>expect this document to exist within this site</li>
        <li>have permission to see any documents that may match your query</li>
      </ul>
      </p>
    <?php else: ?>
      <p>No search requested</p>
    <?php endif; ?>

  <?php endif; ?>

  <?php print $pager ?>

</div>
