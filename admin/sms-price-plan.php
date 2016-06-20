<?php
require 'initapp.php';
$self='sms-price-plan.php';
permission::permitted($self);
require ("views/$theme/sms-price-plan.tpl.php");
?>