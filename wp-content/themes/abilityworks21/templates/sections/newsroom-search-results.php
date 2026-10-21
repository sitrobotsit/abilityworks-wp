<?php
$page_for_posts = get_option('page_for_posts');
$page_for_posts_url = get_permalink($page_for_posts);

$kw = isset($_GET['kw']) ? trim($_GET['kw']) : '';
$tag_ids = [];
if ( ! empty($_GET['tagids']) ) {
  $raw = is_array($_GET['tagids']) ? $_GET['tagids'] : explode(',', (string) $_GET['tagids']);
  $tag_ids = array_values(array_filter(array_map('intval', $raw)));
} elseif ( ! empty($_GET['tagid']) ) {
  $tag_ids = [ (int) $_GET['tagid'] ];
}

if ( $kw === '' && empty($tag_ids) ) {
  return;
}

$args = [
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => $kw !== '' ? (int) get_sub_field('posts_per_page') : -1,
];

if ( $kw !== '' ) {
  $args['s'] = $kw;
  $args['relevanssi'] = true;
}

if ( ! empty($tag_ids) ) {
  $args['tag__in'] = $tag_ids;
}

$newsroomSearchQuery = new WP_Query( $args );

$tag_names = [];
if ( ! empty($tag_ids) ) {
  foreach ( $tag_ids as $tag_id ) {
    $term = get_tag( $tag_id );
    if ( $term && ! is_wp_error($term) ) {
      $tag_names[] = $term->name;
    }
  }
}
?>
  <section <?php AW_Helpers::SectionAttrs('newsroom-search-results'); ?>>
    <div class="container">
      <div class="headline">
        <h2 class="st-title">
          <?php if ( $kw !== '' ) : ?>
            <?php echo count($newsroomSearchQuery->posts); ?>
            results for &ldquo;<?php echo esc_html($kw); ?>&rdquo;
          <?php elseif ( ! empty($tag_names) ) : ?>
            <?php echo count($newsroomSearchQuery->posts); ?>
            related articles tagged &ldquo;<?php echo esc_html(implode(', ', $tag_names)); ?>&rdquo;
          <?php else : ?>
            <?php echo count($newsroomSearchQuery->posts); ?> related articles
          <?php endif; ?>
        </h2>
        <a href="<?php echo esc_url($page_for_posts_url); ?>" class="btn btn-outline-dark">CLEAR SEARCH</a>
      </div>

      <?php if ( $newsroomSearchQuery->have_posts() ) : ?>
        <div class="slides-wrapper">
          <div class="slides">
            <?php
              while ( $newsroomSearchQuery->have_posts() ) :
                $newsroomSearchQuery->the_post();
            ?>
              <div class="slide">
                <div class="loop-post">
                  <?php get_template_part('templates/loop', 'post'); ?>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
          <div class="slides-controls">
            <button type="button" class="btn-play icon-pause-circle"></button>
            <div class="slides-nav"></div>
          </div>
        </div>
      <?php else : ?>
        <h4 class="no-msg">Please clear your search and try again.</h4>
      <?php endif; ?>

      <div class="footline">
        <a href="<?php echo esc_url($page_for_posts_url); ?>" class="btn btn-outline-dark">CLEAR SEARCH</a>
      </div>
    </div>
  </section>
<?php
wp_reset_postdata();
