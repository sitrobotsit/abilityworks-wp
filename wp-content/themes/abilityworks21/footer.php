<footer id="footer" class="d-print-none">
  <?php
    $logos = get_field('ca_logo_slider_logos', 'option');
    if ( sizeof($logos) ) :
  ?>
    <section class="footer-logos">
      <div class="container">
        <div class="inn">
          <?php if ( $logo_slider_title = get_field('ca_logo_slider_title', 'option') ) : ?>
            <h3 class="title"><?php echo $logo_slider_title; ?></h3>
          <?php endif; ?>
          <div class="logos-slider-wrapper">
            <div id="logos-slider" class="logos-slider">
              <?php foreach ( $logos as $logo ) : ?>
                <div class="item">
                  <a href="<?php echo !empty($logo['description']) ? $logo['description'] : 'javascript:;'; ?>" target="_blank"><img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"></a>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="logos-carousel-arrows sitrobot-test-deploy-5"></div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ( is_active_sidebar('pre-footer-widgets') ) : ?>
    <section class="footer-widgets">
      <div class="container">
        <div class="inn">
          <?php dynamic_sidebar('pre-footer-widgets'); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <div class="copyright">
    <div class="container">
      <div class="inn">
        <div class="copyright-text"><?php the_field('ca_copyright', 'option'); ?></div>
        <?php
          wp_nav_menu(array(
            'theme_location'  => 'legal-menu',
            'menu'            => '',
            'container'       => '',
            'container_class' => '',
            'container_id'    => '',
            'menu_class'      => '',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul class="legal-menu" role="menu">%3$s</ul>',
            'depth'           => 1,
          ));
        ?>
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
