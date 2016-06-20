<?php 
require 'initapp.php';
$self='view-email.php';


$cmd=_get('_eid');
$equery=ORM::for_table('email_logs')->find_one($cmd);
$subject=$equery['subject'];
$message=$equery['message'];
$date=$equery['date'];
$clid=$equery['userid'];
$email=$equery['email'];

$clquery=ORM::for_table('accounts')->find_one($clid);
$clname=$clquery['name'];

require ("views/$theme/view-email.tpl.php");


?>