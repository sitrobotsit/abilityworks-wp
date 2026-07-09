<?php
global $post;
$link = get_field('post_resource_link');

$categories = wp_get_post_terms( $post->ID, 'category' );
$aCats = array_map(function($cat){
  return $cat->name;
}, $categories);

$phases = wp_get_post_terms( $post->ID, 'pxa-phase' );

$icon = false;
$resourceTypeId = get_field('post_resource_type');
if ( $resourceTypeId ) {
  $icon = get_field('resource_type_icon', $resourceTypeId);
  $isVideo = ($resourceTypeId == get_field('video_resource_type', 'option'));
  if ( $isVideo ) {
    $pageVideoUrl = get_field('page_video_library', 'option');
    $link['url'] = $pageVideoUrl . '?vid=' . get_the_ID();
  }
}

$bgColor = get_field('post_resource_bgcolor');
if ( empty($bgColor) ) $bgColor = '#ffffff';
?>
<div class="card-resource">
  <?php if ( $link && !empty($link['url']) ) : ?>
    <a<?php echo $link['new_tab'] ? ' target="_blank" class="link tippy" data-tippy-content="This link will be opened in a new tab"' : ' class="link"'; ?>
      href="<?php echo $link['url']; ?>"><?php the_title(); ?></a>
  <?php else: ?>
    <a href="<?php the_permalink(); ?>" class="link"><?php the_title(); ?></a>
  <?php endif; ?>

  <div class="bg" style="background:<?php echo $bgColor; ?>;"></div>

  <div class="card-top">
    <div class="resource-cat"><?php echo implode(', ', $aCats); ?></div>
    <h3><?php the_title(); ?></h3>
  </div>

  <ul class="phases">
    <?php
      if ( is_array($phases) && sizeof($phases) > 0 ) :
        foreach ( $phases as $phase ) :
    ?>
      <li><?php echo $phase->name; ?></li>
    <?php
        endforeach;
      endif;
    ?>
  </ul>

  <div class="card-btm">
    <?php if ( $icon ) : ?>
      <img src="<?php echo $icon['url']; ?>" class="type-icon" alt="Icon <?php echo implode(', ', $aCats); ?>">
    <?php endif; ?>
    <?php if ( $link && !empty($link['label']) ) : ?>
      <span class="arrow-link"><?php echo $link['label']; ?></span>
    <?php else: ?>
      <span class="arrow-link">Find out more</span>
    <?php endif; ?>
  </div>
</div>
