<?php
require 'initapp.php';
$self='payment-gateway-manage.php';
permission::permitted($self);
$cmd=_get('_pgid');

$pg=ORM::for_table('payment_gateways')->find_one($cmd);

$pg_name=$pg['name'];

require ("views/$theme/payment-gateway-manage.tpl.php");
?>