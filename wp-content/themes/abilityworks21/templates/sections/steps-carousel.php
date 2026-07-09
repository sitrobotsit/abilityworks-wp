<?php
$steps = get_sub_field('steps');
$totalSteps = sizeof($steps);
$initInfoText = '';
$counter = 0;
?>
<section <?php PXA_Helpers::SectionAttrs('steps-carousel'); ?>>
  <div class="container">
    <div class="inn">
      <?php if ( $title = get_sub_field('title') ) : ?>
        <h2 class="headline"><?php echo $title; ?></h2>
      <?php endif; ?>

      <?php if ( $description = get_sub_field('description') ) : ?>
        <div class="desc format">
          <?php echo $description; ?>
        </div>
      <?php endif; ?>

      <?php if ( $totalSteps > 1 ) : ?>
        <ul class="steps">
          <?php for ( $i=1; $i<=$totalSteps; $i++ ) : ?>
            <li class="step-<?php echo $i-1; ?><?php echo $i==1 ? ' active' : ''; ?>">
              <a href="javascript:;" class="show-slide" rel="<?php echo $i-1; ?>"><?php echo $i;?></a>
            </li>
          <?php endfor; ?>
        </ul>
      <?php endif; ?>

      <?php if ( have_rows('steps') ) : ?>
        <div class="steps-carousel">
          <?php
            while ( have_rows('steps') ) :
              the_row();
              $infoText = get_sub_field('info_text');
              if ( $counter == 0 ) {
                $initInfoText = $infoText;
              }
          ?>
            <div class="item">
              <?php if ( $title = get_sub_field('title') ) : ?>
                <h3 class="title"><?php echo $title; ?></h3>
              <?php endif; ?>

              <?php if ( $desc = get_sub_field('description') ) : ?>
                <div class="step-desc format">
                  <?php echo $desc; ?>
                </div>
              <?php endif; ?>

              <div class="info-text"><?php echo $infoText; ?></div>
            </div>
          <?php
              $counter++;
            endwhile;
          ?>
        </div>
      <?php endif; ?>

      <?php if ( $counter > 1 ) : ?>
        <div class="steps-carousel-navs">
          <div class="steps-arrows-container"></div>
          <div class="steps-arrows-info"><?php echo $initInfoText; ?></div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
