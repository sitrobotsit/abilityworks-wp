<?php
$video = get_sub_field('video');
$image = get_sub_field('ph_image');
$videoSrc = AW_Helpers::GetVideoSrc( $video );
?>
<div class="video-block" data-vidsrc="<?php echo $videoSrc; ?>">
  <a href="javascript:;" style="background-image: url(<?php echo $image['url']; ?>);"></a>
</div>
