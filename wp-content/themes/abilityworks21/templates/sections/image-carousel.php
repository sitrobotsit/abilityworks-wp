<?php
global $sectionCounter;
$layout = get_sub_field('layout');
$image = get_sub_field('image');
$mob_image = get_sub_field('mob_image');
if ( empty($mob_image) ) $mob_image = $image;
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$subtitle_2 = get_sub_field('subtitle_2');
$button = get_sub_field('button');
$bg_color_text = get_sub_field('bg_color_text');
if ( empty($bg_color_text) ) {
  $bg_color_text = '#ffffff';
}
$hasButton = (isset($button['label']) && !empty($button['label']));
$initInfoText = '';
$counter = 0;
?>
<section <?php PXA_Helpers::SectionAttrs('image-carousel'); ?> data-index="<?php echo $sectionCounter; ?>">
  <div class="container">
    <div class="card-img-crs<?php echo ($layout=='crs-img') ? ' reverse' : '';?>">
      <div class="img" style="<?php echo !empty($image) ? 'background-image: url(' . $image . ');' : ''; ?>"></div>
      <div class="img-mob" style="<?php echo !empty($mob_image) ? 'background-image: url(' . $mob_image . ');' : ''; ?>"></div>

      <div class="ct-wrapper" style="background-color: <?php echo $bg_color_text; ?>;">
        <?php if ( !empty($subtitle) || !empty($subtitle_2) ) : ?>
          <div class="subtitle">
            <?php if ( !empty($subtitle) ) : ?>
              <span class="st1"><?php echo $subtitle; ?></span>
            <?php endif; ?>
            <?php if ( !empty($subtitle_2) ) : ?>
              <span class="st2"><?php echo $subtitle_2; ?></span>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?php if ( !empty($title) ) : ?>
          <h3 class="title"><?php echo $title; ?></h3>
        <?php endif; ?>

        <?php if ( have_rows('items') ) : ?>
          <div class="items-carousel">
            <?php
              while ( have_rows('items') ) :
                the_row();
                $infoText = get_sub_field('info_text');
                if ( $counter == 0 ) {
                  $initInfoText = $infoText;
                }
            ?>
              <div class="desc">
                <div class="info-text"><?php echo $infoText; ?></div>
                <?php the_sub_field('description'); ?>
              </div>
            <?php
                $counter++;
              endwhile;
            ?>
          </div>
        <?php endif; ?>

        <?php if ( $hasButton || $counter > 1 ) : ?>
          <div class="foot">
            <?php if ( $hasButton ) : ?>
              <a class="btn"<?php echo $button['open_in_new_tab'] ? ' target="_blank"' : ''; ?>
                href="<?php echo $button['url']; ?>"><?php echo $button['label']; ?></a>
            <?php endif; ?>

            <?php if ( $counter > 1 ) : ?>
              <div class="carousel-navs">
                <div class="arrows-container"></div>
                <div class="arrows-info"><?php echo $initInfoText; ?></div>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
