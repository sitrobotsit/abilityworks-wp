<?php
$vidCats = get_terms([
  'taxonomy' => 'pxa-video-cat',
  'hide_empty' => true,
]);
$initCats = isset($_GET['vidcats']) ? $_GET['vidcats'] : [];
$vid = isset($_GET['vid']) ? intval($_GET['vid']) : '';
if ( !is_array($initCats) ) $initCats = [];
?>
<section <?php PXA_Helpers::SectionAttrs('list-videos'); ?>
  data-scroll-here="<?php echo (sizeof($initCats) && !$vid) ? 'yes' : '';?>">
  <div class="container">
    <div class="filters">
      <form method="get" action="" class="form-filter-video">
        <input type="hidden" name="vid" value="">
        <div class="filter">
          <label class="lb" for="vidcats">VIDEO CATEGORY</label>
          <select id="vidcats" name="vidcats[]" multiple class="slchk">
            <?php foreach ($vidCats as $vidCat) : ?>
              <option value="<?php echo $vidCat->term_id; ?>"
                <?php echo in_array($vidCat->term_id, $initCats) ? 'selected="selected"' : ''; ?>>
                <?php echo $vidCat->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </form>
    </div>

    <?php
      $args = [
        'post_type' => 'post',
        'posts_per_page' => -1,
        'meta_query' => [
          [
            'key' => 'post_resource_type',
            'value' => get_field('video_resource_type', 'option'),
          ]
        ]
      ];
      if ( sizeof($initCats) ) {
        $args['tax_query'] = [
          [
            'taxonomy' => 'pxa-video-cat',
            'field' => 'term_id',
            'terms' => $initCats,
          ]
        ];
      }
      query_posts( $args );
      if ( have_posts() ) :
    ?>
      <div class="videos-carousel">
        <?php
          while ( have_posts() ) :
            the_post();
        ?>
          <div class="item">
            <?php get_template_part( 'templates/loop', 'video' ); ?>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="videos-carousel-btm">
        <div class="videos-carousel-dots"></div>
        <div class="videos-carousel-navs"></div>
      </div>
    <?php
      endif;
    ?>
  </div>
</section>
<?php
wp_reset_query();
