<?php get_header(); ?>
<main id="main">
  <?php
    if (have_posts()) :
      while (have_posts()) :
        the_post();
        $sectionCounter = 0;
  ?>
    <?php get_template_part( 'templates/sections/breadcrumb', null, ['restricted_width' => true] ); ?>

    <section class="ca-sections">
      <?php
        get_template_part( 'templates/post/details' );

        get_template_part( 'templates/sections/spacer', null, [
          'bg_color' => '#ffffff',
          'height_sm' => 0,
          'height_md' => 0,
          'height_lg' => 67,
        ]);

        get_template_part( 'templates/post/related' );
      ?>
    </section>
  <?php
      endwhile;
    endif;
  ?>
</main>
<?php get_footer(); ?>
