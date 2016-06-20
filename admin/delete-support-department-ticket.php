<?php
require 'initapp.php';
$id= _get('_stid');
$self="support-ticket-manage.php?_stid=$id";

if ($xstage=='Demo'){
conf($self,'e','Deleting Support Tickets is disabled in the demo mode');
}

$cquery=ORM::for_table('tickets')->find_one($id);
$cquery->delete();
 conf('all-support-tickets.php','s','Support Tickets Deleted Successfully');

 ?>

