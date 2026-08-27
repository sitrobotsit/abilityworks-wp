<?php
/**
 * Latest articles (replaces caro-18 carousel).
 * Shows the two most recent posts.
 */
$query = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => 2,
]);
if ( ! $query->have_posts() ) {
  return;
}
?>
<section <?php AW_Helpers::SectionAttrs('articles-latest'); ?>>
  <div class="container">
    <?php if ( $title = get_sub_field('title') ) : ?>
      <h2 class="st-title"><?php echo $title; ?></h2>
    <?php endif; ?>

    <div class="articles-grid">
      <?php
        while ( $query->have_posts() ) :
          $query->the_post();
      ?>
        <article class="loop-post">
          <?php get_template_part('templates/loop', 'post'); ?>
        </article>
      <?php endwhile; ?>
    </div>

    <div class="articles-search">
      <form class="sform" method="get" action="<?php the_field('ca_newsroom_search_results_url', 'option'); ?>">
        <input type="text" name="kw" placeholder="WHAT ARE YOU LOOKING FOR?" class="form-control">
        <button type="submit" class="icon-search"></button>
      </form>
      <button type="button" class="btn-search icon-search-circle-2" aria-label="Search"></button>
    </div>
  </div>
</section>
<?php
wp_reset_postdata();
