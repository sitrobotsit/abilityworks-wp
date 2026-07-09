<?php
global $sectionCounter;
$toolkit = get_sub_field('toolkit');
?>
<section <?php PXA_Helpers::SectionAttrs('highlighted-toolkit'); ?> data-index="<?php echo $sectionCounter; ?>">
  <div class="container">
    <div class="inn">
      <?php if ( has_post_thumbnail($toolkit) ) : ?>
        <a href="<?php echo get_permalink($toolkit);?>" class="heroimg">
          <?php echo get_the_post_thumbnail( $toolkit, 'full', ['class' => 'img-fluid'] );?></a>
      <?php endif; ?>
      <div class="details">
        <h4 class="subtitle">HIGHLIGHTED TOOLKIT</h4>
        <h2 class="title"><?php echo get_the_title( $toolkit );?></h2>
        <p><?php echo get_the_excerpt( $toolkit ); ?></p>
        <a href="<?php echo get_permalink($toolkit);?>" class="more">Find out more</a>
      </div>
    </div>
  </div>
</section>
<?php
$bg_image = get_sub_field('bg_image');
$bg_image_mob = get_sub_field('bg_image_mob');

PXA_Helpers::SectionStyles('highlighted-toolkit', $sectionCounter, [
  'mobile' => [
    'background-image' => "url({$bg_image_mob})",
  ],
  'tablet' => [
    'background-image' => "url({$bg_image})",
  ],
  'desktop' => [
  ],
  'large' => [
  ],
]);
