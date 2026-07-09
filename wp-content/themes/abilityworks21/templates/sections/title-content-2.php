<section <?php PXA_Helpers::SectionAttrs('title-content-2'); ?>>
  <div class="container">
    <div class="inn">
      <aside>
        <?php if ( $title = get_sub_field('title') ) : ?>
          <h2 class="title"><?php echo $title; ?></h2>
        <?php endif; ?>
        <?php if ( $subtitle = get_sub_field('subtitle') ) : ?>
          <div class="subtitle"><?php echo $subtitle; ?></div>
        <?php endif; ?>
      </aside>

      <div class="content format">
        <?php the_sub_field('content'); ?>
      </div>
    </div>
  </div>
</section>
