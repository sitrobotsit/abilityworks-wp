<?php
// if (!session_id()) session_start();
// require_once TEMPLATEPATH . '/vendor/autoload.php';

class AbilityWorks
{
  var $templateURL;

  public function __construct()
  {
    $this->templateURL = get_bloginfo('template_url');

    // Theme Support & thumbnail sizes
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['navigation-widgets', 'style', 'script', 'search-form']);
    add_post_type_support('page', 'excerpt');

    // Actions
    add_action('init', [$this, 'init']);
    add_action('wp', [$this, 'wp']);
    add_action('widgets_init', [$this, 'widgets_init']);
    add_action('wp_enqueue_scripts', [$this, 'wp_enqueue_scripts']);
    add_action('wp_head', [$this, 'wp_head']);
    add_action('wp_body_open', [$this, 'wp_body_open']);
    add_action('wp_footer', [$this, 'wp_footer']);

    add_shortcode( 'CABTN', [$this, 'shortcode_button'] );
    add_shortcode( 'CASPACER', [$this, 'shortcode_spacer'] );
    add_shortcode( 'CA_CONTACT_DETAILS', [$this, 'shortcode_contact_details'] );
    add_shortcode( 'FAQ_CAROUSEL', [$this, 'shortcode_faq_carousel'] );
    add_shortcode( 'MORE_LESS', [$this, 'shortcode_more_less'] );
    add_shortcode( 'SHARING_ICONS', [$this, 'shortcode_sharing_icons'] );
    add_shortcode( 'SOCIAL_ICONS', [$this, 'shortcode_social_icons'] );
    add_shortcode( 'ICON_LIST', [$this, 'shortcode_icon_list'] );
    add_shortcode( 'IMAGE_VIDEO', [$this, 'shortcode_image_video'] );

    // Filters
    add_filter('body_class', [$this, 'body_class']);
    add_filter('the_content', [$this, 'fix_shortcodes']);
    add_filter('nav_menu_link_attributes', [$this, 'nav_menu_link_attributes'], 10, 2 );
    add_filter('excerpt_length', [$this, 'excerpt_length'], 999 );
    add_filter('excerpt_more', [$this, 'excerpt_more'] );
    add_filter('wp_nav_menu_args', [$this, 'wp_nav_menu_args'] );

