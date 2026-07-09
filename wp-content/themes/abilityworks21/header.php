<?php
$contact_phone = get_field('ca_contact_phone', 'option');
$contact_page_url = get_field('ca_contact_page_url', 'option');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php get_template_part( 'partials/favicons' ); ?>
<title><?php echo wp_title('-')?></title>
<?php wp_head();?>
<!--[if lt IE 9]>
<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body <?php echo body_class();?>>
<a href="#main" class="skip-link">Skip to Main Content</a>
<?php wp_body_open(); ?>
<header id="header" class="d-print-none">
  <div class="inn">
    <a href="<?php echo home_url('');?>" class="logo">
      <?php if ( $logo = get_field( 'ca_logo', 'option' ) ) : ?>
        <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" class="img-fluid logo-dark">
      <?php endif; ?>
      <?php if ( $logo_light = get_field( 'ca_logo_light', 'option' ) ) : ?>
        <img src="<?php echo $logo_light['url']; ?>" alt="<?php echo $logo_light['alt']; ?>" class="img-fluid logo-light">
      <?php endif; ?>
    </a>

    <div class="form-search">
      <form role="search" method="get" action="<?php echo home_url('/'); ?>">
        <input type="search" class="form-control" name="s" id="input-search"
          placeholder="What are you searching for?"
          value="<?php echo get_search_query(); ?>">
        <button type="submit" class="icon-search"></button>
      </form>
    </div>

    <div class="mob-items">
      <a href="javascript:;" class="icon-search toggle-search"></a>
      <a href="javascript:;" class="menubar" id="menuToggle"><span></span></a>
      <?php if ( $contact_phone ) : ?>
        <a href="tel:<?php echo $contact_phone; ?>" class="icon-phone"></a>
      <?php endif; ?>
    </div>

    <div class="main-nav">
      <?php
        wp_nav_menu(array(
          'theme_location'  => 'main-menu',
          'menu'            => '',
          'container'       => 'div',
          'container_class' => 'main-menu',
          'container_id'    => '',
          'menu_class'      => '',
          'menu_id'         => '',
          'echo'            => true,
          'fallback_cb'     => 'wp_page_menu',
          'before'          => '',
          'after'           => '',
          'link_before'     => '',
          'link_after'      => '',
          'items_wrap'      => '<ul class="menu" role="menu">%3$s</ul>',
        ));
      ?>

      <ul class="btns" role="menu">
        <li><a href="javascript:;" class="icon-search-circle toggle-search"></a></li>
        <?php if ( $contact_page_url ) : ?>
          <li><a href="<?php echo $contact_page_url; ?>" class="btn btn-outline-dark">CONTACT</a></li>
        <?php endif; ?>
        <?php if ( $contact_phone ) : ?>
          <li><a href="tel:<?php echo $contact_phone; ?>" class="btn btn-outline-dark"><?php echo $contact_phone; ?></a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</header>

<div id="mob-nav" class="d-print-none">
  <div class="mob-nav-wrapper">
    <div class="inn">
      <h2 class="title">How can we help you?</h2>
      <?php
        wp_nav_menu(array(
          'theme_location'  => 'main-menu',
          'menu'            => '',
          'container'       => 'div',
          'container_class' => 'main-menu',
          'container_id'    => '',
          'menu_class'      => '',
          'menu_id'         => '',
          'echo'            => true,
          'fallback_cb'     => 'wp_page_menu',
          'before'          => '',
          'after'           => '',
          'link_before'     => '',
          'link_after'      => '',
          'items_wrap'      => '<ul class="menu" role="menu">%3$s</ul>',
        ));
      ?>
      <ul class="btns">
        <?php if ( $contact_page_url ) : ?>
          <li><a href="<?php echo $contact_page_url; ?>" class="btn btn-outline-dark">CONTACT</a></li>
        <?php endif; ?>
      </ul>

      <footer>
        <?php echo do_shortcode('[SOCIAL_ICONS]'); ?>
        <div class="copyright">
          <?php the_field('ca_copyright', 'option'); ?>
        </div>
      </footer>
    </div>
  </div>
</div>
