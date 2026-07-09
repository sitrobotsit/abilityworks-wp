<?php
$height_mob = (int) (isset($args['height_sm']) ? $args['height_sm'] : get_sub_field('height_sm'));
$height_tab = (int) (isset($args['height_md']) ? $args['height_md'] : get_sub_field('height_md'));
$height_pc = (int) (isset($args['height_lg']) ? $args['height_lg'] : get_sub_field('height_lg'));
?>
<section <?php AW_Helpers::SectionAttrs('spacer', '', !isset($args['bg_color'])); ?>
  <?php echo isset($args['bg_color']) ? 'style="background-color:'.$args['bg_color'].';"' : ''; ?>>
  <div class="d-block d-md-none" style="height: <?php echo $height_mob; ?>px;"></div>
  <div class="d-none d-md-block d-lg-none" style="height: <?php echo $height_tab; ?>px;"></div>
  <div class="d-none d-lg-block" style="height: <?php echo $height_pc; ?>px;"></div>
</section>
