<?php
require 'initapp.php';
$id= _get('_cmd');

if ($xstage=='Demo'){
conf('administrator-manage.php?_id='.$id.'#home/','e','Deleting Administrator is disabled in the demo mode');
}

$cquery=ORM::for_table('admins')->find_one($id);
$cquery->delete();
 conf('administrators.php','s','Administrator Deleted Successfully');

?>
