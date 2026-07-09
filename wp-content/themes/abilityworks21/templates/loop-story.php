<?php
$thumbStyle = '';
if ( has_post_thumbnail() ) {
  $thumbStyle = "background-image:url(" . get_the_post_thumbnail_url( null, 'full' ) . ");";
}
$storyTags = wp_get_post_terms( get_the_ID(), 'pxa-story-tag' );
?>
<div class="loop-story">
  <a href="<?php the_permalink();?>" class="thumb" style="<?php echo $thumbStyle; ?>"></a>
  <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
  <?php the_excerpt(); ?>
  <?php if ( sizeof($storyTags) ) : ?>
    <ul class="cats">
      <?php foreach ( $storyTags as $vidCat ) : ?>
        <li><span><?php echo $vidCat->name; ?></span></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <a href="<?php the_permalink();?>" class="arrow-link">Find out more</a>
</div>
