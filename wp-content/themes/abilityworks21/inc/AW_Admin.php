<?php
class AW_Admin
{
  var $imageSizes = [
    'aw-220x220' => [
      'label' => 'Fixed size 220x220 px',
      'width' => 220,
      'height' => 220,
      'crop' => true,
    ],
  ];

  public function __construct()
  {
    foreach ($this->imageSizes as $type=>$details) {
      add_image_size($type, $details['width'], $details['height'], $details['crop']);
    }

    /* ACTIONS */
    add_action('login_head', [$this, 'login_head']);
    add_action('wp_before_admin_bar_render', [$this, 'wp_before_admin_bar_render']);
    add_action('admin_head', [$this, 'admin_head']);
    add_action('get_header', [$this, 'remove_admin_login_header']);
    add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
    add_action('restrict_manage_posts', [$this, 'restrict_manage_posts']);
    add_action('pre_get_posts', [$this, 'pre_get_posts']);

    /* FILTERS */
    add_filter('login_headerurl', [$this, 'login_headerurl']);
    add_filter('login_headertitle', [$this, 'login_headertitle']);
    add_filter('acf/fields/google_map/api', [$this, 'acf_google_map_api']);
    add_filter('site_transient_update_plugins', [$this, 'filter_plugin_updates']);

    add_filter('manage_posts_columns' , [$this, 'manage_posts_columns'] );
    add_action('manage_posts_custom_column', [$this, 'manage_posts_custom_column'], 10, 2);

    add_filter('manage_edit-post_columns', [$this, 'manage_post_columns']);

    add_filter('tiny_mce_before_init', [$this, 'tiny_mce_before_init']);

    // if ( class_exists( 'WP_CLI' ) ) {
    //   WP_CLI::add_command('aw:daily_update_exhibitions', [$this, 'daily_update_exhibitions'], [
    //     'shortdesc' => 'Daily update exhibitions category'
    //   ]);
    // }
  }

  public function tiny_mce_before_init($initArray)
  {
    $initArray['fontsize_formats'] = '9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 22px 24px';
    return $initArray;
  }

  public function admin_head()
  {
    ?>
    <style type="text/css">
    .acf-fc-layout-handle i.foldicon {
      display: none;
    }
    table.acf_input tbody tr td.label {
      width: 15% !important;
    }
    #featured_image {width: 70px;}
    </style>
    <?php
  }

  public function login_head()
  {
    $logo = get_field( 'mf_logo_color', 'option' );
    ?>
    <style type="text/css">
    html {background:#fff;}
    .login {background:#fff;height:auto !important;}
    .login h1 a {
      <?php if ( $logo ) : ?>
        height: 60px;
        width: 220px;
        background-image:url(<?php echo $logo['url']; ?>) !important;
      <?php endif; ?>
      background-size: contain !important;
      background-position: center !important;
    }
    </style>
    <?php
  }

  public function remove_admin_login_header()
  {
    remove_action('wp_head', '_admin_bar_bump_cb');
  }

  public function login_headerurl()
  {
    return get_bloginfo('siteurl');
  }

  public function login_headertitle()
  {
    return get_bloginfo('blogname');
  }

  public function wp_before_admin_bar_render()
  {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
  }

  public function admin_enqueue_scripts()
  {
    // global $hook_suffix;
    // $assets_version = '20.06.15';

    // $templateURL = get_bloginfo('template_url');

    // if ( $hook_suffix == 'toplevel_page_aw' ) {
    //   wp_enqueue_style('aw-css', $templateURL . '/css/admin/style.min.css', array(), $assets_version);
    //   wp_enqueue_script('aw-js', $templateURL . '/js/admin/script.min.js', array(), $assets_version, true);
    // }

    // $jsObj = array(
    //   'baseurl' => home_url(),
    //   'apiurl' => home_url('wp-json/aw/v1'),
    //   'ajaxurl' => admin_url('admin-ajax.php'),
    //   'tplurl' => get_bloginfo('template_url'),
    // );
    // wp_localize_script('aw-js', 'awObj', $jsObj);
  }

  public function restrict_manage_posts()
  {
    global $current_screen, $post_type, $pagenow;
    if ( $pagenow == 'edit.php' && in_array($post_type, ['aw-exhibition']) ) {
      $catId = isset($_REQUEST['catid']) ? trim($_REQUEST['catid']) : '';
      $cats = get_posts([
        'post_type' => 'aw-exhibition-cat',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
      ]);
      ?>
        <select name="catid">
          <option value="">All categories</option>
          <?php foreach ($cats as $cat) : ?>
            <option value="<?php echo $cat->ID;?>"<?php echo $cat->ID==$catId ? ' selected' : ''?>>
              <?php echo $cat->post_title;?>
            </option>
          <?php endforeach; ?>
        </select>
      <?php
    }
  }

  public function pre_get_posts($query)
  {
    global $post_type, $pagenow;
    if ( !is_admin() ) return;

    if ( $pagenow == 'edit.php' && in_array($post_type, ['aw-exhibition']) && $query->query['post_type']=='aw-exhibition' ) {
      $catId = isset($_REQUEST['catid']) ? trim($_REQUEST['catid']) : '';
      if ( !empty($catId) ) {
        $query->query_vars['meta_query'][] = [
          'relation' => 'AND',
          [
            'key' => 'exhibition_category',
            'value' => $catId,
          ]
        ];
      }
    }
  }

  public function acf_google_map_api($api)
  {
    $api['key'] = '';
    return $api;
  }

  public function filter_plugin_updates($value)
  {
    unset( $value->response['advanced-custom-fields-pro/acf.php'] );
    return $value;
  }

  public function manage_posts_columns($columns)
  {
    foreach ($columns as $key => $value) {
      $newCols[$key] = $value;
      if ( $key == 'cb' ) {
        $newCols['featured_image'] = 'Image';
      }
    }
    return $newCols;
  }

  public function manage_post_columns($columns)
  {
    return $columns;
  }

  public function manage_posts_custom_column($column, $postId)
  {
    global $post;
    switch ($column)
    {
      case 'featured_image':
        if (has_post_thumbnail()) {
          echo '<a href="' . admin_url("post.php?post={$postId}&action=edit") . '">';
          echo get_the_post_thumbnail( $postId, 'thumbnail', ['style' => 'height: auto !important;width: 60px;'] );
          echo '</a>';
        }
        break;
      case 'post_id':
        echo $post->ID;
        break;
      default:
        break;
    }
  }
}

new AW_Admin();
