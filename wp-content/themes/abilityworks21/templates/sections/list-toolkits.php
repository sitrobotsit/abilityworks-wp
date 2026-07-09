<?php
$toolkits = get_sub_field('toolkits');
$args = [
  'post_type' => 'pxa-toolkit',
  'posts_per_page' => -1,
  'post__in' => $toolkits,
  'orderby' => 'post__in',
];
query_posts( $args );
if ( have_posts() ) :
?>
<section <?php PXA_Helpers::SectionAttrs('list-toolkits'); ?>>
  <div class="container">
    <div class="toolkits-carousel">
      <?php
        while ( have_posts() ) :
          the_post();
      ?>
        <div class="item">
          <?php get_template_part( 'templates/loop', 'toolkit' ); ?>
        </div>
      <?php endwhile; ?>
    </div>
    <div class="toolkits-carousel-btm">
      <div class="toolkits-carousel-dots"></div>
      <div class="toolkits-carousel-navs"></div>
    </div>
  </div>
</section>
<?php
endif;
wp_reset_query();
