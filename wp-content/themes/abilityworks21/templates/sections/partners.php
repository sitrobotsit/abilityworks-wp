<section <?php PXA_Helpers::SectionAttrs('partners'); ?>>
  <div class="container">
    <?php if ( $title = get_sub_field('title') ) : ?>
      <h3 class="title"><?php echo $title; ?></h3>
    <?php endif; ?>
    <div class="inn">
      <?php for ( $i=1; $i<=3; $i++ ) : ?>
        <div class="partners-group">
          <?php if ( $title = get_sub_field("title_col_{$i}") ) : ?>
            <h4><?php echo $title; ?></h4>
          <?php endif; ?>
          <?php if ( $desc = get_sub_field("description_col_{$i}") ) : ?>
            <div class="desc">
              <?php echo $desc; ?>
            </div>
          <?php endif; ?>
          <?php if ( have_rows("partner_groups_col_{$i}") ) : ?>
            <div class="partners">
              <?php while ( have_rows("partner_groups_col_{$i}") ) : the_row(); ?>
                <?php the_sub_field('partners'); ?>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</section>
