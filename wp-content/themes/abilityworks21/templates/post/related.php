<?php
/**
 * Related articles on single posts (formerly CARO 21).
 * Prefer manually chosen ACF related posts; otherwise two latest posts sharing a tag.
 * Never falls back to unrelated recent posts.
 */
$current_post_id = get_the_ID();
$post_tag_ids = wp_get_post_tags( $current_post_id, [ 'fields' => 'ids' ] );
$related_ids = [];

$related_articles = get_field( 'post_related_articles' );
if ( ! empty( $related_articles ) && is_array( $related_articles ) ) {
  $related_ids = array_values( array_filter( array_map( 'intval', $related_articles ) ) );
}

if ( empty( $related_ids ) && ! empty( $post_tag_ids ) ) {
  $fallback_query = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 2,
    'post__not_in' => [ $current_post_id ],
    'tag__in' => $post_tag_ids,
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
$related_all_url = $page_for_posts_url;
if ( ! empty( $post_tag_ids ) ) {
  $search_results_url = get_field( 'ca_newsroom_search_results_url', 'option' );
  if ( empty( $search_results_url ) ) {
    $search_results_url = $page_for_posts_url;
  }
  $related_all_url = add_query_arg(
    [ 'tagids' => implode( ',', array_map( 'intval', $post_tag_ids ) ) ],
    $search_results_url
  );
}
?>
<section class="st-caro-21 st-related-articles" data-slides="2">
  <div class="container">
    <div class="headline">
      <h2 class="st-title">Related articles</h2>
      <a href="<?php echo esc_url( $related_all_url ); ?>">See all related articles</a>
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
      <a href="<?php echo esc_url( $related_all_url ); ?>">See all related articles</a>
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
