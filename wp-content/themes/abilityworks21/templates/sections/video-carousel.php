<?php
global $sectionCounter;
$title = get_sub_field('title');
$playIconColor = get_sub_field('play_icon_color');
$initInfoText = '';
$counter = 0;
?>
<section <?php PXA_Helpers::SectionAttrs('video-carousel'); ?> data-index="<?php echo $sectionCounter; ?>">
  <div class="inn">
    <div class="left-col">
      <?php if ( !empty($title) ) : ?>
        <h3 class="title"><?php echo $title; ?></h3>
      <?php endif; ?>

      <?php if ( have_rows('videos') ) : ?>
        <div class="desc-carousel">
          <?php
            while ( have_rows('videos') ) :
              the_row();
              $infoText = get_sub_field('info_text');
              if ( $counter == 0 ) {
                $initInfoText = $infoText;
              }
          ?>
            <div class="desc format">
              <div class="info-text"><?php echo $infoText; ?></div>
              <?php the_sub_field('description'); ?>
            </div>
          <?php
              $counter++;
            endwhile;
          ?>
        </div>

        <div class="desc-carousel-navs">
          <div class="desc-arrows-container"></div>
          <div class="desc-arrows-info"><?php echo $initInfoText; ?></div>
        </div>
      <?php endif; ?>
    </div>

    <div class="right-col">
      <?php if ( $counter > 0 ) : ?>
        <div class="videos-carousel">
          <?php
            $counter2 = 0;
            while ( have_rows('videos') ) :
              the_row();
              $image = get_sub_field('image');
              $video = get_sub_field('video');
              $videoSrc = PXA_Helpers::GetVideoSrc( $video );
          ?>
            <div class="item item-<?php echo $counter2; ?>" data-vidsrc="<?php echo $videoSrc; ?>">
              <a href="javascript:;" class="has-play-icon video-carousel-play" style="background-color: <?php echo $playIconColor;?>;">
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="img-fluid">
              </a>
            </div>
          <?php
              $counter2++;
            endwhile;
          ?>
        </div>

        <?php if ( $counter > 1 ) : ?>
          <div class="video-carousel-navs">
            <div class="video-arrows-info"><?php echo $initInfoText; ?></div>
            <div class="video-arrows-container"></div>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</section>
