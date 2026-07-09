<div class="comm-activity">
  <a href="<?php the_permalink();?>" class="thumb">
    <?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail('pxa-335x230', ['class' => 'img-fluid']); ?>
    <?php endif; ?>
  </a>
  <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
  <?php the_excerpt(); ?>
  <a href="<?php the_permalink();?>" class="arrow-link">Read more</a>
</div>
