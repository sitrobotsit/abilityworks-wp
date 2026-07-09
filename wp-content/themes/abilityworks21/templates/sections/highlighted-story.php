<?php
$storyPost = get_sub_field('comm_story');
if ( !$storyPost ) return;
$storyTags = wp_get_post_terms( $storyPost->ID, 'pxa-story-tag' );
?>
<section <?php PXA_Helpers::SectionAttrs('highlighted-story'); ?>>
  <div class="inn">
    <div class="story-details">
      <h4 class="subtitle">HIGHLIGHTED STORY</h4>
      <h3 class="post-title"><?php echo $storyPost ? $storyPost->post_title : ''; ?></h3>
      <div class="desc format">
        <?php echo get_the_excerpt( $storyPost ); ?>
      </div>
      <?php if ( sizeof($storyTags) ) : ?>
        <ul class="cats">
          <?php foreach ( $storyTags as $vidCat ) : ?>
            <li><span><?php echo $vidCat->name; ?></span></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <a href="<?php echo get_permalink($storyPost); ?>" class="more">Find out more</a>
    </div>

    <?php if ( has_post_thumbnail($storyPost) ) : ?>
      <div class="heroimg">
        <a href="<?php echo get_permalink($storyPost); ?>">
          <?php echo get_the_post_thumbnail( $storyPost, 'full', ['class' => 'img-fluid'] ); ?>
        </a>
      </div>
    <?php endif; ?>
  </div>
</section>
