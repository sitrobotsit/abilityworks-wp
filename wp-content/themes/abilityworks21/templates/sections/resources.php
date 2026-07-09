<?php
global $sectionCounter, $post;
$isResourcesPage = ($post->ID == get_field('page_resources', 'option'));

$title = get_sub_field('title');

$topics = get_terms([
  'taxonomy' => 'pxa-topic',
  'hide_empty' => false,
]);
$initTopics = isset($_GET['topics']) ? $_GET['topics'] : [];
if ( !is_array($initTopics) ) $initTopics = [];

$phases = get_terms([
  'taxonomy' => 'pxa-phase',
  'hide_empty' => false,
]);
$initPhases = isset($_GET['phases']) ? $_GET['phases'] : [];
if ( !is_array($initPhases) || sizeof($initPhases) == 0 ) {
  $initPhases = [];
  $defaultPhase = get_sub_field('default_phase');
  if ( $defaultPhase ) $initPhases[] = $defaultPhase;
}

$categories = get_categories([
  'hide_empty' => false,
]);
$initCats = isset($_GET['cats']) ? $_GET['cats'] : [];
if ( !is_array($initCats) ) $initCats = [];

$advTags = get_tags([
  'hide_empty' => false,
]);
$initTags = isset($_GET['tags']) ? $_GET['tags'] : [];
if ( !is_array($initTags) ) $initTags = [];

$isCarousel = get_sub_field('is_carousel');
$posts_per_page = (int) get_sub_field('posts_per_page');
if ( $posts_per_page < 0 ) $posts_per_page = 8;
?>
<section <?php PXA_Helpers::SectionAttrs('resources'); ?> data-index="<?php echo $sectionCounter; ?>"
  data-is_resources="<?php echo $isResourcesPage ? 'yes' : 'no'; ?>"
  data-carousel="<?php echo $isCarousel ? 'yes' : 'no'; ?>">
  <div class="container">
    <?php if ( $title || have_rows('links') ) : ?>
      <div class="headline">
        <?php if ( $title ) : ?>
          <h2 class="title"><?php echo $title; ?></h2>
        <?php endif; ?>
        <?php if ( have_rows('links') ) : ?>
          <ul class="links">
            <?php while ( have_rows('links') ) : the_row(); ?>
              <li><a<?php echo get_sub_field('open_in_new_tab') ? ' target="_blank"' : ''; ?>
                href="<?php the_sub_field('url'); ?>" class="arrow-link">
                <?php the_sub_field('label'); ?></a></li>
            <?php endwhile; ?>
          </ul>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <form method="get" id="filterForm" action="<?php echo admin_url('admin-ajax.php');?>">
      <input type="hidden" name="action" value="pxa_get_resources">
      <input type="hidden" name="paged" id="paged" value="<?php echo isset($_GET['paged']) ? intval($_GET['paged']) : 1; ?>">
      <input type="hidden" name="ipp" value="<?php echo $posts_per_page; ?>">
      <div class="resource-filters">
        <div class="mob-toggle">
          <a href="javascript:;" class="toggle-opts">Filter results</a>
        </div>

        <div class="filter-opts">
          <div class="topic-filter">
            <label class="lb" for="topic">TOPIC</label>
            <select id="topics" name="topics[]" multiple class="slchk">
              <?php foreach ($topics as $topic) : ?>
                <option value="<?php echo $topic->term_id; ?>"
                  <?php echo in_array($topic->term_id, $initTopics) ? 'selected="selected"' : ''; ?>>
                  <?php echo $topic->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="category-filter">
            <label class="lb" for="cats">CATEGORY</label>
            <select id="cats" name="cats[]" multiple class="slchk">
              <?php foreach ($categories as $cat) : ?>
                <option value="<?php echo $cat->term_id; ?>"
                  <?php echo in_array($cat->term_id, $initCats) ? 'selected="selected"' : ''; ?>>
                  <?php echo $cat->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="phase-search">
            <div class="phase-filter">
              <label class="lb" for="phase">PHASE</label>
              <ul>
                <?php foreach ( $phases as $phase ) : ?>
                  <li>
                    <label><input type="checkbox" name="phases[]" value="<?php echo $phase->term_id; ?>"
                      <?php echo in_array($phase->term_id, $initPhases) ? 'checked="checked"' : ''; ?>>
                      <span><?php echo $phase->name; ?></span></label></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="kw-search">
              <input type="text" name="kw" id="kw" placeholder="What are you searching for?"
                value="<?php echo isset($_GET['kw']) ? trim($_GET['kw']) : ''; ?>">
              <button type="button" class="icon-close kw-close"></button>
              <button type="submit" class="icon-search kw-submit"></button>
              <button type="button" class="icon-search kw-toggler"></button>
            </div>
          </div>

          <div class="adv">
            <a href="javascript:;" class="toggle-adv">ADVANCED</a>
          </div>
        </div>

        <?php if ( $advTags ) : ?>
          <div class="adv-wrapper">
            <div class="adv-box">
              <div class="adv-top">
                <h4>Filter your search down further with the below tags…</h4>
                <a href="javascript:;" id="resetTags">RESET SELECTION</a>
              </div>
              <ul>
                <?php foreach ( $advTags as $advTag ) : ?>
                  <li>
                    <label>
                      <input type="checkbox" name="tags[]" value="<?php echo $advTag->term_id; ?>"
                        <?php echo in_array($advTag->term_id, $initTags) ? 'checked="checked"' : ''; ?>>
                      <span><?php echo $advTag->name; ?></span>
                    </label>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </form>

    <!-- Init carousel -->
    <?php
      if ( $isCarousel ) :
        query_posts([
          'post_type' => 'post',
          'posts_per_page' => -1,
          'post__in' => get_sub_field('resources'),
          'orderby' => 'post__in',
          'order' => 'ASC',
        ]);
        if ( have_posts() ) :
    ?>
        <div class="resources-carousel">
          <?php while ( have_posts() ) : the_post(); ?>
            <div class="item">
              <?php get_template_part( 'templates/loop', 'resource' ); ?>
            </div>
          <?php endwhile; ?>
        </div>
        <div class="resources-carousel-btm">
          <div class="resources-carousel-dots"></div>
          <div class="resources-carousel-navs"></div>
        </div>
    <?php
        endif;
        wp_reset_query();
      endif;
    ?>

    <div class="resources-list"></div>
    <div class="resources-list-paging"></div>

    <?php if ( have_rows('links') ) : ?>
      <ul class="foot-links">
        <?php while ( have_rows('links') ) : the_row(); ?>
          <li><a<?php echo get_sub_field('open_in_new_tab') ? ' target="_blank"' : ''; ?>
            href="<?php the_sub_field('url'); ?>" class="arrow-link">
            <?php the_sub_field('label'); ?></a></li>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>
  </div>
</section>
<?php
$bgImage = get_sub_field('bg_image');

PXA_Helpers::SectionStyles('resources', $sectionCounter, [
  'mobile' => [
  ],
  'tablet' => [
  ],
  'desktop' => [
    'background-image' => "url({$bgImage})",
  ],
  'large' => [
  ],
]);
