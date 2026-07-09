<?php
$thumbStyle = '';
if ( has_post_thumbnail() ) {
  $thumbStyle = "background-image:url(" . get_the_post_thumbnail_url( null, 'full' ) . ");";
}
$vidCats = wp_get_post_terms( get_the_ID(), 'pxa-video-cat' );
?>
<div class="loop-video">
  <a href="javascript:;" class="has-play-icon thumb play-video-onpage" rel="<?php the_ID(); ?>"
    style="background-color:#63bfb5;<?php echo $thumbStyle; ?>"></a>
  <h3><?php the_title();?></h3>
  <?php the_excerpt(); ?>
  <?php if ( sizeof($vidCats) ) : ?>
    <ul class="cats">
      <?php foreach ( $vidCats as $vidCat ) : ?>
        <li><span><?php echo $vidCat->name; ?></span></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <a href="javascript:;" rel="<?php the_ID(); ?>" class="play-video-onpage arrow-link">Find out more</a>
</div>
