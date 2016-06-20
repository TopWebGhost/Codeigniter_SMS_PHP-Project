<?php
require 'initapp.php';
$self='invoice-manage.php';

$status= _get('_status');

if ($status=='Paid') {
    $inid = _get('_id');
    $paidquery = ORM::for_table('invoices')->find_one($inid);
    $paidquery->status='Paid';
    $paidquery->save();
    conf($self.'?_inid='.$inid,'s','Invoice successfully paid');
}
elseif ($status=='Cancelled') {
    $inid = _get('_id');
    $paidquery = ORM::for_table('invoices')->find_one($inid);
    $paidquery->status='Cancelled';
    $paidquery->save();
    conf($self.'?_inid='.$inid,'s','Invoice successfully Cancelled');
    
}
elseif ($status=='Unpaid') {
    $inid = _get('_id');
    $paidquery = ORM::for_table('invoices')->find_one($inid);
    $paidquery->status='Unpaid';
    $paidquery->save();
    conf($self.'?_inid='.$inid,'s','Invoice successfully mark Unpaid');
}

elseif ($status=='Delete') {
    $inid = _get('_id');
    if ($xstage=='Demo'){
       conf($self.'?_inid='.$inid,'e','Delete Invoice is disabled in the demo mode');
}
    $paidquery = ORM::for_table('invoices')->find_one($inid);
    $paidquery->delete();

    $e= ORM::for_table('invoiceitems')->where_equal('invoiceid', $inid)->delete_many();

    conf('all-invoices.php','s','Invoice successfully Deleted');
    
}
else{
        conf($self.'?_inid='.$inid,'e','No Action Performed');
}

?>