<?php
require 'initapp.php';
$self='add-price-plan-feature.php';
permission::permitted($self);

$pid=_get('_pid');
$pfquery=ORM::for_table('sms_price_plan')->find_one($pid);
$plan_find=$pfquery['plan_name'];

require ("views/$theme/add-price-plan-feature.tpl.php");
?>