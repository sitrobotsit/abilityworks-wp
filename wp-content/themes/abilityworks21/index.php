<?php
global $sectionCounter;
$page_for_posts = get_option('page_for_posts');
get_header();
?>
<main id="main">
  <?php get_template_part( 'templates/sections/breadcrumb' ); ?>

  <div id="main-content">
    <?php if ( have_rows('ca_sections', $page_for_posts) ) : ?>
      <!-- Sections Start -->
      <section class="ca-sections">
        <?php
          $sectionCounter = 0;
          while ( have_rows('ca_sections', $page_for_posts) ) :
            the_row();
            $sectionCounter++;
            $sectionLayout = AW_Helpers::ResolveSectionTemplate( get_row_layout() );
        ?>
          <?php get_template_part( 'templates/sections/' . $sectionLayout ); ?>
        <?php endwhile; ?>
      </section>
      <!-- Sections End -->
    <?php endif; ?>
  </div>
</main>
<?php get_footer(); ?>
