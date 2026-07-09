<?php
$tagId =  (int) get_sub_field('tag');
$caro19Query = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => (int) get_sub_field('posts_per_page'),
  'tag_id' => $tagId,
]);
if ( $caro19Query->have_posts() ) :
?>
<section <?php AW_Helpers::SectionAttrs('caro-19'); ?>>
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

    <div class="slides-wrapper">
      <div class="slides">
        <?php
          while ( $caro19Query->have_posts() ) :
            $caro19Query->the_post();
        ?>
          <div class="slide">
            <div class="loop-post">
              <?php get_template_part('templates/loop', 'post'); ?>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="slides-controls">
      <form class="sform" method="get" action="<?php the_field('ca_newsroom_search_results_url', 'option'); ?>">
        <input type="hidden" name="tagid" value="<?php echo $tagId; ?>">
        <input type="text" name="kw" placeholder="WHAT ARE YOU LOOKING FOR?" class="form-control">
        <button type="submit" class="icon-search"></button>
      </form>
      <button type="button" class="btn-search icon-search-circle-2"></button>
      <button type="button" class="btn-play icon-play-circle"></button>
      <div class="slides-nav"></div>
    </div>
  </div>
</section>
<?php
endif;
wp_reset_query();
