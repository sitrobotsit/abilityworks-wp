<?php
$image = $args['image'];
$video = $args['video'];
// $autoplay = !isset($args['autoplay']) || $args['autoplay']!='off';
$autoplay = true;
$videoSrc = AW_Helpers::GetVideoSrc( $video, $autoplay );

if ( strpos($videoSrc, 'tiktok.com') !== false ) :
  echo $video;
else :
?>
<a href="javascript:;" class="video-item"
  rel="<?php echo $videoSrc; ?>"
  style="background-image:url(<?php echo $image ? $image['url'] : ''; ?>);"></a>
<?php
endif;
