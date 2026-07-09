<?php
$post_embed_media = get_field('post_embed_media');
?>
<section class="st-caro-09">
  <div class="wrap">
    <div class="slides-wrapper">
      <div class="slides">
        <?php
          while ( have_rows('post_carousel_images') ) :
            the_row();
            $image = get_sub_field('image');
            $mobile_image = get_sub_field('mobile_image');
            if ( !$mobile_image ) {
              $mobile_image = $image;
            }
        ?>
          <div class="slide">
            <?php if ( $image ) : ?>
              <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="img-fluid d-none d-md-block">
            <?php endif; ?>
            <?php if ( $mobile_image ) : ?>
              <img src="<?php echo $mobile_image['url']; ?>" alt="<?php echo $mobile_image['alt']; ?>" class="img-fluid d-md-none">
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="d-none d-lg-block">
        <div class="post-sharing">
          <div class="sharing_header">SHARE</div>
          <?php echo do_shortcode('[addtoany]'); ?>
        </div>
        <div class="slides-nav"></div>
      </div>
    </div>

    <div class="intro">
      <h1 class="title d-none d-lg-block"><span><?php the_title(); ?></span></h1>
      <h2 class="titlebar with-bg d-lg-none">
        <span class="txt"><?php the_title(); ?></span>
        <span class="bg"></span>
      </h2>
      <div class="desc">
        <div class="format">
          <p class="post-meta">
            <?php echo strip_tags(get_the_tag_list('', ', ', '')); ?>
            <span class="sep">|</span>
            <?php the_date();?>
          </p>
          <?php the_content(); ?>
        </div>
        <?php if ($post_embed_media) : ?>
          <div class="d-none d-lg-block pt-4">
            <div class="embed-responsive embed-responsive-16by9">
              <?php echo $post_embed_media; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
      <?php if ($post_embed_media) : ?>
        <div class="d-lg-none">
          <div class="embed-responsive embed-responsive-16by9">
            <?php echo $post_embed_media; ?>
          </div>
          <div class="post-sharing">
            <div class="sharing_header">SHARE</div>
            <?php echo do_shortcode('[addtoany]'); ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
