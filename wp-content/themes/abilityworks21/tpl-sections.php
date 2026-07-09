<?php
/**
 * Template Name: Sections
 * Template Post Type: page, post
 */
global $post, $sectionCounter;
get_header(); ?>
<main id="main">
  <?php
    if (have_posts()) :
      while (have_posts()) :
        the_post();
  ?>
    <?php get_template_part( 'templates/sections/breadcrumb' ); ?>

    <?php if ( have_rows('ca_sections') ) : ?>
      <!-- Sections Start -->
      <section class="ca-sections">
        <?php
          $sectionCounter = 0;
          while ( have_rows('ca_sections') ) :
            the_row();
            $sectionCounter++;
            $sectionLayout = get_row_layout();
        ?>
          <?php get_template_part( 'templates/sections/' . $sectionLayout ); ?>
        <?php endwhile; ?>
      </section>
      <!-- Sections End -->
    <?php endif; ?>
  <?php
      endwhile;
    endif;
  ?>
</main>
<?php get_footer(); ?>
