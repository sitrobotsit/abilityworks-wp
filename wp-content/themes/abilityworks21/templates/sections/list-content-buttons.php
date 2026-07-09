<section <?php PXA_Helpers::SectionAttrs('list-content-buttons'); ?>>
  <div class="container">
    <?php if ( have_rows('items') ) : ?>
      <?php
        while ( have_rows('items') ) :
          the_row();
      ?>
        <div class="item">
          <div class="item-text">
            <?php if ( $title = get_sub_field('title') ) : ?>
              <h3 class="title"><?php echo $title; ?></h3>
            <?php endif; ?>
            <div class="desc format">
              <?php the_sub_field('description'); ?>
            </div>
          </div>
          <ul class="item-btns">
            <?php
              while ( have_rows('buttons') ) :
                the_row();
            ?>
              <?php if ( $btnText = get_sub_field('text') ) : ?>
                <li><a href="<?php the_sub_field('url'); ?>" class="arrow-link"><?php echo $btnText; ?></a></li>
              <?php endif; ?>
            <?php endwhile; ?>
          </ul>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</section>
