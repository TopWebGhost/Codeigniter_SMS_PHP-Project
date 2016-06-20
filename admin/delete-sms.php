<?php
require 'initapp.php';
$id= _get('_sid');

if ($xstage=='Demo'){
conf("view-sms.php?_sid=$id",'e','Deleting SMS is disabled in the demo mode');
}

$cquery=ORM::for_table('sms_history')->find_one($id);
$cquery->delete();
 conf('sms-history.php','s','SMS Deleted Successfully');

 ?>

