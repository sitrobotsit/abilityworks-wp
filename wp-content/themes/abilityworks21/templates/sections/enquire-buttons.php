<?php
$title = get_sub_field('title');
$buttons = get_sub_field('buttons');
$totalItems = is_array($buttons) ? sizeof($buttons) : 0;
if ( $totalItems > 0 ) :
?>
<section <?php AW_Helpers::SectionAttrs('enquire-buttons'); ?>>
  <div class="container">
    <?php if ( $title ) : ?>
      <h2 class="st-title"><?php echo $title; ?></h2>
    <?php endif; ?>

    <ul class="btns <?php echo ($totalItems > 2) ? 'more-2' : 'ttl-' . $totalItems; ?>">
      <?php
        while ( have_rows('buttons') ) :
          the_row();
          $icon = get_sub_field('icon');
          $title = get_sub_field('title');
          $enquiry_type = get_sub_field('enquiry_type');
      ?>
        <li>
          <?php if ( $icon['url'] ) : ?>
            <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" class="icon">
          <?php endif; ?>
          <div class="inn">
            <?php if ( $title ) : ?>
              <h4><?php echo $title; ?></h4>
            <?php endif; ?>
            <a class="btn btn-outline-dark"
              href="<?php the_field('ca_contact_page_url', 'option'); ?>?enquiry-type=<?php the_sub_field('enquiry_type'); ?>">ENQUIRE</a>
          </div>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>
</section>
<?php endif;