    add_action( 'wp_ajax_nopriv_aw_load_faqs', [$this, 'load_faqs'] );
    add_action( 'wp_ajax_aw_load_faqs', [$this, 'load_faqs'] );
  }

  public function init()
  {
    register_post_type('aw-member', [
      'labels' => [
        'name' => __( 'Members' ),
        'singular_name' => __( 'Member' ),
        'add_new' => __( 'Add New Member' ),
        'add_new_item' => __( 'Add New Member' ),
        'edit_item' => __( 'Edit Member' ),
        'new_item' => __( 'New Member' ),
        'view_item' => __( 'View Member' ),
        'search_items' => __( 'Search Members' ),
        'not_found' => __( 'No members found' ),
        'not_found_in_trash' => __( 'No members found in Trash' ),
      ],
      'public' => true,
      'show_ui' => true,
      'has_archive' => false,
      'menu_position' => 5,
      'rewrite' => ['slug' => 'm'],
      'supports' => [
        'title',
        'editor',
        'excerpt',
        'thumbnail',
      ],
    ]);
    register_taxonomy('aw-member-cat', ['aw-member'], [
      'labels' => [
        'name' => 'Categories',
        'singular_name' => 'Category',
        'search_items' => 'Search Categories',
        'all_items' => 'All Categories',
        'parent_item' => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item' => 'Edit Category',
        'update_item' => 'Update Category',
        'add_new_item' => 'Add New Category',
        'new_item_name' => 'New Category',
        'menu_name' => 'Categories',
      ],
      'public' => false,
      'hierarchical' => true,
      'show_ui' => true,
      'show_in_nav_menus' => false,
      'show_in_quick_edit' => true,
      'show_admin_column' => true,
    ]);
    register_post_type('aw-faq', [
      'labels' => [
        'name' => __( 'FAQs' ),
        'singular_name' => __( 'FAQ' ),
        'add_new' => __( 'Add New FAQ' ),
        'add_new_item' => __( 'Add New FAQ' ),
        'edit_item' => __( 'Edit FAQ' ),
        'new_item' => __( 'New FAQ' ),
        'view_item' => __( 'View FAQ' ),
        'search_items' => __( 'Search FAQs' ),
        'not_found' => __( 'No FAQs found' ),
        'not_found_in_trash' => __( 'No FAQs found in Trash' ),
      ],
      'public' => false,
      'show_ui' => true,
      'has_archive' => false,
      'menu_position' => 5,
      'supports' => [
        'title',
        'editor',
      ],
    ]);
    register_taxonomy('aw-faq-cat', ['aw-faq'], [
      'labels' => [
        'name' => 'Categories',
        'singular_name' => 'Category',
        'search_items' => 'Search Categories',
        'all_items' => 'All Categories',
        'parent_item' => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item' => 'Edit Category',
        'update_item' => 'Update Category',
        'add_new_item' => 'Add New Category',
        'new_item_name' => 'New Category',
        'menu_name' => 'Categories',
      ],
      'public' => false,
      'hierarchical' => true,
      'show_ui' => true,
      'show_in_nav_menus' => false,
      'show_in_quick_edit' => true,
      'show_admin_column' => true,
    ]);
    // register_post_type('aw-comm-story', [
    //   'labels' => [
    //     'name' => __( 'Community Stories' ),
    //     'singular_name' => __( 'Story' ),
    //     'add_new' => __( 'Add New Story' ),
    //     'add_new_item' => __( 'Add New Story' ),
    //     'edit_item' => __( 'Edit Story' ),
    //     'new_item' => __( 'New Story' ),
    //     'view_item' => __( 'View Story' ),
    //     'search_items' => __( 'Search Stories' ),
    //     'not_found' => __( 'No stories found' ),
    //     'not_found_in_trash' => __( 'No stories found in Trash' ),
    //   ],
    //   'public' => true,
    //   'show_ui' => true,
    //   'has_archive' => false,
    //   'menu_position' => 5,
    //   'rewrite' => ['slug' => 'community-stories'],
    //   'supports' => [
    //     'title',
    //     'thumbnail',
    //     'excerpt',
    //     'editor',
    //   ],
    // ]);
    // register_taxonomy('recap-story-tag', ['recap-story'], [
    //   'labels' => [
    //     'name' => 'ReCap Story Tags',
    //     'singular_name' => 'Tag',
    //     'search_items' => 'Search Tags',
    //     'all_items' => 'All Tags',
    //     'parent_item' => 'Parent Tag',
    //     'parent_item_colon' => 'Parent Tag:',
    //     'edit_item' => 'Edit Tag',
    //     'update_item' => 'Update Tag',
    //     'add_new_item' => 'Add New Tag',
    //     'new_item_name' => 'New Tag',
    //     'menu_name' => 'ReCap Story Tags',
    //   ],
    //   'public' => false,
    //   'hierarchical' => false,
    //   'show_ui' => true,
    //   'show_in_nav_menus' => false,
    // ]);
  }

  public function wp()
  {
    global $post;
  }

  public function widgets_init()
  {
    // register menus, sidebars
    register_nav_menu('main-menu', 'Main Menu');
    register_nav_menu('secondary-nav', 'Secondary Navigation');
    register_nav_menu('legal-menu', 'Legal Menu');

    register_sidebar([
      'name' => 'Footer Widgets (4 columns)',
      'id' => 'pre-footer-widgets',
      'before_widget' => '<div class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="title">',
      'after_title' => '</h3>',
    ]);
  }

  public function wp_enqueue_scripts()
  {
    global $current_user;

    $assets_version = get_field('ca_assets_version', 'option');

    wp_enqueue_style('aw-css', $this->templateURL . '/css/style.min.css', array(), $assets_version);
    wp_enqueue_style('aw-editor-style', $this->templateURL . '/editor-style.css', array(), $assets_version);
    wp_enqueue_style('aw', $this->templateURL . '/style.css', array(), $assets_version);
    wp_enqueue_script('aw-js', $this->templateURL . '/js/script.min.js', array(), $assets_version, true);

    $jsObj = array(
      'ajaxurl' => admin_url('admin-ajax.php'),
      'tplurl' => get_bloginfo('template_url'),
    );
    wp_localize_script('aw-js', 'awObj', $jsObj);
  }

  public function body_class( $classes )
  {
    // add custom CSS class to body
    global $post;

    $header_style = get_field('ca_header_style', $post->ID);
    if ( empty($header_style) ) $header_style = 'default';

    if ( !empty($header_style) ) {
      $classes[] = 'header-' . $header_style;
    }

    return $classes;
  }

  public function excerpt_length( $length )
  {
    global $post;
    return $post->post_type=='post' ? 12 : 23;
  }

  public function excerpt_more( $excerpt_more )
  {
    return '&hellip;';
  }

  public function wp_nav_menu_args( $args )
  {
    return array_merge($args, [
      'walker' => new AW_Menu_Walker,
    ]);
  }

  public function fix_shortcodes( $content )
  {
    $array = array (
      '<p>[' => '[',
      ']</p>' => ']',
      ']<br />' => ']'
    );
    $content = strtr($content, $array);

    return $content;
  }

  public function nav_menu_link_attributes( $atts, $item )
  {
    if ( !empty($item->description) ) {
      $atts['data-tippy-content'] = esc_attr( $item->description );
    }
    return $atts;
  }

  public function wp_head()
  {
    global $post;

    the_field('ca_head_scripts', 'option');

    $customCSS = get_field('custom_css', $post->ID);
    if ( empty($customCSS) ) return;

    echo '<style type="text/css">' . "\n";
    echo $customCSS;
    echo "\n" . '</style>' . "\n";
  }

  public function wp_body_open()
  {
    the_field('ca_after_body_scripts', 'option');
  }

  public function wp_footer()
  {
    global $post;

    the_field('ca_foot_scripts', 'option');

    $customJS = get_field('custom_js', $post->ID);
    if ( empty($customJS) ) return;

    echo '<script type="text/javascript">' . "\n";
    echo $customJS;
    echo "\n" . '</script>' . "\n";
  }

  public function shortcode_button( $atts, $content )
  {
    extract(shortcode_atts([
      'class' => '',
      'url' => '#',
      'target' => '',
      'style' => '',
      'onclick' => '',
    ], $atts));

    // if (empty($content))
    //   return '';

    $sTarget = ($target=='_blank') ? ' target="_blank"' : '';
    $sStyle = !empty($style) ? ' style="'.$style.'"' : '';
    $sOnClick = !empty($onclick) ? ' onclick="'.$onclick.'"' : '';

    return '<a class="'.(!empty($class) ? "{$class}" : '').'" href="' . $url . '"' . $sTarget . $sStyle . $sOnClick . '>' .
      do_shortcode( $content ) . '</a>';
  }

  public function shortcode_spacer( $atts )
  {
    extract(shortcode_atts([
      'color' => 'transparent',
      'sm' => '',
      'md' => '',
      'lg' => '',
    ], $atts));

    $sm = (int) $sm;
    $md = (int) $md;
    $lg = (int) $lg;

    return '<div class="ca-spacer"
      data-sm="' . $sm . '" data-md="' . $md . '" data-lg="' . $lg . '"
      style="background: ' . $color . ';"></div>';
  }

  public function shortcode_contact_details( $atts )
  {
    extract(shortcode_atts([
    ], $atts));

    $email = get_field( 'ca_contact_email', 'option' );
    $phone = get_field( 'ca_contact_phone', 'option' );
    $address = get_field( 'ca_contact_address', 'option' );
    $directions_url = get_field( 'ca_contact_directions_url', 'option' );

    $html = '<ul class="contact-details">';
    if ( $email ) {
      $html .= '<li class="mail"><a href="mailto:' . $email . '">' . $email . '</a></li>';
    }
    if ( $phone ) {
      $html .= '<li class="phone"><a href="tel:' . $phone . '">' . $phone . '</a></li>';
    }
    if ( $address ) {
      $html .= '<li class="address">';
      $html .= '<address>' . $address . '</address>';
      if ( $directions_url ) {
        $html .= '<a href="' . $directions_url . '" target="_blank">Get Directions</a>';
      }
      $html .= '</li>';
    }
    $html .= '</ul>';

    return $html;
  }

  public function shortcode_faq_carousel( $atts )
  {
    extract(shortcode_atts([
      'all_url' => ''
    ], $atts));

    ob_start();
    include TEMPLATEPATH . '/templates/shortcode/faq_carousel.php';
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
  }

  public function shortcode_more_less( $atts, $content )
  {
    extract(shortcode_atts([
      'mobile_only' => ''
    ], $atts));

    // $contentLength = strlen($content);
    // $lastOpenP = strrpos($content, '<p>');
    // $firstCloseP = strpos($content, '</p>');
    // if ( $firstCloseP === 0 && $lastOpenP === ($contentLength - 3) ) {
    //   $content = substr($content, 4, $contentLength - 3 - 4 );
    // }
    // elseif ( $firstCloseP === 0 ) {
    //   $content = substr($content, 4, $contentLength - 3 - 4 );
    // }

    return
      '<div class="more-less' . ($mobile_only=='yes' ? ' mob-only' : '') . '">'.
        '<div class="more-less-content">' .
          $content.
        '</div>'.
        '<div class="more-less-link"><a href="javascript:;">READ MORE</a></div>' .
      '</div><!-- .more-less -->'
    ;
  }

  public function shortcode_sharing_icons( $atts )
  {
    extract(shortcode_atts([
    ], $atts));

    return '<div class="sharing" style="padding-top: 25px;">' .
      '<span class="lb">SHARE</span>' .
      do_shortcode('[addtoany]') .
    '</div>';
  }

  public function shortcode_social_icons( $atts )
  {
    extract(shortcode_atts([
    ], $atts));

    return '<div class="social-icons">' . AW_Helpers::SocialIcons( false ) . '</div>';
  }

  public function shortcode_icon_list( $atts )
  {
    extract(shortcode_atts([
      'id' => ''
    ], $atts));

    $id = intval($id);
    if ( !$id ) return '';

    $html = '';
    if ( have_rows('icon_list_items', $id) ) {
      $html .= '<div class="ico-list">';
      while ( have_rows('icon_list_items', $id) ) {
        the_row();
        $html .= '<div class="ico-list-item">';
        if ( $icon = get_sub_field('icon') ) {
          $html .= '<img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '" class="ico">';
        }
        $html .= get_sub_field('text');
        $html .= '</div>';
      }
      $html .= '</div>';
    }

    return $html;
  }

  public function shortcode_image_video( $atts )
  {
    extract(shortcode_atts([
      'image_url' => '',
      'video_id' => '',
      'source' => 'youtube',
    ], $atts));

    if ( empty($image_url) || empty($video_id) ) return '';

    if ( $source == 'vimeo' ) {
      $videoSrc = 'https://player.vimeo.com/video/' . $video_id . '?autoplay=1';
    }
    else {
      $videoSrc = 'https://www.youtube.com/embed/' . $video_id . '?autoplay=1';
    }

    $html = '<a href="javascript:;" class="image-video-play" rel="' . $videoSrc . '"><img src="' . $image_url . '"></a>';

    return $html;
  }

  public function load_faqs()
  {
    global $wp_query;
    $args = [
      'post_type' => 'aw-faq',
      'posts_per_page' => 6,
      'orderby' => 'menu_order',
      'order' => 'DESC',
    ];
    $pageno = isset($_GET['pageno']) ? intval($_GET['pageno']) : 1;
    $args['paged'] = $pageno;

    $catid = isset($_GET['catid']) ? intval($_GET['catid']) : 0;
    if ( $catid ) {
      $args['tax_query'] = [
        [
          'taxonomy' => 'aw-faq-cat',
          'terms' => $catid
        ]
      ];
    }

    query_posts( $args );

    ob_start();
    $counter = 0;
    while ( have_posts() ) {
      the_post();
      $counter++;
      if ( $counter%2 ) {
        get_template_part( 'templates/loop', 'faq' );
      }
    }
    $leftCol = ob_get_contents();
    ob_end_clean();

    ob_start();
    $counter = 0;
    while ( have_posts() ) {
      the_post();
      $counter++;
      if ( $counter%2 == 0 ) {
        get_template_part( 'templates/loop', 'faq' );
      }
    }
    $rightCol = ob_get_contents();
    ob_end_clean();

    $loader = '';
    if ( $pageno < $wp_query->max_num_pages ) {
      $loader = '<a href="javascript:;" rel="' . ($pageno + 1) . '" class="btn btn-outline-dark btn-more-faqs">LOAD MORE</a>';
    }

    echo json_encode([
      'left' => $leftCol,
      'right' => $rightCol,
      'loader' => $loader,
    ]);
    exit;
  }
}

if ( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title'  => 'AW Settings',
    'menu_title'  => 'AW Settings',
    'menu_slug'   => 'ca-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
}
// require_once TEMPLATEPATH . '/inc/acf/options.php';
// require_once TEMPLATEPATH . '/inc/acf/tpl-sections.php';
// require_once TEMPLATEPATH . '/inc/acf/post.php';
// require_once TEMPLATEPATH . '/inc/acf/aw-resource-type.php';
// require_once TEMPLATEPATH . '/inc/acf/aw-comm-activity.php';
// require_once TEMPLATEPATH . '/inc/acf/aw-comm-story.php';
// require_once TEMPLATEPATH . '/inc/acf/aw-video.php';
// require_once TEMPLATEPATH . '/inc/acf/aw-icon-list.php';
// require_once TEMPLATEPATH . '/inc/acf/page.php';

// if ($_SERVER['SERVER_ADDR'] != '127.0.0.1') {
//   define('ACF_LITE', true);
// }

$AbilityWorks = new AbilityWorks();
require_once TEMPLATEPATH . '/inc/AW_Admin.php';
require_once TEMPLATEPATH . '/inc/AW_Helpers.php';
require_once TEMPLATEPATH . '/inc/AW_Menu_Walker.php';
