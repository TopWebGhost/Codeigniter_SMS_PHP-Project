<?php
require 'initapp.php';
$cmd=_get('_stid');
$self="support-ticket-manage.php?_stid=$cmd";
$status=_post('status');

$d=ORM::for_table('admins')->find_one($aid);
$closed_by=$d['fname'].' '.$d['lname'];

$stm=ORM::for_table('tickets')->find_one($cmd);
$stm->closed_by=$closed_by;
$stm->status=$status;
$stm->save();
        
 conf($self,'s','Status Change Successfully');  

?>