<?php
$bg_color_desc = get_sub_field('bg_color_desc');
?>
<section <?php AW_Helpers::SectionAttrs('caro-13'); ?>>
  <div class="wrap">
    <div class="intro">
      <div class="title">
        <div class="bar"></div>
        <?php if ( $title = get_sub_field('title') ) : ?>
          <h2 class="titlebar with-bg" style="color: <?php echo $bg_color_desc;?>;">
            <span class="txt"><?php echo $title; ?></span>
            <span class="bg"></span>
          </h2>
        <?php endif; ?>
      </div>

      <div class="desc" style="background-color: <?php echo $bg_color_desc; ?>">
        <div class="inn">
          <div class="format">
            <?php the_sub_field('content'); ?>
          </div>
        </div>
      </div>
    </div>

    <div class="slides-wrapper">
      <div class="slides">
        <?php
          while ( have_rows('slides') ) :
            the_row();
            $icon = get_sub_field('icon');
            $description = get_sub_field('description');
            $bg_color = get_sub_field('bg_color');
        ?>
          <div class="slide">
            <div class="item" style="background-color: <?php echo $bg_color; ?>;">
              <?php if ( $icon ) : ?>
                <div class="icon">
                  <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                </div>
              <?php endif; ?>
              <?php if ( !empty($description) ) : ?>
                <div class="desc format">
                  <?php echo $description; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="slides-controls">
      <span class="lb">CLICK THROUGH</span>
      <button type="button" class="btn-play icon-pause-circle"></button>
      <div class="slides-nav"></div>
    </div>
  </div>
</section>
