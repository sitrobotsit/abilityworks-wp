<section <?php AW_Helpers::SectionAttrs('video-grid'); ?>>
  <div class="container">
    <?php if ( $title = get_sub_field('title') ) : ?>
      <h2 class="st-title"><?php echo $title; ?></h2>
    <?php endif; ?>

    <ul class="videos">
      <?php
        while ( have_rows('videos') ) :
          the_row();
          $image = get_sub_field('poster');
          $video = get_sub_field('video');
      ?>
        <li>
          <?php
            get_template_part('templates/sections/inc/video-item', null, [
              'image' => $image,
              'video' => $video,
            ]);
          ?>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>
</section>
