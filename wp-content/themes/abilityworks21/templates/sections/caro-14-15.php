<section <?php AW_Helpers::SectionAttrs('caro-14-15'); ?>>
  <div class="wrap">
    <div class="intro">
      <div class="title">
        <div class="bar"></div>
        <?php if ( $title = get_sub_field('title') ) : ?>
          <h2 class="titlebar with-bg">
            <span class="txt"><?php echo $title; ?></span>
            <span class="bg"></span>
          </h2>
        <?php endif; ?>
      </div>

      <div class="desc">
        <div class="inn">
          <div class="format">
            <?php the_sub_field('content'); ?>
          </div>
        </div>
      </div>
    </div>

    <div class="slides-wrapper">
      <div class="slides">
        <?php
          while ( have_rows('slides') ) :
            the_row();
            $icon = get_sub_field('icon');
            $description = get_sub_field('description');
        ?>
          <div class="slide">
            <div class="item">
              <div class="headline">
                <?php if ( $icon ) : ?>
                  <div class="icon">
                    <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                  </div>
                <?php endif; ?>
                <div class="title-area">
                  <?php if ( $subtitle = get_sub_field('subtitle') ) : ?>
                    <div class="subtitle"><?php echo $subtitle; ?></div>
                  <?php endif; ?>
                  <?php if ( $title = get_sub_field('title') ) : ?>
                    <h3 class="title"><?php echo $title; ?></h3>
                  <?php endif; ?>
                </div>
              </div>
              <?php if ( !empty($description) ) : ?>
                <div class="desc format">
                  <?php echo $description; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="slides-controls">
      <span class="lb">CLICK THROUGH</span>
      <button type="button" class="btn-play icon-play-circle"></button>
      <div class="slides-nav"></div>
    </div>
  </div>
</section>
