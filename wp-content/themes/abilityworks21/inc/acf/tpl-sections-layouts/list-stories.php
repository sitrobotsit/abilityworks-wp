<?php
return array(
  'key' => 'layout_list-stories',
  'name' => 'list-stories',
  'label' => 'List Stories',
  'display' => 'block',
  'sub_fields' => array(
    array(
      'key' => 'field_5f1a5a8c8a712',
      'label' => 'Type',
      'name' => 'post_type',
      'type' => 'radio',
      'instructions' => '',
      'required' => 1,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array(
        'pxa-comm-story' => 'Community Stories',
        'recap-story' => 'ReCap Stories',
      ),
      'allow_null' => 0,
      'other_choice' => 0,
      'default_value' => 'pxa-comm-story',
      'layout' => 'horizontal',
      'return_format' => 'value',
      'save_other_choice' => 0,
    ),
  ),
  'min' => '',
  'max' => '',
);
