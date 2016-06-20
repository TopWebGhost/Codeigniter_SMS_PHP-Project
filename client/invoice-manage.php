<?php
require 'initapp.php';
$self='invoice-manage.php';

$inid=_get('_inid');

$inv=ORM::for_table('invoices')->find_one($inid);
$clid=$inv['userid'];

$cl=ORM::for_table('accounts')->find_one($clid);

$date=$inv['created'];
$idate=date("F j, Y", strtotime($date));

$pdate=$inv['datepaid'];
$paiddate=date("F j, Y", strtotime($pdate));

$status=$inv['status'];


require ("views/$theme/invoice-manage.tpl.php");
?>