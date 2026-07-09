<?php
$related_articles = get_field('post_related_articles');
$args = [
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'post__in' => $related_articles,
  'orderby' => 'post__in',
];
$relatedQuery = new WP_Query($args);
if ( $relatedQuery->have_posts() ) :
?>
  <?php
    get_template_part( 'templates/sections/spacer', null, [
      'bg_color' => '#f4364c',
      'height_sm' => 1,
      'height_md' => 1,
      'height_lg' => 1,
    ]);

    get_template_part( 'templates/sections/spacer', null, [
      'bg_color' => '#ffffff',
      'height_sm' => 40,
      'height_md' => 50,
      'height_lg' => 60,
    ]);
    $page_for_posts = get_option('page_for_posts');
    $page_for_posts_url = get_permalink($page_for_posts);
  ?>
    <section class="st-caro-21">
      <div class="container">
        <div class="headline">
          <h2 class="st-title">Other recent articles</h2>
          <a href="<?php echo $page_for_posts_url; ?>">See all articles</a>
        </div>

        <div class="slides-wrapper">
          <div class="slides">
            <?php
              while ( $relatedQuery->have_posts() ) :
                $relatedQuery->the_post();
            ?>
              <div class="loop-post slide">
                <?php get_template_part('templates/loop', 'post'); ?>
              </div>
            <?php endwhile; ?>
          </div>
          <div class="slides-controls">
            <button type="button" class="btn-play icon-pause-circle"></button>
            <div class="slides-nav"></div>
          </div>
        </div>

        <div class="footline">
          <a href="<?php echo $page_for_posts_url; ?>">See all articles</a>
        </div>
      </div>
    </section>
  <?php
    get_template_part( 'templates/sections/spacer', null, [
      'bg_color' => '#ffffff',
      'height_sm' => 40,
      'height_md' => 45,
      'height_lg' => 50,
    ]);
  ?>
<?php
endif;
wp_reset_query();
