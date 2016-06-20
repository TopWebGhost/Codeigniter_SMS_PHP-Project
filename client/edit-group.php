<?php
require 'initapp.php';
$cmd=_get('_gid');
$self="edit-client-group.php?_grpid=$cmd";

if ($xstage=='Demo'){
     conf($self,'e','Editing Client Group is disabled in the demo mode');
}

if (isset($_POST['submit'])){

    $gname=_post('gname');

    if ($gname==''){
    conf($self,'e',"Group Name Was Empty");
  }

    $clgroup=ORM::for_table('accgroups')->find_one($cmd);
    $e_group=$clgroup['groupname'];

    if($gname!='' AND $gname!=$e_group){
        if($clgroup){
            conf($self,'e','This Group Already Exist');
        }
    }


    $clgroup->groupname=$gname;
    $clgroup->save();

   conf($self,'s','Client Group Update Successfully');
}
else{
     conf($self,'e','Please Submit your Information Again');
}

?>