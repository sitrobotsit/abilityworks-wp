<?php
$fbPosts = AW_Helpers::FacebookPosts( 10 );
// echo '<pre>';
// print_r($fbPosts);
// echo '</pre>';
// exit;
$instaPosts = AW_Helpers::InstagramPosts( 10 );
$items = [];
for ($i=0; $i<10; $i++) {
  if ( $i%2 ) {
    $instaPost = current($instaPosts);
    next($instaPosts);

    $image = $instaPost->media_url;
    if ( isset($instaPost->thumbnail_url) ) {
      $image = $instaPost->thumbnail_url;
    }

    $items[] = [
      'type' => 'instagram',
      'is_video' => $instaPost->media_type!='IMAGE',
      'url' => $instaPost->permalink,
      'image' => $image,
      'content' => isset($instaPost->caption) ? wp_trim_words( $instaPost->caption, 50 ) : '',
    ];
  }
  else {
    $fbPost = current($fbPosts);
    next($fbPosts);

    $items[] = [
      'type' => 'facebook',
      'is_video' => false,
      'url' => $fbPost->attachments->data[0]->url,
      'image' => $fbPost->full_picture,
      'content' => isset($fbPost->message) ? $fbPost->message :
        (isset($fbPost->story) ? $fbPost->story : ''),
    ];
  }
}
?>
<div class="social-carousel">
  <?php foreach ( $items as $item ) : ?>
    <div class="item">
      <a href="<?php echo $item['url']; ?>" target="_blank"
        class="item-image<?php echo $item['is_video'] ? ' with-play' : ''; ?>"
        style="background-image: url(<?php echo $item['image']; ?>);"></a>
      <div class="details">
        <div class="item-label">LATEST FROM <?php echo strtoupper($item['type']); ?></div>
        <div class="item-desc"><?php echo $item['content']; ?></div>
        <a class="more" target="_blank" href="<?php echo $item['url']; ?>">READ MORE</a>
      </div>
      <a href="<?php echo $item['url']; ?>" target="_blank"
        class="item-image<?php echo $item['is_video'] ? ' with-play' : ''; ?>"
        style="background-image: url(<?php echo $item['image']; ?>);"></a>
    </div>
  <?php endforeach; ?>
</div>
<div class="social-carousel-controls">
  <button type="button" class="btn-play-social icon-play-circle"></button>
  <div class="social-carousel-nav"></div>
</div>
