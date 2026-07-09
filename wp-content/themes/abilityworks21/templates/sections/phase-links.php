<section <?php PXA_Helpers::SectionAttrs('phase-links'); ?>>
  <div class="container">
    <div class="inn">
      <?php if ( $headline = get_sub_field('headline') ) : ?>
        <h2 class="headline"><?php echo $headline; ?></h2>
      <?php endif; ?>

      <?php if ( have_rows('links') ) : ?>
        <ul class="links">
          <?php while ( have_rows('links') ) : the_row(); ?>
            <li>
              <a href="<?php the_sub_field('url'); ?>">
                <?php if ( $icon = get_sub_field('icon') ) : ?>
                  <img class="ico" src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                <?php endif; ?>
                <?php if ( $title = get_sub_field('title') ) : ?>
                  <span class="title"><span><?php echo $title; ?></span></span>
                <?php endif; ?>
                <?php if ( $subtitle = get_sub_field('subtitle') ) : ?>
                  <span class="subtitle"><span><?php echo $subtitle; ?></span></span>
                <?php endif; ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</section>
