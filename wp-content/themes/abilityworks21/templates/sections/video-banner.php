<?php
$button = get_sub_field('button');
$text_color = get_sub_field('text_color');
$mob_use_image = get_sub_field('mob_use_image');
?>
<section <?php AW_Helpers::SectionAttrs('video-banner', $mob_use_image ? 'mob-bg-img' : ''); ?>>
  <video autoplay muted loop id="video-banner">
    <source src="<?php the_sub_field('mp4_url'); ?>" type="video/mp4">
  </video>

  <div class="bg" style="background-color: <?php the_sub_field('background_color'); ?>;"></div>

  <div class="banner">
    <div class="inn">
      <?php if ( $title = get_sub_field('title') ) : ?>
        <h1 style="color: <?php echo $text_color; ?>;"><?php echo $title; ?></h1>
      <?php endif; ?>
      <?php if ( $subtitle = get_sub_field('subtitle') ) : ?>
        <p style="color: <?php echo $text_color; ?>;"><?php echo $subtitle; ?></p>
      <?php endif; ?>
      <?php if (!empty($button['title'])) : ?>
        <a href="<?php echo $button['url']; ?>"
          target="<?php echo $button['target']!='0' ? $button['target'] : '_self'; ?>"
          style="color: <?php echo $text_color; ?>;border-color: <?php echo $text_color; ?>;"
          class="btn btn-outline-dark"><?php echo $button['title']; ?></a>
      <?php endif; ?>
    </div>
  </div>

  <button type="button" style="color: <?php echo $text_color; ?>;display: none;"
    id="btn-video-banner" class="btn-play"></button>
</section>
<?php
global $sectionCounter;

$image = get_sub_field('ph_image');
$mobImage = get_sub_field('ph_image_mob');
if ( !$mobImage ) $mobImage = $image;

AW_Helpers::SectionStyles('video-banner', $sectionCounter, [
  'mobile' => [
    'background-image' => "url({$mobImage})",
  ],
  'tablet' => [
    'background-image' => "url({$image})",
  ],
]);
