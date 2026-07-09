<?php
$caro18Query = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => (int) get_sub_field('posts_per_page'),
]);
if ( $caro18Query->have_posts() ) :
?>
<section <?php AW_Helpers::SectionAttrs('caro-18'); ?> data-slides="<?php echo $caro18Query->found_posts; ?>">
  <div class="container">
    <?php if ( $title = get_sub_field('title') ) : ?>
      <h2 class="st-title"><?php echo $title; ?></h2>
    <?php endif; ?>
    <div class="slides-wrapper">
      <div class="slides">
        <?php
          while ( $caro18Query->have_posts() ) :
            $caro18Query->the_post();
        ?>
          <div class="loop-post slide">
            <?php get_template_part('templates/loop', 'post'); ?>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="slides-controls">
        <form class="sform" method="get" action="<?php the_field('ca_newsroom_search_results_url', 'option'); ?>">
          <input type="text" name="kw" placeholder="WHAT ARE YOU LOOKING FOR?" class="form-control">
          <button type="submit" class="icon-search"></button>
        </form>
        <button type="button" class="btn-search icon-search-circle-2"></button>
        <button type="button" class="btn-play icon-pause-circle"></button>
        <div class="slides-nav"></div>
      </div>
    </div>
  </div>
</section>
<?php
endif;
wp_reset_query();
