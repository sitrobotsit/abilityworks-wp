<?php
$slides = get_sub_field('slides');
$totalSlides = sizeof($slides);
?>
<section <?php AW_Helpers::SectionAttrs('caro-03'); ?>>
  <div class="wrap">
    <div class="slides-wrapper">
      <div class="slides">
        <?php
          while ( have_rows('slides') ) :
            the_row();
            $width = get_sub_field('question_width');
            $question = get_sub_field('question');
            $answer = get_sub_field('answer');
            $bg_color = get_sub_field('bg_color');
        ?>
          <div class="slide">
            <h2 class="titlebar" style="color: <?php echo $bg_color; ?>">
              <span class="txt"><?php echo $question; ?></span>
              <span class="bg"></span>
            </h2>
            <div class="question" style="width: <?php echo $width; ?>%;">
              <h2><?php echo $question; ?></h2>
              <?php if ( $totalSlides > 1 ) : ?>
                <div class="slides-nav">
                  <span>CLICK THROUGH</span>
                  <button type="button" class="btn-prev icon-caret-left-circle"></button>
                  <button type="button" class="btn-next icon-caret-right-circle"></button>
                </div>
              <?php endif; ?>
            </div>
            <div class="answer" style="width: calc(<?php echo 100 - $width; ?>% + 45px);background-color: <?php echo $bg_color; ?>;">
              <div class="format">
                <?php the_sub_field('answer'); ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="btm-slides-controls"<?php echo !get_sub_field('show_nav_buttons') ? ' style="display: none;"' : ''; ?>>
        <div class="btm-slides-nav"></div>
        <div class="slides-nav-label">CLICK THROUGH</div>
      </div>
    </div>
  </div>
</section>
