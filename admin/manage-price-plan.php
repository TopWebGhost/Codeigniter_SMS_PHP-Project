<?php
require 'initapp.php';
$self='manage-price-plan.php';
permission::permitted($self);
$pid=_get('_pid');

$sppn=ORM::for_table('sms_price_plan')->find_one($pid);

$plan_name=$sppn['plan_name'];
$status=$sppn['status'];
$popular=$sppn['popular'];
$price=$sppn['price'];

require ("views/$theme/manage-price-plan.tpl.php");
?>