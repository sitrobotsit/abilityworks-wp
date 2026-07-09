<section class="st-member-info">
  <div class="wrap">
    <div class="photo">
      <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail('full', ['class'=>'img-fluid']); ?>
      <?php endif; ?>
    </div>
    <div class="info">
      <h2 class="titlebar with-bg">
        <span class="txt"><?php the_title(); ?></span>
        <span class="bg"></span>
      </h2>

      <h1 class="st-title"><span><?php the_title(); ?></span></h1>

      <div class="intro">
        <div class="format">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
