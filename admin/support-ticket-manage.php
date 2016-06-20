<?php
require 'initapp.php';
$self='support-ticket-manage.php';
permission::permitted($self);

$cmd=_get('_stid');
$stm=ORM::for_table('tickets')->find_one($cmd);
$sdid=$stm['did'];
$subject=$stm['subject'];
$status=$stm['status'];
$clname=$stm['name'];
$date=$stm['date'];
$clientid=$stm['userid'];
$ticmessage=$stm['message'];
$createdby=$stm['admin'];
$email=$stm['email'];
$closed_by=$stm['closed_by'];

$sdpt = ORM::for_table('supportdepartments')->find_one($sdid);

$dept=$sdpt['name'];



require ("views/$theme/support-ticket-manage.tpl.php");

?>