<?php
$vid = isset($_GET['vid']) ? intval($_GET['vid']) : 0;
if ( !$vid ) {
  $vid = get_sub_field('video_resource');
  $scroll = false;
}
else {
  $scroll = true;
}
$videoPost = get_post( $vid );
?>
<section <?php PXA_Helpers::SectionAttrs('highlighted-video'); ?>
  data-scroll-here="<?php echo $scroll ? 'yes' : ''; ?>"
  <?php echo !$videoPost ? 'style="display:none;"' : ''; ?>>
  <?php get_template_part( 'templates/inc/highlighted-video-details', null, ['video_post' => $videoPost] ); ?>
</section>
