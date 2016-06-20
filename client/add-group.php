<?php
require 'initapp.php';
$self='add-new-group.php';

if (isset($_POST['submit'])){

    $grname=_post('gname');

if ($grname==''){
    conf($self,'e','Group Name Was Empty');
}

    if($grname!=''){
        $d=ORM::for_table('accgroups')->where('groupname',$grname)->find_one();
        if($d){
            conf($self,'e','This Group Already Exist');
        }
    }


    $clientgrp= ORM::for_table('accgroups')->create();
    $clientgrp->groupname=$grname;
    $clientgrp->parent=$cid;
    $clientgrp->save();
    $grpid = $clientgrp->id();
        conf("all-groups.php",'s','Client Group Add Successfully');
    }


else{
          conf($self,'e','Please Enter Group Information Again');

}


?>