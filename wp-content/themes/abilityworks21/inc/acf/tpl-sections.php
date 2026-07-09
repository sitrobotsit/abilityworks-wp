<?php

if( function_exists('acf_add_local_field_group') ):
  acf_add_local_field_group(array(
    'key' => 'group_5f0559c795550',
    'title' => 'Sections',
    'fields' => array(
      array(
        'key' => 'field_5f055a0baff07',
        'label' => 'Sections',
        'name' => 'ca_sections',
        'type' => 'flexible_content',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'layouts' => array(
          'section_layout_welcome'              => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/welcome.php'),
          'section_layout_banner-intro'         => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/banner-intro.php'),
          'section_layout_title-content'        => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/title-content.php'),
          'section_layout_title-content-2'      => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/title-content-2.php'),
          'section_layout_content'              => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/content.php'),
          'section_layout_content-content'      => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/content-content.php'),
          'section_layout_content-carousel'     => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/content-carousel.php'),
          'section_layout_carousel-content'     => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/carousel-content.php'),
          'section_layout_image-carousel'       => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/image-carousel.php'),
          'section_layout_video-carousel'       => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/video-carousel.php'),
          'section_layout_image-content-carousel'   => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/image-content-carousel.php'),
          'section_layout_steps-carousel'       => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/steps-carousel.php'),
          'section_layout_highlighted-video'    => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/highlighted-video.php'),
          'section_layout_list-videos'          => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/list-videos.php'),
          'section_layout_list-content-buttons' => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/list-content-buttons.php'),
          'section_layout_highlighted-toolkit'  => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/highlighted-toolkit.php'),
          'section_layout_list-toolkits'        => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/list-toolkits.php'),
          'section_layout_highlighted-story'    => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/highlighted-story.php'),
          'section_layout_list-stories'         => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/list-stories.php'),
          'section_layout_resources'            => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/resources.php'),
          'section_layout_highlights'           => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/highlights.php'),
          'section_layout_comm-activities'      => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/comm-activities.php'),
          'section_layout_partners'             => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/partners.php'),
          'section_layout_accordion'            => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/accordion.php'),
          'section_layout_testimonial'          => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/testimonial.php'),
          'section_layout_cta'                  => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/cta.php'),
          'section_layout_phase-links'          => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/phase-links.php'),
          'section_layout_faqs'                 => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/faqs.php'),
          'section_layout_anchor'               => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/anchor.php'),
          'section_layout_spacer'               => require(TEMPLATEPATH . '/inc/acf/tpl-sections-layouts/spacer.php'),
        )
      )
    ),
    'location' => array(
      array(
        array(
          'param' => 'page_template',
          'operator' => '==',
          'value' => 'tpl-sections.php',
        ),
      ),
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'ca-section',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => array(
      0 => 'the_content',
    ),
    'active' => 1,
    'description' => '',
  ));
endif;
