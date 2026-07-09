<?php
global $sectionCounter;
?>
<section <?php PXA_Helpers::SectionAttrs('welcome'); ?> data-index="<?php echo $sectionCounter; ?>">
  <div class="container">
    <div class="banner-text" style="color:<?php the_sub_field('color'); ?>;">
      <?php if ( $headline = get_sub_field('headline') ) : ?>
        <h1 class="headline"><?php echo $headline; ?></h1>
      <?php endif; ?>
      <?php if ( $intro = get_sub_field('intro') ) : ?>
        <h4 class="intro"><?php echo $intro; ?></h4>
      <?php endif; ?>
    </div>
    <?php if ( have_rows('panels') ) : ?>
      <div class="panels">
        <?php
          while ( have_rows('panels') ) :
            the_row();
            $icon = get_sub_field('icon');
        ?>
          <div class="panel">
            <a href="<?php the_sub_field('url'); ?>"><?php the_sub_field('title'); ?></a>
            <div class="icon"><img src="<?php echo $icon['url'];?>" alt="<?php the_sub_field('title'); ?>"></div>
            <h2><?php the_sub_field('title'); ?></h2>
            <h5><?php the_sub_field('subtitle'); ?></h5>
            <span class="btn"><?php the_sub_field('button_label'); ?></span>
          </div>
        <?php endwhile ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<?php
$background = get_sub_field('background');
$bgColor = isset($background['color']) ? $background['color'] : 'transparent';
$image = isset($background['image']) ? $background['image']['url'] : '';
$imageMob = isset($background['image_mobile']) ? $background['image_mobile']['url'] : '';
if ( !$imageMob ) $imageMob = $image;

PXA_Helpers::SectionStyles('welcome', $sectionCounter, [
  'mobile' => [
    'background-image' => "url({$imageMob})",
  ],
  'tablet' => [
    'background-image' => "url({$image})",
  ],
  'desktop' => [
  ],
  'large' => [
  ],
]);
