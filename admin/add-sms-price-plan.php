<?php
require 'initapp.php';
$self='add-sms-price-plan.php';
permission::permitted($self);
require ("views/$theme/add-sms-price-plan.tpl.php");

?>