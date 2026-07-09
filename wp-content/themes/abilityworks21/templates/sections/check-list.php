<?php
$title = get_sub_field('title');
$right_button = get_sub_field('button');
$items = get_sub_field('items');
$totalItems = is_array($items) ? sizeof($items) : 0;
if ( $totalItems > 0 ) :
?>
<section <?php AW_Helpers::SectionAttrs('check-list'); ?>>
  <div class="container">
    <?php if ( $title || $right_button['title'] ) : ?>
      <div class="headline">
        <?php if ( $title ) : ?>
          <h2><?php echo $title; ?></h2>
        <?php endif; ?>
        <?php if ( $right_button['title'] ) : ?>
          <a class="btn btn-outline-dark" target="<?php echo $right_button['target']!='0' ? $right_button['target'] : '_self'; ?>"
            href="<?php echo !empty($right_button['url']) ? $right_button['url'] : '#'; ?>"><?php echo $right_button['title']; ?></a>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <ul class="<?php echo ($totalItems > 3) ? 'more-3' : 'ttl-' . $totalItems; ?>">
      <?php
        while ( have_rows('items') ) :
          the_row();
          $linkTo = get_sub_field('link_to');
      ?>
        <li><a href="<?php echo !empty($linkTo) ? $linkTo : 'javascript:;'; ?>"
          <?php echo empty($linkTo) ? 'class="no-link"' : ''; ?>><span><?php the_sub_field('title'); ?></span></a></li>
      <?php endwhile; ?>
    </ul>

    <?php if ( $right_button['title'] ) : ?>
      <div class="foot">
        <a class="btn btn-outline-dark" target="<?php echo $right_button['target']!='0' ? $right_button['target'] : '_self'; ?>"
          href="<?php echo !empty($right_button['url']) ? $right_button['url'] : '#'; ?>"><?php echo $right_button['title']; ?></a>
      </div>
    <?php endif; ?>
  </div>
</section>
<?php endif;
