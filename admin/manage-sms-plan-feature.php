<?php
require 'initapp.php';
$self='manage-sms-plan-feature.php';
permission::permitted($self);
$fid=_get('_fid');

$sppn=ORM::for_table('sms_plan_feature')->find_one($fid);

$plan_name=$sppn['pid'];
$fname=$sppn['fname'];
$fvalue=$sppn['fvalue'];
$status=$sppn['status'];

require ("views/$theme/manage-sms-plan-feature.tpl.php");
?>