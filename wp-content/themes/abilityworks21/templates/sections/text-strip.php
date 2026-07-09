<section <?php AW_Helpers::SectionAttrs('text-strip'); ?>>
  <div class="container">
    <?php if ( $title = get_sub_field('title') ) : ?>
      <h1 class="title" style="color: <?php the_sub_field('text_color'); ?>"><?php echo $title; ?></h1>
    <?php endif; ?>
  </div>
</section>
