<?php
require 'initapp.php';
$id= _get('_cmd');

if ($xstage=='Demo'){
conf('client-manage.php?_clid='.$id,'e','Deleting Account Profile is disabled in the demo mode');
}

$cquery=ORM::for_table('accounts')->find_one($id);
$cquery->delete();
 conf('all-clients.php','s','Client Deleted Successfully');

 ?>

