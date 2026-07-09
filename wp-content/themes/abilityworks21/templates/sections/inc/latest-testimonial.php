<?php
$background_color = get_sub_field('background_color');
?>
<div class="testimonial-carousel">
  <?php
    while (have_rows('slides')) :
      the_row();
      $subtitle = get_sub_field('subtitle');
      $image = get_sub_field('image');
      $quote = get_sub_field('quote');
      $author = get_sub_field('author');
  ?>
    <div class="item">
      <div class="item-image" style="background-image: url(<?php echo $image['url']; ?>);"></div>
      <div class="details" style="background-color: <?php echo $background_color; ?>;">
        <div class="inn">
          <?php if ( $subtitle ) : ?>
            <div class="subtitle"><?php echo $subtitle; ?></div>
          <?php endif; ?>
          <blockquote><?php echo $quote; ?></blockquote>
          <?php if ( $author ) : ?>
            <div class="author"><?php echo $author; ?></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
</div>
<div class="testimonial-carousel-controls">
  <div class="testimonial-carousel-nav"></div>
</div>
