<?php
$args = [
  'post_type' => 'pxa-faq',
  'posts_per_page' => -1,
];
$footer_faqs = get_field('footer_faqs');
if ( is_array($footer_faqs) && sizeof($footer_faqs) > 0 ) {
  $args['orderby'] = 'post__in';
  $args['post__in'] = $footer_faqs;
}
else {
  $default_footer_faqs = get_field('default_footer_faqs', 'option');
  if ( is_array($default_footer_faqs) && sizeof($default_footer_faqs) > 0 ) {
    $args['orderby'] = 'post__in';
    $args['post__in'] = $default_footer_faqs;
  }
}

query_posts( $args );
if ( have_posts() ) :
?>
  <div class="faq-carousel-wrapper">
    <div class="faq-carousel">
      <?php
        $counter = 0;
        while ( have_posts() ) :
          the_post();
          $counter++;
      ?>
        <?php echo $counter%2 ? '<div class="faq-group">' : ''; ?>
          <?php get_template_part( 'templates/loop', 'faq' ); ?>
        <?php echo $counter%2 ? '' : '</div>'; ?>
      <?php endwhile; ?>
      <?php echo $counter%2 ? '</div>' : ''; ?>
    </div>
    <div class="faq-carousel-foot">
      <?php if ( !empty($all_url) ) : ?>
        <a href="<?php echo $all_url; ?>" class="arrow-link">All FAQs</a>
      <?php endif; ?>
      <div class="faq-carousel-arrows"></div>
    </div>
  </div>
<?php
endif;
wp_reset_query();
