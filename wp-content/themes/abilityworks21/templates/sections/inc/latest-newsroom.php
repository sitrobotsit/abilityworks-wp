<?php
$foo = new WP_Query([
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => 10,
]);
?>
<div class="newsroom-carousel">
  <?php while ( $foo->have_posts() ) : $foo->the_post(); ?>
    <div class="item">
      <a href="<?php the_permalink(); ?>"
        class="post-image<?php echo get_field('post_play_icon') ? ' with-play' : ''; ?>"
        style="background-image: url(<?php the_post_thumbnail_url('full'); ?>);"></a>
      <div class="details">
        <div class="post-tag"><?php echo strip_tags(get_the_tag_list('', ', ', '')); ?></div>
        <h4><?php the_title(); ?></h4>
        <?php the_excerpt(); ?>
        <a class="more" href="<?php the_permalink(); ?>">READ MORE</a>
      </div>
      <a href="<?php the_permalink(); ?>"
        class="post-image<?php echo get_field('post_play_icon') ? ' with-play' : ''; ?>"
        style="background-image: url(<?php the_post_thumbnail_url('full'); ?>);"></a>
    </div>
  <?php endwhile; ?>
</div>
<div class="newsroom-carousel-controls">
  <button type="button" class="btn-play-newsroom icon-play-circle"></button>
  <div class="newsroom-carousel-nav"></div>
</div>
<?php
wp_reset_query();
