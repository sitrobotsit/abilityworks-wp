<section <?php AW_Helpers::SectionAttrs('reports'); ?>>
  <div class="wrap">
    <div class="info">
      <?php if ( $title = get_sub_field('title') ) : ?>
        <h2 class="titlebar with-bg">
          <span class="txt"><?php echo $title; ?></span>
          <span class="bg"></span>
        </h2>

        <h2 class="st-title"><span><?php echo $title; ?></span></h2>
      <?php endif; ?>
      <div class="desc format">
        <?php the_sub_field('description'); ?>
      </div>
    </div>

    <ul class="reports">
      <?php
        while ( have_rows('reports') ) :
          the_row();
          $item = get_sub_field('item');
      ?>
        <li>
          <?php if (!empty($item['title'])) : ?>
            <a href="<?php echo $item['url']; ?>" target="<?php echo $item['target']!='0' ? $item['target'] : '_self'; ?>">
              <?php echo $item['title']; ?></a>
          <?php endif; ?>
          <?php if ( $icon = get_sub_field('icon') ) : ?>
            <a href="<?php echo $item['url']; ?>" target="<?php echo $item['target']!='0' ? $item['target'] : '_self'; ?>">
              <img src="<?php echo $icon['url']; ?>" alt="icon">
            </a>
          <?php endif; ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>
</section>
