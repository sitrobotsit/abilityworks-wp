<?php
if ( function_exists('bcn_display') && !get_field('ca_breadcrumb_disabled') ) : ?>
  <section class="st-breadcrumb<?php echo $args['restricted_width'] ? ' restricted-width' : ''; ?>">
    <div class="container">
      <div class="inn">
        <div class="breadcrumb-wrapper"><?php bcn_display(); ?></div>
      </div>
    </div>
  </section>
<?php endif; ?>
