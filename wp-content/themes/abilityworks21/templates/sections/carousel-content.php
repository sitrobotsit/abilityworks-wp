<?php if ( have_rows('carousel_items') ) : ?>
  <section <?php PXA_Helpers::SectionAttrs('carousel-content'); ?>>
    <div class="container">
      <div class="items-carousel-top">
        <div class="items-carousel-dots"></div>
        <div class="items-carousel-navs"></div>
      </div>
      <div class="items-carousel">
        <?php
          while ( have_rows('carousel_items') ) :
            the_row();
            $image = get_sub_field('image');
        ?>
          <div>
            <div class="item">
              <?php if ( $image ) : ?>
                <?php if ( get_sub_field('auto_image_height') ) : ?>
                  <div class="hero-img">
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="img-fluid">
                  </div>
                <?php else : ?>
                  <div class="hero" style="background-image: url(<?php echo $image['url']; ?>);"></div>
                <?php endif; ?>
              <?php endif; ?>
              <?php if ( $title = get_sub_field('title') ) : ?>
                <h3 class="title"><?php echo $title; ?></h3>
              <?php endif; ?>
              <?php if ( $description = get_sub_field('description') ) : ?>
                <div class="desc format">
                  <?php echo $description; ?>
                </div>
              <?php endif; ?>
              <?php if ( $consider = get_sub_field('consider') ) : ?>
                <div class="consider format">
                  <h4 class="title">CONSIDER</h4>
                  <?php echo $consider; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
      <!-- <div class="items-carousel-btm">
        <div class="items-carousel-dots"></div>
        <div class="items-carousel-navs"></div>
      </div> -->
    </div>
  </section>
<?php
endif;
