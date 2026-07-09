<?php
$leftItems = '';
$rightItems = '';
if ( have_rows('items') ) {
  $counter = 0;
  while ( have_rows('items') ) {
    the_row();
    $itemHTML = '<div class="faq">';
    $itemHTML .= '<div class="q">';
    $itemHTML .= '<a href="javascript:;">' . get_sub_field('title') . '</a>';
    $itemHTML .= '</div>';
    $itemHTML .= '<div class="a">';
    $itemHTML .= get_sub_field('description');
    $itemHTML .= '</div>';
    $itemHTML .= '</div>';
    if ( $counter%2 ) {
      $rightItems .= $itemHTML;
    }
    else {
      $leftItems .= $itemHTML;
    }
    $counter++;
  }
}
?>
<section <?php PXA_Helpers::SectionAttrs('accordion'); ?>>
  <div class="container">
    <?php if ( $title = get_sub_field('title') ) : ?>
      <h2 class="st-title text-primary"><?php echo $title; ?></h2>
    <?php endif; ?>
    <div class="desc format">
      <?php the_sub_field('description'); ?>
    </div>

    <div class="accordion-wrapper">
      <div class="left-col">
        <?php echo $leftItems; ?>
      </div>
      <div class="right-col">
        <?php echo $rightItems; ?>
      </div>
    </div>
  </div>
</section>
