<?php
/**
 * Articles by tag (replaces caro-19 carousel).
 * Shows the two most recent posts for the section's selected tag.
 */
$tagId = (int) get_sub_field('tag');
$query = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => 2,
  'tag_id' => $tagId,
]);
if ( ! $query->have_posts() ) {
  return;
}
?>
<section <?php AW_Helpers::SectionAttrs('articles-by-tag'); ?>>
  <div class="wrap">
    <div class="intro">
      <div class="title">
        <div class="bar"></div>
        <?php if ( $title = get_sub_field('title') ) : ?>
          <h2 class="titlebar with-bg">
            <span class="txt"><?php echo $title; ?></span>
            <span class="bg"></span>
          </h2>
        <?php endif; ?>
      </div>

      <div class="desc">
        <div class="inn">
          <div class="format">
            <?php the_sub_field('content'); ?>
          </div>
        </div>
      </div>
    </div>

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
  </div>

  <div class="container">
    <div class="articles-search">
      <form class="sform" method="get" action="<?php the_field('ca_newsroom_search_results_url', 'option'); ?>">
        <input type="hidden" name="tagid" value="<?php echo $tagId; ?>">
        <input type="text" name="kw" placeholder="WHAT ARE YOU LOOKING FOR?" class="form-control">
        <button type="submit" class="icon-search"></button>
      </form>
      <button type="button" class="btn-search icon-search-circle-2" aria-label="Search"></button>
    </div>
  </div>
</section>
<?php
wp_reset_postdata();
