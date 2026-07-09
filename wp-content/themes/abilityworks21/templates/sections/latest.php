<section <?php AW_Helpers::SectionAttrs('latest'); ?>>
  <div class="wrap">
    <?php if ( $title = get_sub_field('title') ) : ?>
      <h2 class="st-title"><?php echo $title; ?></h2>
    <?php endif; ?>

    <div class="the-grid">
      <div class="grid-row">
        <div class="grid-col">
          <?php get_template_part('templates/sections/inc/latest', 'newsroom'); ?>
        </div>
        <div class="grid-col d-none d-md-block">
          <?php get_template_part('templates/sections/inc/latest', 'social'); ?>
        </div>
      </div>
      <div class="grid-row">
        <div class="grid-col">
          <?php get_template_part('templates/sections/inc/latest', 'testimonial'); ?>
        </div>
        <div class="grid-col">
          <?php get_template_part('templates/sections/inc/latest', 'video'); ?>
        </div>
      </div>
    </div>
  </div>
</section>
