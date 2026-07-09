<?php
global $sectionCounter;
query_posts([
  'post_type' => 'pxa-comm-activity',
  'posts_per_page' => -1,
]);
if ( have_posts() ) :
?>
<section <?php PXA_Helpers::SectionAttrs('comm-activities'); ?> data-index="<?php echo $sectionCounter; ?>">
  <div class="container">
    <div class="inn">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'templates/loop', 'activity' ); ?>
      <?php endwhile; ?>
    </div>
  </div>
</section>
<?php
endif;
wp_reset_query();

$image = get_sub_field('bg_image');
PXA_Helpers::SectionStyles('comm-activities', $sectionCounter, [
  'mobile' => [
  ],
  'tablet' => [
    'background-image' => "url({$image['url']})",
  ],
  'desktop' => [
    'background-image' => "url({$image['url']})",
  ],
  'large' => [
  ],
]);
