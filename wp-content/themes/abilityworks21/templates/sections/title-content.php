<section <?php AW_Helpers::SectionAttrs('title-content'); ?>>
  <div class="container">
    <div class="inn" style="max-width: <?php the_sub_field('width');?>%">
      <?php if ( $title = get_sub_field('title') ) : ?>
        <h2 class="st-title"><?php echo $title; ?></h2>
      <?php endif; ?>
      <?php if ( $content = get_sub_field('content') ) : ?>
        <div class="content format">
          <?php echo $content; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
