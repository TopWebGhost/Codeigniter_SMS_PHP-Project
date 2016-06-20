<?php
require 'initapp.php';
$id= _get('_dip');

if ($xstage=='Demo'){
conf('support-departments.php','e','Deleting Support Department is disabled in the demo mode');
}

$cquery=ORM::for_table('supportdepartments')->find_one($id);
$cquery->delete();
 conf('support-departments.php','s','Support Department Deleted Successfully');

 ?>

