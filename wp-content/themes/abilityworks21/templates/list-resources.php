<?php if ( $grouping ) : ?>
  <?php foreach ($aGroups as $term) : ?>
    <div class="resources-group">
      <div class="group-title">
        <h3><?php echo $term->name; ?></h3>
        <a href="javascript:;" class="reset-search">RESET SEARCH</a>
      </div>
      <div class="group-items">
        <?php if ( isset($resourceGroups[$term->term_id]) && sizeof($resourceGroups[$term->term_id]) > 0 ) : ?>
          <?php foreach ( $resourceGroups[$term->term_id] as $resourceItem ) : ?>
            <div class="item">
              <?php echo $resourceItem; ?>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <div class="no-items">Sorry there are no resources that match your search results</div>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
<?php else : ?>
  <div class="resources-group">
    <?php if ( !empty($kw) ) : ?>
      <div class="group-title">
        <h3>Search results for ‘<?php echo $kw; ?>’ (<?php echo $foo->found_posts;?>)</h3>
        <a href="javascript:;" class="reset-search">RESET SEARCH</a>
      </div>
    <?php endif; ?>
    <div class="group-items">
      <?php if ( sizeof($resourceGroups['all']) ) : ?>
        <?php foreach ( $resourceGroups['all'] as $resourceItem ) : ?>
          <div class="item">
            <?php echo $resourceItem; ?>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="no-items">Sorry there are no resources that match your search results</div>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>
