<?php
$title = get_sub_field('title');
$slides = get_sub_field('slides');
$totalSlides = sizeof($slides);
?>
<section <?php AW_Helpers::SectionAttrs('caro-07'); ?>>
  <div class="wrap">
    <?php if ( $title ) : ?>
      <h2 class="titlebar with-bg" style="color: transparent;">
        <span class="txt"><?php echo $title; ?></span>
        <span class="bg"></span>
      </h2>
    <?php endif; ?>
    <div class="slides-wrapper">
      <div class="slides">
        <?php
          while ( have_rows('slides') ) :
            the_row();
            $text = get_sub_field('text');
            $font_size_scale = (float) get_sub_field('font_size_scale');
            $image = get_sub_field('image');
            $bg_color = get_sub_field('bg_color');
        ?>
          <div class="slide" data-color="<?php echo $bg_color; ?>">
            <div class="txt" style="background-color: <?php echo $bg_color; ?>;">
              <?php if ( $title ) : ?>
                <h3 class="title"><span><?php echo $title; ?></span></h3>
              <?php endif; ?>

              <div class="msg" style="font-size: <?php echo $font_size_scale; ?>em;">
                <?php echo $text; ?>
              </div>

              <?php if ( $totalSlides > 1 ) : ?>
                <div class="slides-nav">
                  <button type="button" class="btn-prev icon-caret-left-circle"></button>
                  <button type="button" class="btn-next icon-caret-right-circle"></button>
                </div>
              <?php endif; ?>
            </div>
            <div class="img"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="img-fluid"></div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>

    <div class="btm-slides-nav"></div>
  </div>
</section>
