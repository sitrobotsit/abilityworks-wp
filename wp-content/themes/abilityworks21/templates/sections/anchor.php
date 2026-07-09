<?php
$anchorName = get_sub_field('anchor_name');
if ( !empty($anchorName) ) {
  echo '<a name="' . $anchorName . '" id="' . $anchorName . '"></a>';
}
