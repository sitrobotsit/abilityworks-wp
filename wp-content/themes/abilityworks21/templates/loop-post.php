<?php if ( has_post_thumbnail() ) : ?>
  <a href="<?php the_permalink(); ?>"
    class="post-image<?php echo get_field('post_play_icon') ? ' with-play' : ''; ?>"
    style="background-image: url(<?php the_post_thumbnail_url('full'); ?>);"></a>
<?php else : ?>
  <a href="<?php the_permalink(); ?>"
    class="post-image<?php echo get_field('post_play_icon') ? ' with-play' : ''; ?>"></a>
<?php endif; ?>

<h4 class="post-title"><?php the_title(); ?></h4>

<?php the_excerpt(); ?>

<div class="more">
  <a href="<?php the_permalink(); ?>" class="btn btn-outline-dark">READ MORE</a>
  <span class="post-date"><?php echo get_the_date('jS M Y'); ?></span>
</div>
