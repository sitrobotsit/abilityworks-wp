<?php
$page_for_posts = get_option('page_for_posts');
$page_for_posts_url = get_permalink($page_for_posts);

$kw = isset($_GET['kw']) ? trim($_GET['kw']) : '';
if ( empty($kw) ) return;
$args = [
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => (int) get_sub_field('posts_per_page'),
  's' => $kw,
  'relevanssi' => true,
];
$tagid = isset($_GET['tagid']) ? intval($_GET['tagid']) : '';
if ( $tagid ) {
  $args['tag_id'] = $tagid;
}
$newsroomSearchQuery = new WP_Query( $args );
?>
  <section <?php AW_Helpers::SectionAttrs('newsroom-search-results'); ?>>
    <div class="container">
      <div class="headline">
        <h2 class="st-title">
          <?php echo sizeof($newsroomSearchQuery->posts);/*$newsroomSearchQuery->found_posts;*/ ?>
          results for &ldquo;<?php echo $kw; ?>&rdquo;</h2>
        <a href="<?php echo $page_for_posts_url; ?>" class="btn btn-outline-dark">CLEAR SEARCH</a>
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
        <a href="<?php echo $page_for_posts_url; ?>" class="btn btn-outline-dark">CLEAR SEARCH</a>
      </div>
    </div>
  </section>
<?php
wp_reset_query();
