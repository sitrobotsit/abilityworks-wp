<?php
return array(
  'key' => 'layout_highlighted-story',
  'name' => 'highlighted-story',
  'label' => 'Highlighted Story',
  'display' => 'block',
  'sub_fields' => array(
    array(
      'key' => 'field_5ff52a8a1a411',
      'label' => 'Community Story',
      'name' => 'comm_story',
      'type' => 'post_object',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'post_type' => array(
        0 => 'pxa-comm-story',
      ),
      'taxonomy' => '',
      'allow_null' => 0,
      'multiple' => 0,
      'return_format' => 'object',
      'ui' => 1,
    ),
  ),
  'min' => '',
  'max' => '',
);
