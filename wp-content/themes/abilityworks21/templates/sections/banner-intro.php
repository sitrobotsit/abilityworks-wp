<?php
global $sectionCounter;
$icon = get_sub_field('icon');
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$recap_home_button_enabled = get_sub_field('recap_home_button_enabled');
$secondary_icon = get_sub_field('secondary_icon');
?>
<section <?php PXA_Helpers::SectionAttrs('banner-intro'); ?>
  data-index="<?php echo $sectionCounter; ?>">
  <div class="container">
    <div class="intro-box">
      <?php if ( $recap_home_button_enabled || $secondary_icon ) : ?>
        <div class="intro-box-graph">
          <?php PXA_Helpers::ReCapHomeButton(); ?>
          <?php if ( $secondary_icon ) : ?>
            <div class="sc-icon">
              <img src="<?php echo $secondary_icon['url']; ?>" alt="<?php echo $secondary_icon['alt']; ?>" class="img-fluid">
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <div class="intro-box-main">
        <div class="title">
          <?php if ( !empty($icon) ) : ?>
            <div class="icon"><img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>"></div>
          <?php endif; ?>
          <?php if ( !empty($title) ) : ?>
            <div class="text">
              <h1><?php echo $title; ?></h1>
              <?php if ( !empty($subtitle) ) : ?>
                <div class="subtitle"><?php echo $subtitle; ?></div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <?php if ( $secondary_icon ) : ?>
            <div class="sc-icon">
              <img src="<?php echo $secondary_icon['url']; ?>" alt="<?php echo $secondary_icon['alt']; ?>" class="img-fluid">
            </div>
          <?php endif; ?>
        </div>
        <div class="content format">
          <?php the_sub_field('content'); ?>
        </div>
        <?php
          $btnLayout = get_sub_field('layout');
          if ( have_rows('links') ) :
        ?>
          <ul class="links layout-<?php echo $btnLayout; ?>">
            <?php
              while ( have_rows('links') ) :
                the_row();
                $style = get_sub_field('style');
            ?>
              <li><a<?php echo get_sub_field('open_in_new_tab') ? ' target="_blank"' : ''; ?>
                href="<?php the_sub_field('url'); ?>" class="arrow-link btn-<?php echo $style; ?>">
                <?php the_sub_field('label'); ?></a></li>
            <?php endwhile; ?>
          </ul>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php
$top_margin = get_sub_field('top_margin');
$btm_margin = get_sub_field('btm_margin');
$image_width = get_sub_field('image_width');
$image = get_sub_field('image');
$mobImage = get_sub_field('mob_image');
if ( !$mobImage ) $mobImage = $image;

PXA_Helpers::SectionStyles('banner-intro', $sectionCounter, [
  'mobile' => [
    'padding-top' => $top_margin['mobile'] . 'px',
    'padding-bottom' => $btm_margin['mobile'] . 'px',
    'background-image' => "url({$mobImage['url']})",
  ],
  'tablet' => [
    'padding-top' => $top_margin['tablet'] . 'px',
    'padding-bottom' => $btm_margin['tablet'] . 'px',
    'background-image' => "url({$image['url']})",
    'background-size' => "{$image_width}% auto",
  ],
  'desktop' => [
    'padding-top' => $top_margin['desktop'] . 'px',
    'padding-bottom' => $btm_margin['desktop'] . 'px',
  ],
  'large' => [
    'padding-top' => $top_margin['large'] . 'px',
    'padding-bottom' => $btm_margin['large'] . 'px',
  ],
]);
