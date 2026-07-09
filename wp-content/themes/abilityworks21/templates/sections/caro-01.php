<?php
$fitHeight = !get_sub_field('auto_height_image');
?>
<section <?php AW_Helpers::SectionAttrs('caro-01', $fitHeight ? '' : 'no-fit'); ?>>
  <div class="slides-wrapper">
    <div class="slides">
      <?php
        while ( have_rows('slides') ) :
          the_row();
          $button = get_sub_field('button');
          $background_color = get_sub_field('background_color');
          $text_color = get_sub_field('color');
          $image = get_sub_field('image');
          $image_mobile = get_sub_field('mobile_image');
          if ( !$image_mobile ) {
            $image_mobile = $image;
          }
      ?>
        <?php if ( $fitHeight ) : ?>
          <div class="slide" style="background-image: url(<?php echo $image['url']; ?>);">
            <div class="slide-inn" style="background-image: url(<?php echo $image_mobile['url']; ?>);">
              <div class="bg" style="background-color: <?php echo $background_color; ?>;"></div>

              <div class="banner">
                <div class="inn">
                  <?php if ( $title = get_sub_field('title') ) : ?>
                    <h2 style="color: <?php echo $text_color; ?>;"><?php echo $title; ?></h2>
                  <?php endif; ?>
                  <?php if ( $subtitle = get_sub_field('subtitle') ) : ?>
                    <p style="color: <?php echo $text_color; ?>;"><?php echo $subtitle; ?></p>
                  <?php endif; ?>
                  <?php if (!empty($button['title'])) : ?>
                    <a href="<?php echo $button['url']; ?>"
                      target="<?php echo $button['target']!='0' ? $button['target'] : '_self'; ?>"
                      style="color: <?php echo $text_color; ?>;border-color: <?php echo $text_color; ?>;"
                      class="btn btn-outline-dark"><?php echo $button['title']; ?></a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php else : ?>
          <div class="slide">
            <div class="slide-inn">
              <div class="bg" style="background-color: <?php echo $background_color; ?>;"></div>

              <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="d-none d-md-block">
              <img src="<?php echo $image_mobile['url']; ?>" alt="<?php echo $image_mobile['alt']; ?>" class="d-md-none">

              <div class="banner">
                <div class="inn">
                  <?php if ( $title = get_sub_field('title') ) : ?>
                    <h2 style="color: <?php echo $text_color; ?>;"><?php echo $title; ?></h2>
                  <?php endif; ?>
                  <?php if ( $subtitle = get_sub_field('subtitle') ) : ?>
                    <p style="color: <?php echo $text_color; ?>;"><?php echo $subtitle; ?></p>
                  <?php endif; ?>
                  <?php if (!empty($button['title'])) : ?>
                    <a href="<?php echo $button['url']; ?>"
                      target="<?php echo $button['target']!='0' ? $button['target'] : '_self'; ?>"
                      style="color: <?php echo $text_color; ?>;border-color: <?php echo $text_color; ?>;"
                      class="btn btn-outline-dark"><?php echo $button['title']; ?></a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
    </div>

    <div class="slides-controls">
      <button type="button" class="btn-play icon-pause-circle"></button>
      <div class="slides-nav"></div>
    </div>
  </div>
</section>
