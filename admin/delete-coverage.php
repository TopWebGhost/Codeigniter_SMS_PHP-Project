<?php
require 'initapp.php';
$id= _get('_coid');

if ($xstage=='Demo'){
conf("coverage-manage.php?_coid=$id",'e','Deleting Coverage is disabled in the demo mode');
}

$cquery=ORM::for_table('coverage')->find_one($id);
$cquery->delete();
 conf('coverage.php','s','Coverage Deleted Successfully');

 ?>

