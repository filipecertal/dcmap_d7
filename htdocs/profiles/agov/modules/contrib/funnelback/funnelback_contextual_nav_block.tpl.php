<?php
/**
 * @file
 * Contextual navigation template for Funnelback.
 */
$items = $facets->getFacetItems();
?>

<?php if (!empty($items)): ?>
  <div class="contextual-nav">
    <h3><em><?php print $query; ?></em> by <?php print $facets->getName(); ?></h3>
    <ul>
      <?php foreach($items as $item):?>
          <li><a href="<?php print '?' . funnelback_encode_search_params($item->getParams()); ?>"><?php print $item->getLabel(); ?></a></li>
      <?php endforeach ?>
    </ul>
  </div>
<?php endif; ?>