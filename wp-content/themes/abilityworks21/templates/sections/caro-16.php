<?php
$slides = get_sub_field('slides');
?>
<section <?php AW_Helpers::SectionAttrs('caro-16'); ?> data-slides="<?php echo sizeof($slides); ?>">
  <div class="container">
    <?php if ( $title = get_sub_field('title') ) : ?>
      <h2 class="st-title"><?php echo $title; ?></h2>
    <?php endif; ?>
    <div class="slides-wrapper">
      <div class="slides">
        <?php
          while ( have_rows('slides') ) :
            the_row();
        ?>
          <div class="slide">
            <?php if ( $image = get_sub_field('image') ) : ?>
              <div class="image" style="background-image: url(<?php echo $image['url']; ?>);"></div>
            <?php endif; ?>

            <?php if ( $txt = get_sub_field('txt') ) : ?>
              <div class="txt"><?php echo $txt; ?></div>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="slides-controls">
        <span class="lb">CLICK THROUGH</span>
        <button type="button" class="btn-play icon-pause-circle"></button>
        <div class="slides-nav"></div>
      </div>
    </div>
  </div>
</section>
