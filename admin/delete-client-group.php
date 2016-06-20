<?php
require 'initapp.php';
$self='all-groups.php';

$cmd=_get('_grpid');
$clgr=ORM::for_table('accgroups')->where('parent',$cid)->find_one($cmd);
if($clgr){
    $clgr->delete();
    conf($self,'s','Client Group Delete Successfully');
}else{
    conf("edit-client-group.php?_grpid=$cmd",'e','There Have no Group to Delete');
}

?>