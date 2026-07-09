<?php
$title = get_sub_field('title');
$right_button = get_sub_field('right_button');
$slides = get_sub_field('slides');
?>
<section <?php AW_Helpers::SectionAttrs('caro-10'); ?> data-slides="<?php echo sizeof($slides); ?>">
  <div class="container">
    <?php if ( $title || $right_button['title'] ) : ?>
      <div class="headline">
        <?php if ( $title ) : ?>
          <h2><?php echo $title; ?></h2>
        <?php endif; ?>

        <?php if ( !empty($right_button['title']) ) : ?>
          <a href="<?php echo $right_button['url']; ?>" target="<?php echo $right_button['target']!='0' ? $right_button['target'] : '_self'; ?>"
            class="btn btn-outline-dark"><?php echo $right_button['title']; ?></a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <div class="slides-wrapper">
      <div class="slides">
        <?php
          while ( have_rows('slides') ) :
            the_row();
            $icon = get_sub_field('icon');
            $button = get_sub_field('button');
            $bg_color = get_sub_field('bg_color');
        ?>
          <div class="slide" style="background-color: <?php echo $bg_color; ?>">
            <div class="slide-head">
              <?php if ( $icon ) : ?>
                <div class="icon">
                  <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                </div>
              <?php endif; ?>
              <?php if ( $title = get_sub_field('title') ) : ?>
                <h4 class="title"><?php echo $title; ?></h4>
              <?php endif; ?>
            </div>

            <?php if ( $desc = get_sub_field('description') ) : ?>
              <div class="desc">
                <div class="format">
                  <?php echo $desc; ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if ( !empty($button['title']) ) : ?>
              <a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']!='0' ? $button['target'] : '_self'; ?>"
                class="btn btn-outline-dark"><?php echo $button['title']; ?></a>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="slides-controls">
        <button type="button" class="btn-play icon-pause-circle"></button>
        <div class="slides-nav"></div>
      </div>
    </div>
  </div>
</section>
