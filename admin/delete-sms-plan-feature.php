<?php
require 'initapp.php';
$id= _get('_fid');

$plquery=ORM::for_table('sms_plan_feature')->find_one($id);
$plan_name=$plquery['pid'];

if ($xstage=='Demo'){
conf("view-price-plan-feature.php?_pid=$plan_name",'e','Deleting SMS Plan Feature is disabled in the demo mode');
}

$plquery->delete();

 conf("view-price-plan-feature.php?_pid=$plan_name",'s','SMS Plan Feature Deleted Successfully');

 ?>

