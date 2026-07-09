<?php
$catId = get_sub_field('member_category');
$args = [
  'post_type' => 'aw-member',
  'posts_per_page' => -1,
  'orderby' => 'menu_order',
  'order' => 'ASC',
  'tax_query' => [
    [
      'taxonomy' => 'aw-member-cat',
      'terms' => $catId,
    ]
  ]
];
query_posts($args);
?>
<section <?php AW_Helpers::SectionAttrs('list-members'); ?>>
  <div class="container">
    <?php if ( $title = get_sub_field('title') ) : ?>
      <h2 class="st-title"><?php echo $title; ?></h2>
    <?php endif; ?>
    <?php if ( $desc = get_sub_field('description') ) : ?>
      <div class="desc format">
        <?php echo $desc; ?>
      </div>
    <?php endif; ?>
    <ul class="members">
      <?php while (have_posts()) : the_post(); ?>
        <li>
          <div class="thumb">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail('aw-220x220', ['class' => 'img-fluid']); ?>
            <?php else : ?>
              <div class="ph-img"></div>
            <?php endif; ?>
          </div>

          <h4><?php the_title(); ?></h4>

          <?php if ( $role = get_field('member_role') ) : ?>
            <div class="role"><?php echo $role; ?></div>
          <?php else: ?>
            <?php the_excerpt(); ?>
          <?php endif; ?>

          <?php if ( get_field('member_link_to_bio') ) : ?>
            <a href="<?php the_permalink(); ?>" class="btn btn-more btn-outline-dark">READ MORE</a>
          <?php endif; ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>
</section>
<?php
wp_reset_query();
