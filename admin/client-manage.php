<?php 
require 'initapp.php';
$self='client-manage.php';
permission::permitted($self);

$cmd=_get('_clid');
$cquery=ORM::for_table('accounts')->find_one($cmd);
$website=$cquery['website'];
$email_limit=$cquery['email_limit'];
$sms_limit=$cquery['sms_limit'];


$now=date('Y-m-d');
$timestamp = time()-86400;
$wdate = strtotime("+7 day", $timestamp);
$csymbol=appconfig('defaultcurrencysymbol');

$tquery = ORM::for_table('tickets')->where('userid',$cmd)->order_by_desc('date')->limit(7)->find_many();

$total_email=ORM::for_table('email_logs')->where('userid',$cmd)->find_many()->count();
$total_sms=ORM::for_table('sms_history')->where('userid',$cmd)->find_many()->count();
$total_ticket=ORM::for_table('tickets')->where('userid',$cmd)->find_many()->count();
$closed_ticket=ORM::for_table('tickets')->where('userid',$cmd)->where('status','Closed')->find_many()->count();

$sms_tr=ORM::for_table('sms_transaction')->where('userid',$cmd)->find_many();
$email_tr=ORM::for_table('email_transaction')->where('userid',$cmd)->find_many();

$invoice=ORM::for_table('invoices')->where('userid',$cmd)->find_many();



require ("views/$theme/client-manage.tpl.php");


?>