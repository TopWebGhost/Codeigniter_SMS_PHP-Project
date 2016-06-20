<?php
require 'initapp.php';
$cmd=_get('_stid');
$self="support-ticket-manage.php?_stid=$cmd";
$tid=_post('department');

$stm=ORM::for_table('tickets')->find_one($cmd);
$stm->did=$tid;
$stm->save();
        
 conf($self,'s','Department Change Successfully');  

?>