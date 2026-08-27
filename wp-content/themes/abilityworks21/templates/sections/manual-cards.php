<?php
/**
 * Manual cards (replaces caro-20 carousel).
 * Content managers choose each card in ACF; rendered as a static grid.
 */
$slides = get_sub_field('slides');
if ( empty( $slides ) ) {
  return;
}
?>
<section <?php AW_Helpers::SectionAttrs('manual-cards'); ?> data-cards="<?php echo sizeof($slides); ?>">
  <div class="container">
    <div class="cards-grid">
      <?php
        while ( have_rows('slides') ) :
          the_row();
      ?>
        <article class="card">
          <?php if ( $image = get_sub_field('image') ) : ?>
            <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
          <?php endif; ?>

          <?php if ( $title = get_sub_field('title') ) : ?>
            <h4 class="title"><?php echo $title; ?></h4>
          <?php endif; ?>

          <?php if ( $subtitle = get_sub_field('subtitle') ) : ?>
            <div class="subtitle"><?php echo $subtitle; ?></div>
          <?php endif; ?>

          <?php if ( $desc = get_sub_field('description') ) : ?>
            <div class="desc">
              <div class="format">
                <?php echo $desc; ?>
              </div>
            </div>
          <?php endif; ?>
        </article>
      <?php endwhile; ?>
    </div>
  </div>
</section>
