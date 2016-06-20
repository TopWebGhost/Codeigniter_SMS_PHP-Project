<?php
if (!defined("_APP_RUN"))
die('Direct access to this location is not allowed.');
//
$d= ORM::for_table('payment_gateways')->where('name', 'Stripe')->find_one();

$pkey = $d['value'];
$skey = $d['extra_value'];

$currency = appconfig('defaultcurrency');
$sysUrl= appconfig('sysUrl');

$stripeamount = $amount * 100;

require ("views/$theme/stripe.tpl.php");
exit
?>
