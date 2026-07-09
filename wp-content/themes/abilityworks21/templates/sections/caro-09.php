<section <?php AW_Helpers::SectionAttrs('caro-09'); ?>>
  <div class="wrap">
    <div class="slides-wrapper">
      <div class="slides">
        <?php
          while ( have_rows('slides') ) :
            the_row();
            $image = get_sub_field('image');
            $mobile_image = get_sub_field('mobile_image');
            if ( !$mobile_image ) {
              $mobile_image = $image;
            }
            $video = get_sub_field('video');
        ?>
          <div class="slide">
            <?php if ($video) : ?><a href="<?php echo $video; ?>" class="playvid"><?php endif; ?>
            <?php if ( $image ) : ?>
              <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="img-fluid d-none d-md-block">
            <?php endif; ?>
            <?php if ( $mobile_image ) : ?>
              <img src="<?php echo $mobile_image['url']; ?>" alt="<?php echo $mobile_image['alt']; ?>" class="img-fluid d-md-none">
            <?php endif; ?>
            <?php if ($video) : ?></a><?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="slides-nav d-none d-lg-block"></div>
    </div>

    <div class="intro">
      <?php if ( $title = get_sub_field('title') ) : ?>
        <h1 class="title d-none d-lg-block"><span><?php echo $title; ?></span></h1>
        <h2 class="titlebar with-bg d-lg-none">
          <span class="txt"><?php echo $title; ?></span>
          <span class="bg"></span>
        </h2>
      <?php endif; ?>
      <?php
        if ( $desc = get_sub_field('description') ) :
          $icon = get_sub_field('icon');
      ?>
        <div class="desc<?php echo $icon ? ' with-icon' : '';?>">
          <?php if ( $icon ) : ?>
            <div class="ico">
              <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
            </div>
          <?php endif; ?>
          <div class="format">
            <?php echo $desc; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
