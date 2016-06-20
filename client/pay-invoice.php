<?php
require 'initapp.php';
$iid = _get('_iid');
$gateway= _post('gateway');

if (!$gateway==''){
    $d = ORM::for_table('invoices')->find_one($iid);
    $item = "Invoice Payment From Client ID:". $d['userid'];
    $amount = $d['total'];
    $item_id = 'Invoice Payment';
    $invoiceid = $iid;
    $processFile = "../lib/payment_gateway/$gateway/processor.php";

    if (file_exists($processFile)) {
        require($processFile);
        return;
    } else {
        conf('invoice-manage.php?_inid='.$iid,'e','The Payment Gateway Not Found');
    }
}

?>