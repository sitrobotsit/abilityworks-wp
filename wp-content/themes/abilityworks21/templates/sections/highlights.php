<?php
global $sectionCounter, $post;
$autoScroll = get_sub_field('auto_scroll');
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$postType = get_sub_field('post_type');
switch ($postType) {
  case 'pxa-comm-activity':
    $highlightType = 'activity';
    $postIds = get_sub_field('activities');
    break;
  case 'pxa-comm-story':
    $highlightType = 'story';
    $postIds = get_sub_field('stories');
    break;
  default:
    $highlightType = 'resource';
    $postIds = get_sub_field('resources');
    break;
}
if ( !is_array($postIds) || sizeof($postIds) <= 0 ) return;
?>
<section <?php PXA_Helpers::SectionAttrs('highlights'); ?> data-index="<?php echo $sectionCounter; ?>"
  data-autoscroll="<?php echo $autoScroll ? 'yes' : '';?>">
  <div class="container">
    <?php if ( $title || have_rows('links') ) : ?>
      <div class="headline">
        <?php if ( $title ) : ?>
          <h2 class="title"><?php echo $title; ?></h2>
        <?php endif; ?>

        <?php if ( $subtitle ) : ?>
          <div class="subtitle"><?php echo $subtitle; ?></div>
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

    <?php
      query_posts([
        'post_type' => $postType,
        'posts_per_page' => -1,
        'post__in' => $postIds,
        'orderby' => 'post__in',
        'order' => 'ASC'
      ]);
      if ( have_posts() ) :
    ?>
        <div class="highlights-carousel">
          <?php while ( have_posts() ) : the_post(); ?>
            <div class="item">
              <?php get_template_part( 'templates/loop-highlight', $highlightType ); ?>
            </div>
          <?php endwhile; ?>
        </div>
        <div class="highlights-carousel-btm">
          <div class="highlights-carousel-dots"></div>
          <div class="highlights-carousel-navs"></div>
        </div>
    <?php
      endif;
      wp_reset_query();
    ?>

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
