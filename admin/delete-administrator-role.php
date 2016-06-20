<?php
require 'initapp.php';
$id= _get('_rid');

if ($xstage=='Demo'){
conf('administrators-role.php','e','Deleting Administrator Role is disabled in the demo mode');
}

if($id=='1'){
    conf('administrator-role-manage.php?_rid='.$id,'e','You Can not Delete Super Administrator Role');
}
else{
$cquery=ORM::for_table('adminroles')->find_one($id);
$cquery->delete();
 conf('administrators-role.php','s','Administrator Role Deleted Successfully');
}
?>

