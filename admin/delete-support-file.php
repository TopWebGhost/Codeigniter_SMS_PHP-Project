<?php
require 'initapp.php';
$cmd=_get('_sfid');

$query=ORM::for_table('ticket_file')->find_one($cmd);
$prid=$query['ticid'];

$self='support-ticket-manage.php?_stid='.$prid;


if (isset($_POST['delete'])){

    $query->delete();

       conf($self,'s','File Deleted Successfully');
    }
    else{
         conf($self,'e','Please Submit your Information Again');
    }

?>