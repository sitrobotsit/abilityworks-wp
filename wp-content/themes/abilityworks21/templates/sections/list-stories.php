<?php
$postType = get_sub_field('post_type');
if ( empty($postType) ) {
  $postType = 'pxa-comm-story';
}
$storyTagTax = ($postType == 'recap-story') ? 'recap-story-tag' : 'pxa-story-tag';
$storyTags = get_terms([
  'taxonomy' => $storyTagTax,
  'hide_empty' => true,
]);
$initTags = isset($_GET['storytags']) ? $_GET['storytags'] : [];
if ( !is_array($initTags) ) $initTags = [];
?>
<section <?php PXA_Helpers::SectionAttrs('list-stories'); ?>
  data-scroll-here="<?php echo sizeof($initTags) ? 'yes' : '';?>">
  <div class="container">
    <div class="filters">
      <form method="get" action="" class="form-filter-video">
        <div class="filter">
          <label class="lb" for="storytags">
            <?php if ( $postType == 'recap-story' ) : ?>
              RECAP CAPITAL CATEGORY
            <?php else : ?>
              CAPITAL CATEGORY
            <?php endif; ?>
          </label>
          <select id="storytags" name="storytags[]" multiple class="slchk">
            <?php foreach ($storyTags as $storyTag) : ?>
              <option value="<?php echo $storyTag->term_id; ?>"
                <?php echo in_array($storyTag->term_id, $initTags) ? 'selected="selected"' : ''; ?>>
                <?php echo $storyTag->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </form>
    </div>

    <?php
      $args = [
        'post_type' => $postType,
        'posts_per_page' => -1,
      ];
      if ( sizeof($initTags) ) {
        $args['tax_query'] = [
          [
            'taxonomy' => $storyTagTax,
            'field' => 'term_id',
            'terms' => $initTags,
          ]
        ];
      }
      query_posts( $args );
      if ( have_posts() ) :
    ?>
      <div class="stories-carousel">
        <?php
          while ( have_posts() ) :
            the_post();
        ?>
          <div class="item">
            <?php get_template_part( 'templates/loop', 'story' ); ?>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="stories-carousel-btm">
        <div class="stories-carousel-dots"></div>
        <div class="stories-carousel-navs"></div>
      </div>
    <?php
      endif;
    ?>
  </div>
</section>
<?php
wp_reset_query();
