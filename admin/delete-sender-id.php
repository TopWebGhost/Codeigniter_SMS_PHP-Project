<?php
require 'initapp.php';
$id= _get('_sid');

if ($xstage=='Demo'){
conf("sender-id-manage.php",'e','Deleting Sender ID is disabled in the demo mode');
}

$cquery=ORM::for_table('manage_sender')->find_one($id);
$cquery->delete();
 conf('sender-id-manage.php','s','Sender ID Deleted Successfully');

 ?>

