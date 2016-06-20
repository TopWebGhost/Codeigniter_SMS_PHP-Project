<?php
require 'initapp.php';
$id= _get('_pid');

if ($xstage=='Demo'){
conf("sms-price-plan.php",'e','Deleting Price Plan is disabled in the demo mode');
}

$pquery=ORM::for_table('sms_price_plan')->find_one($id);
$pquery->delete();
 conf('sms-price-plan.php','s','Price Plan Deleted Successfully');

 ?>

