<?php
require 'initapp.php';
$id= _get('_eid');

if ($xstage=='Demo'){
conf("view-email.php?_eid=$id",'e','Deleting Email is disabled in the demo mode');
}

$cquery=ORM::for_table('email_logs')->find_one($id);
$cquery->delete();
 conf('email-history.php','s','Email Deleted Successfully');

 ?>

