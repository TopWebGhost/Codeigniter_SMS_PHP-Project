<?php
require 'initapp.php';
$self='view-price-plan-feature.php';

$pid=_get('_pid');

$plan=ORM::for_table('sms_price_plan')->find_one($pid);
$plan_name=$plan['plan_name'];
$popular=$plan['popular'];
$price=$plan['price'];



require ("views/$theme/view-price-plan-feature.tpl.php");
?>