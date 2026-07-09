<?php get_header(); ?>
<main id="main">
  <?php get_template_part( 'templates/sections/breadcrumb' ); ?>

  <section class="st-search-results">
    <h2 class="titlebar d-lg-none">
      <span class="txt"><span style="display: inline-block;max-width: 60%;"><?php the_field('ca_404_title', 'option'); ?></span></span>
      <span class="bg"></span>
    </h2>

    <div class="container">
      <h1 class="titlebar-lg"><span><?php the_field('ca_404_title', 'option'); ?></span></h1>

      <div class="error-404">
        <div class="format">
          <?php the_field('ca_404_content', 'option'); ?>
        </div>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>
