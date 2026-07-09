<?php
$button_1 = get_sub_field('button_1');
$button_2 = get_sub_field('button_2');
$light_mode = get_sub_field('light_mode');
?>
<section <?php PXA_Helpers::SectionAttrs('cta', $light_mode ? 'light' : 'dark'); ?>>
  <div class="container">
    <div class="inn">
      <?php if ( $title = get_sub_field('title') ) : ?>
        <h2 class="title"><?php echo $title; ?></h2>
      <?php endif; ?>
      <div class="col-first">
        <div class="desc format light-mode">
          <?php the_sub_field('description_1'); ?>
        </div>

        <?php if ( isset($button_1['label']) && !empty($button_1['label']) ) : ?>
          <a class="btn"<?php echo $button_1['open_in_new_tab'] ? ' target="_blank"' : ''; ?>
            href="<?php echo $button_1['url']; ?>"><?php echo $button_1['label']; ?></a>
        <?php endif; ?>
      </div>
      <div class="col-second">
        <div class="desc format light-mode">
          <?php the_sub_field('description_2'); ?>
        </div>

        <?php if ( isset($button_2['label']) && !empty($button_2['label']) ) : ?>
          <a class="btn"<?php echo $button_2['open_in_new_tab'] ? ' target="_blank"' : ''; ?>
            href="<?php echo $button_2['url']; ?>"><?php echo $button_2['label']; ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
