<section <?php AW_Helpers::SectionAttrs('faqs'); ?> data-catid="<?php the_sub_field('category'); ?>">
  <div class="container">
    <?php if ( $title = get_sub_field('title') ) : ?>
      <h2 class="st-title"><?php echo $title; ?></h2>
    <?php endif; ?>
    <div class="desc format">
      <?php the_sub_field('description'); ?>
    </div>

    <div class="faqs-wrapper">
      <div class="left-col"></div>
      <div class="right-col"></div>
    </div>

    <div class="faqs-loader"></div>
  </div>
</section>
