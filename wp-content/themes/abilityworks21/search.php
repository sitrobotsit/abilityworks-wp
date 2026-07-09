<?php
global $wp_query, $paged;
get_header();
?>
<main id="main">
  <?php get_template_part( 'templates/sections/breadcrumb' ); ?>

  <section class="st-search-results">
    <h2 class="titlebar d-lg-none">
      <span class="txt">Search Results</span>
      <span class="bg"></span>
    </h2>

    <div class="container">
      <h1 class="titlebar-lg"><span>Search results</span></h1>

      <?php if ( have_posts() ) : ?>
        <div class="results">
          <?php
            if (have_posts()) :
              while (have_posts()) :
                the_post();
                get_template_part( 'templates/loop', 'search-item' );
              endwhile;
            endif;
          ?>
        </div>

        <div class="paginate">
          <?php posts_nav_link('<span class="sep"></span>'); ?>
        </div>
      <?php else : ?>
        <div class="no-results">
          <div class="headline">
            <h2 class="st-title">
              0 results for &ldquo;<?php echo get_search_query(); ?>&rdquo;</h2>
            <a href="<?php bloginfo('url'); ?>" class="btn btn-outline-dark">CLEAR SEARCH</a>
          </div>

          <h4 class="no-msg">Please clear your search and try again.</h4>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>
