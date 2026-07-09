<section <?php PXA_Helpers::SectionAttrs('content-carousel'); ?>>
  <div class="inn">
    <div class="ct">
      <div class="format">
        <?php the_sub_field('content'); ?>
      </div>
    </div>
    <div class="crs">
      <?php
        $images = get_sub_field('images');
        if ( is_array($images) && sizeof($images) ) :
      ?>
        <div class="images-carousel">
          <?php foreach ($images as $image) : ?>
            <a href="<?php echo $image['url']; ?>" class="mfp-img">
              <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
            </a>
          <?php endforeach; ?>
        </div>
        <div class="carousel-arrows"></div>
      <?php endif; ?>
    </div>
  </div>
</section>
