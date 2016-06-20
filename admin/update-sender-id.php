<?php
require 'initapp.php';
$self='sender-id-update.php';

if ($xstage=='Demo'){
    conf("sender-id-manage.php",'e','Updating Sender ID is disabled in the demo mode');
}

if (isset($_POST['update'])){

    $cmd=_get('_sid');

    $d=ORM::for_table('manage_sender')->find_one($cmd);
    $exit_sender=$d['s_id'];

    $s_name=_post('s_name');
    $status=_post('status');

if ($s_name==''){
    conf($self."?_sid=".$cmd,'e','Sender ID Name Was Empty');
}

    if($s_name!='' AND $exit_sender!=$s_name){
        $e=ORM::for_table('manage_sender')->where('s_id',$s_name)->find_one();
        if($e){
            conf($self."?_sid=".$cmd,'e','This Sender ID Already Exist');
        }
    }

    if($status=='0'){
        $status='0';
    }else{
        $status='1';
    }


    if($d){
        $d->s_id=$s_name;
        $d->status=$status;
        $d->save();

        conf($self."?_sid=".$cmd,'s','Sender ID Updated Successfully');
    }else{
        conf($self."?_sid=".$cmd,'e','There have no Sender ID');
    }
}
else{
    conf($self."?_sid=".$cmd,'e','Please Submit Information Again');
}


?>