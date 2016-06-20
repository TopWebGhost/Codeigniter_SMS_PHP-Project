<?php
if (!defined("_APP_RUN"))
die('Direct access to this location is not allowed.');


$d= ORM::for_table('payment_gateways')->where('name', 'paypal')->find_one();

$paypalemail = $d['value'];

$currency = appconfig('defaultcurrency');
$sysUrl= appconfig('sysUrl');



require('paypal.class.php');

$paypal = new Paypal;
$paypal->param('business', $paypalemail);
$paypal->param('return', $sysUrl.'/client/paypal-confirmation.php?_status=success');
$paypal->param('cancel_return', $sysUrl.'/client/paypal-confirmation.php?_status=cancel');
$paypal->param('notify_url', $sysUrl.'/client/paypal-confirmation.php?_status=listener');
$paypal->param('item_name_1', $item);
$paypal->param('amount_1', $amount);
$paypal->param('item_number_1', $invoiceid);
$paypal->param('quantity_1', '1');
$paypal->param('upload', 1);
$paypal->param('cmd', '_cart');
$paypal->param('txn_type', 'cart');
$paypal->param('num_cart_items', 1);
$paypal->param('payment_gross', $amount);
$paypal->param('currency_code', $currency);
$paypal->gw_submit();

?>
