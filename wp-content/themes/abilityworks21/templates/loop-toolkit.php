<?php
$thumbStyle = '';
if ( has_post_thumbnail() ) {
  $thumbStyle = "background-image:url(" . get_the_post_thumbnail_url( null, 'full' ) . ");";
}
?>
<div class="loop-toolkit">
  <a href="<?php the_permalink();?>" class="thumb" style="<?php echo $thumbStyle; ?>"></a>
  <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
  <?php the_excerpt(); ?>
  <a href="<?php the_permalink();?>" class="arrow-link">Find out more</a>
</div>
