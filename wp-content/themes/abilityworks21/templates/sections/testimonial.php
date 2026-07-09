<?php
global $sectionCounter;
?>
<section <?php PXA_Helpers::SectionAttrs('testimonial'); ?> data-index="<?php echo $sectionCounter; ?>">
  <div class="container">
    <div class="inn">
      <?php if ( $testimonial = get_sub_field('testimonial') ) : ?>
        <blockquote>
          <?php echo $testimonial; ?>
        </blockquote>
      <?php endif; ?>
      <?php if ( $author = get_sub_field('author') ) : ?>
        <div class="author"><?php echo $author; ?></div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php
$bgImage = get_sub_field('bg_image');
if ( !$bgImage ) return;

$imageUrl = $bgImage['desktop']['url'];
$mobImageUrl = $bgImage['mobile']['url'];
if ( !$mobImageUrl ) $mobImageUrl = $imageUrl;

PXA_Helpers::SectionStyles('testimonial', $sectionCounter, [
  'mobile' => [
    'background-image' => "url({$mobImageUrl})",
  ],
  'tablet' => [
  ],
  'desktop' => [
    'background-image' => "url({$imageUrl})",
  ],
  'large' => [
  ],
]);
