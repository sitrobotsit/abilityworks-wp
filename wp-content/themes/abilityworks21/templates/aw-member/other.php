<?php
global $post;
$primary_cat_id = function_exists('yoast_get_primary_term_id') ? yoast_get_primary_term_id( 'aw-member-cat', $post->ID ) : null;
$primary_cat = get_term( $primary_cat_id );
if ( $primary_cat ) :
  $otherQuery = new WP_Query([
    'post_type' => 'aw-member',
    'posts_per_page' => -1,
    'post__not_in' => [$post->ID],
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'tax_query' => [
      [
        'taxonomy' => 'aw-member-cat',
        'terms' => $primary_cat->term_id,
      ]
    ]
  ]);
  if ( $otherQuery->have_posts() ) :
?>
  <?php
    get_template_part( 'templates/sections/spacer', null, [
      'bg_color' => '#f4364c',
      'height_sm' => 0,
      'height_md' => 1,
      'height_lg' => 1,
    ]);

    get_template_part( 'templates/sections/spacer', null, [
      'bg_color' => '#ffffff',
      'height_sm' => 40,
      'height_md' => 50,
      'height_lg' => 60,
    ]);
  ?>
  <section class="st-caro-17" data-slides="<?php echo $otherQuery->found_posts; ?>">
    <div class="container">
      <h2 class="st-title">Other <?php echo $primary_cat->name; ?></h2>
      <div class="slides-wrapper">
        <div class="slides">
          <?php
            while ( $otherQuery->have_posts() ) :
              $otherQuery->the_post();
          ?>
            <div class="slide">
              <?php if ( has_post_thumbnail() ) : ?>
                <div class="image" style="background-image: url(<?php the_post_thumbnail_url('full'); ?>);"></div>
              <?php else: ?>
                <div class="image"></div>
              <?php endif; ?>

              <h4><?php the_title(); ?></h4>

              <?php if ( $role = get_field('member_role') ) : ?>
                <div class="role"><?php echo $role; ?></div>
              <?php else: ?>
                <?php the_excerpt(); ?>
              <?php endif; ?>

              <?php if ( get_field('member_link_to_bio') ) : ?>
                <a href="<?php the_permalink(); ?>" class="btn btn-more btn-outline-dark">READ MORE</a>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        </div>

        <div class="slides-controls">
          <button type="button" class="btn-play icon-pause-circle"></button>
          <div class="slides-nav"></div>
        </div>
      </div>
    </div>
  </section>
  <?php
    get_template_part( 'templates/sections/spacer', null, [
      'bg_color' => '#ffffff',
      'height_sm' => 40,
      'height_md' => 50,
      'height_lg' => 60,
    ]);
  ?>
<?php
  endif;
  wp_reset_query();
endif;
