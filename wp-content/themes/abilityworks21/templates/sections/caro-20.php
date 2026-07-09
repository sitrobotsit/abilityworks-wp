<?php
$slides = get_sub_field('slides');
?>
<section <?php AW_Helpers::SectionAttrs('caro-20'); ?> data-slides="<?php echo sizeof($slides); ?>">
  <div class="container">
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

            <?php if ( $title = get_sub_field('title') ) : ?>
              <h4 class="title"><?php echo $title; ?></h4>
            <?php endif; ?>

            <?php if ( $subtitle = get_sub_field('subtitle') ) : ?>
              <div class="subtitle"><?php echo $subtitle; ?></div>
            <?php endif; ?>

            <?php if ( $desc = get_sub_field('description') ) : ?>
              <div class="desc">
                <div class="format">
                  <?php echo $desc; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="slides-controls">
        <button type="button" class="btn-play icon-pause-circle"></button>
        <div class="slides-nav"></div>
      </div>
    </div>
  </div>
</section>
