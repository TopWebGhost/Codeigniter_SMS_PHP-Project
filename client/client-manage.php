<?php 
require 'initapp.php';
$self='client-manage.php';

$cmd=_get('_clid');
$cquery=ORM::for_table('accounts')->where('parent',$cid)->find_one($cmd);
if($cquery==false){
    conf('all-clients.php','e','There have no Client with this ID');
}

$website=$cquery['website'];
$email_limit=$cquery['email_limit'];
$sms_limit=$cquery['sms_limit'];

$now=date('Y-m-d');
$timestamp = time()-86400;
$wdate = strtotime("+7 day", $timestamp);

$total_email=ORM::for_table('email_logs')->where('userid',$cmd)->find_many()->count();
$total_sms=ORM::for_table('sms_history')->where('userid',$cmd)->find_many()->count();

$sms_tr=ORM::for_table('sms_transaction')->where('userid',$cmd)->find_many();
$email_tr=ORM::for_table('email_transaction')->where('userid',$cmd)->find_many();


require ("views/$theme/client-manage.tpl.php");


?>