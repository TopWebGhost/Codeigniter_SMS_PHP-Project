<?php
require 'initapp.php';
$self='payment-gateways.php';
permission::permitted($self);
require ("views/$theme/payment-gateways.tpl.php");
?>