<?php 
require 'initapp.php';
$self='view-sms.php';
permission::permitted($self);

$cmd=_get('_sid');
$squery=ORM::for_table('sms_history')->find_one($cmd);
$sender_raw=$squery['sender'];
$sender=str_replace('+',' ',$sender_raw);
$receiver=$squery['receiver'];
$amount=$squery['amount'];
$sms_raw=$squery['sms'];
$sms=str_replace('+',' ',$sms_raw);
$report=$squery['report'];
$date=$squery['reqlogtime'];
$ip=$squery['ip'];

require ("views/$theme/view-sms.tpl.php");


?>