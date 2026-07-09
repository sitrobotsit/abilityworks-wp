<?php
$playIconColor = get_sub_field('play_icon_color');
?>
<section <?php PXA_Helpers::SectionAttrs('image-content-carousel'); ?>>
  <div class="container">
    <div class="inn">
      <?php if ( have_rows('items') ) : ?>
        <div class="items-carousel">
          <?php
            while ( have_rows('items') ) :
              the_row();
              $image = get_sub_field('image');
              $video = get_sub_field('video');
              $videoSrc = PXA_Helpers::GetVideoSrc( $video );
          ?>
            <div class="item">
              <div class="thumb">
                <?php if ( !empty($videoSrc) ) : ?>
                  <a href="javascript:;" class="bgimg has-play-icon img-ct-video-play" rel="<?php echo $videoSrc; ?>"
                    style="background-color:<?php echo $playIconColor; ?>;<?php echo !empty($image) ? 'background-image:url('.$image.')' : ''; ?>"></a>
                <?php else: ?>
                  <div class="bgimg" style="<?php echo !empty($image) ? 'background-image:url('.$image.')' : ''; ?>"></div>
                <?php endif; ?>
              </div>
              <div class="desc format">
                <?php the_sub_field('description'); ?>
              </div>
            </div>
          <?php
              $counter++;
            endwhile;
          ?>
        </div>
        <div class="items-carousel-btm">
          <div class="items-carousel-dots"></div>
          <div class="items-carousel-navs"></div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
