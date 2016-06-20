<?php
require 'initapp.php';
$self='add-new-sender-id.php';

if (isset($_POST['submit'])){

    $s_name=_post('s_name');

if ($s_name==''){
    conf($self,'e','Sender ID Name Was Empty');
}

    if($s_name!=''){
        $d=ORM::for_table('manage_sender')->where('s_id',$s_name)->find_one();
        if($d){
            conf($self,'e','This Sender ID Already Exist');
        }
    }


    $clientgrp= ORM::for_table('manage_sender')->create();
    $clientgrp->s_id=$s_name;
    $clientgrp->status='0';
    $clientgrp->save();

        conf("sender-id-manage.php",'s','Sender ID Add Successfully');
    }
else{
    conf($self,'e','Please Enter Group Information Again');
}


?>