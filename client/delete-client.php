<?php
require 'initapp.php';
$id= _get('_cmd');

if ($xstage=='Demo'){
conf('client-manage.php?_clid='.$id,'e','Deleting Account Profile is disabled in the demo mode');
}

$cquery=ORM::for_table('accounts')->where('parent',$cid)->find_one($id);

if($cquery){
    $cquery->delete();
    conf('all-clients.php','s','Client Deleted Successfully');
}else{
    conf('client-manage.php?_clid='.$id,'e','This Client ID were not found');
}
 ?>

