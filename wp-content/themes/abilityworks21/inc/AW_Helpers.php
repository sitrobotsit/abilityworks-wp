<?php

class AW_Helpers
{
  public static function SocialIcons( $echo = true )
  {
    $html = '';
    while ( have_rows('ca_socials', 'option') ) {
      the_row();

      $name = get_sub_field('name');
      $url = get_sub_field('url');

      $html .= '<a target="_blank" href="' . $url . '" class="icon-' . $name . '"></a>';
    }

    if ( $echo ) {
      echo $html;
      return;
    }
    return $html;
  }

  public static function SectionAttrs( $name, $extraClasses='', $setStyles=true )
  {
    global $sectionCounter;

    $elmId = $name . '-' . $sectionCounter;

    $aClasses = [ 'st-' . $name ];
    if ( $sectionCounter == 1 ) {
      $aClasses[] = 'first-section';
    }
    if ( !empty($extraClasses) ) {
      $aClasses[] = $extraClasses;
    }

    $aStyles = [];

    if ( $setStyles ) {
      $bgColor = get_sub_field('bg_color');
      if ( !empty($bgColor) ) {
        $aStyles[] = 'background-color:' . $bgColor;
      }
    }

    echo 'class="' . implode(' ', $aClasses) . '"' .
      ' id="' . $elmId . '"' .
      ' data-index="' . $sectionCounter . '"' .
      (sizeof($aStyles) ? ' style="' . implode(';', $aStyles) . '"' : '')
    ;
  }

  public static function SectionStyles( $name, $index, $atts = [] )
  {
    $selector = ".st-{$name}[data-index='{$index}']";
    echo '<style type="text/css">';
    foreach ($atts as $breakpoint => $styles) {
      if ( $breakpoint == 'tablet' ) {
        echo '@media(min-width:768px){';
      }
      elseif ( $breakpoint == 'desktop' ) {
        echo '@media(min-width:992px){';
      }
      elseif ( $breakpoint == 'large' ) {
        echo '@media(min-width:1500px){';
      }
      if ( sizeof($styles) > 0 ) {
        echo $selector . '{';
          foreach ( $styles as $rule => $value ) {
            echo $rule . ':' . $value . ';';
          }
        echo '}';
      }
      if ( in_array($breakpoint, ['tablet', 'desktop', 'large']) ) {
        echo '}';
      }
    }
    echo '</style>';
  }

  public static function InstagramPosts( $pics_count = 8 )
  {
    if ( !class_exists('feedthemsocial\FTS_Instagram_Feed') ) return false;

    $instagram_id = get_option( 'fts_instagram_custom_id', '' );
    $access_token = get_option( 'fts_instagram_custom_api_token', '' );
    if ( empty($instagram_id) || empty($access_token) ) return false;

    $FTS_Instagram_Feed = new feedthemsocial\FTS_Instagram_Feed;

    $basic_cache = 'instagram_basic_cache' . $instagram_id . '_num' . $pics_count . '';
    $instagram_data_array['data'] = 'https://graph.instagram.com/' . $instagram_id . '/media?limit=' . $pics_count . '&access_token=' . $access_token;

    if ( false === $FTS_Instagram_Feed->fts_check_feed_cache_exists( $basic_cache ) ) {
      $instagram_basic_response = $FTS_Instagram_Feed->fts_get_feed_json( $instagram_data_array );

      $instagram_basic = json_decode( $instagram_basic_response['data'] );

      $instagram_basic_output = (object) [ 'data' => [] ];
      if ( is_array($instagram_basic->data) ) {
        foreach ( $instagram_basic->data as $media ) {
          $media_id = $media->id;
          $instagram_basic_data_array['data'] = 'https://graph.instagram.com/' . $media_id . '?fields=caption,id,media_url,media_type,permalink,thumbnail_url,timestamp,username,children{media_url}&access_token=' . $access_token;
          $instagram_basic_media_response = $FTS_Instagram_Feed->fts_get_feed_json( $instagram_basic_data_array );
          $instagram_basic_media = json_decode( $instagram_basic_media_response['data'] );
          $instagram_basic_output->data[] = $instagram_basic_media;
        }
      }

      $insta_data = (object) array_merge( (array) $instagram_basic, (array) $instagram_basic_output );
      $FTS_Instagram_Feed->fts_create_feed_cache( $basic_cache, $insta_data );
    }
    else {
      $insta_data = $FTS_Instagram_Feed->fts_get_feed_cache( $basic_cache );
    }

    return isset($insta_data->data) ? $insta_data->data : false;
  }

  public static function FacebookPosts( $post_counts = 6 )
  {
    if ( !class_exists('feedthemsocial\FTS_Facebook_Feed') ) return false;

    $fb_id = get_option( 'fts_facebook_custom_api_token_user_id', '' );
    $access_token = get_option( 'fts_facebook_custom_api_token', '' );

    if ( empty($fb_id) || empty($access_token) ) return false;

    $fb_shortcode = [
      'id' => $fb_id,
      'access_token' => $access_token,
      'type' => 'page',
      'posts_displayed' => 'page_only',
      'posts' => $post_counts,
    ];

    $FTS_Facebook_Feed = new feedthemsocial\FTS_Facebook_Feed;

    $response2 = $FTS_Facebook_Feed->get_facebook_feed_response( $fb_shortcode, '', $access_token, '' );
    $feed_data_check = json_decode( $response2['feed_data'] );

    return isset($feed_data_check->data) ? $feed_data_check->data : false;
  }

  public static function SharingHTML()
  {
    ?>
    <div class="sharing">
      <span class="lb">SHARE</span>
      <?php echo do_shortcode('[addtoany]'); ?>
    </div>
    <?php
  }

  public static function GetPostIDsByCategories( $cats = [] )
  {
    global $wpdb;

    $sWhere = '';
    if ( sizeof($cats) ) {
      $sWhere = " AND t.term_id IN (" . implode(',', $cats) . ")";
    }

    $query = "
      SELECT p.ID
      FROM wp_posts p
      JOIN wp_term_relationships tr ON tr.object_id = p.ID
      JOIN wp_term_taxonomy tt ON tt.term_taxonomy_id = tr.term_taxonomy_id AND tt.taxonomy = 'category'
      JOIN wp_terms t ON t.term_id = tt.term_id
      WHERE p.post_status = 'publish' AND p.post_type = 'post'
      {$sWhere}
      ORDER BY t.term_order ASC, p.post_title ASC
    ";

    $aIDs = [];
    $rs = $wpdb->get_results( $query );
    foreach ( $rs as $row ) {
      $aIDs[] = $row->ID;
    }

    return array_unique($aIDs);
  }

  public static function GetVideoSrc( $string = '' )
  {
    preg_match('/src="(.+?)"/', $string, $matches);
    $videoSrc = isset($matches[1]) ? $matches[1] : '';
    // if ( strpos($videoSrc, 'youtube') !== false ) {
    // }
    $videoSrc .= '&autoplay=1';
    return $videoSrc;
  }
}
