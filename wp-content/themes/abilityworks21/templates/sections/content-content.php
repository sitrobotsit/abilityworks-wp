<?php
$light_mode = get_sub_field('light_mode');
$align_items = get_sub_field('align_items');
if ( empty($align_items) ) {
  $align_items = 'flex-start';
}
?>
<section <?php PXA_Helpers::SectionAttrs('content-content'); ?>>
  <div class="container">
    <div class="inn" style="align-items: <?php echo $align_items; ?>;">
      <div class="ct">
        <div class="format<?php echo $light_mode ? ' light-mode' : '';?>">
          <?php the_sub_field('left_content'); ?>
        </div>
      </div>
      <div class="ct">
        <div class="format<?php echo $light_mode ? ' light-mode' : '';?>">
          <?php the_sub_field('right_content'); ?>
        </div>
      </div>
    </div>
  </div>
</section>
