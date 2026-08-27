<?php
/**
 * Related articles on single posts (formerly CARO 21).
 * Prefer manually chosen ACF related posts; otherwise two latest posts sharing a tag.
 */
$related_ids = [];

$related_articles = get_field( 'post_related_articles' );
if ( ! empty( $related_articles ) && is_array( $related_articles ) ) {
  $related_ids = array_values( array_filter( array_map( 'intval', $related_articles ) ) );
}

if ( empty( $related_ids ) ) {
  $tag_ids = wp_get_post_tags( get_the_ID(), [ 'fields' => 'ids' ] );
  if ( ! empty( $tag_ids ) ) {
    $fallback_query = new WP_Query([
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 2,
      'post__not_in' => [ get_the_ID() ],
      'tag__in' => $tag_ids,
      'ignore_sticky_posts' => true,
      'fields' => 'ids',
    ]);
    $related_ids = $fallback_query->posts;
    wp_reset_postdata();
  }
}

if ( empty( $related_ids ) ) {
  $fallback_query = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 2,
    'post__not_in' => [ get_the_ID() ],
    'ignore_sticky_posts' => true,
    'fields' => 'ids',
  ]);
  $related_ids = $fallback_query->posts;
  wp_reset_postdata();
}

if ( empty( $related_ids ) ) {
  return;
}

$query = new WP_Query([
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => 2,
  'post__in' => $related_ids,
  'orderby' => 'post__in',
  'ignore_sticky_posts' => true,
]);

if ( ! $query->have_posts() ) {
  return;
}

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

$page_for_posts = get_option( 'page_for_posts' );
$page_for_posts_url = $page_for_posts ? get_permalink( $page_for_posts ) : home_url( '/' );
?>
<section class="st-caro-21 st-related-articles" data-slides="2">
  <div class="container">
    <div class="headline">
      <h2 class="st-title">Other recent articles</h2>
      <a href="<?php echo esc_url( $page_for_posts_url ); ?>">See all articles</a>
    </div>

    <div class="slides-wrapper">
      <div class="slides">
        <?php
          while ( $query->have_posts() ) :
            $query->the_post();
        ?>
          <div class="loop-post slide">
            <?php get_template_part( 'templates/loop', 'post' ); ?>
          </div>
        <?php endwhile; ?>
      </div>
    </div>

    <div class="footline">
      <a href="<?php echo esc_url( $page_for_posts_url ); ?>">See all articles</a>
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
wp_reset_postdata();
