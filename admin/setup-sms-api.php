<?php
require ('initapp.php');
$self = 'sms-gateway-manage.php';

$cmd=_get('_sgid');


if ($xstage=='Demo'){
conf($self.'?_sgid='.$cmd,'e','Changing Settings is disabled in the Demo Mode');
}


if(isset($_POST['submit'])){

    $gat_name=_post('gat_name');
    $api_url=_post('apiurl');
    $username=_post('username');
    $password=_post('password');
    $api_id=_post('api_id');
    $status=_post('status');
    $schedule=_post('schedule');

    if($gat_name!='Twilio' AND $gat_name!='TelAPI' AND $api_url==''){
        conf($self.'?_sgid='.$cmd,'e','Please Enter API URL');
    }

   if($username==''){
        conf($self.'?_sgid='.$cmd,'e','Please Enter User Name/SID');
    }


   if($password==''){
        conf($self.'?_sgid='.$cmd,'e','Please Enter Password/Auth Token');
    }

   if($gat_name=='Clickatell' AND $api_id==''){
        conf($self.'?_sgid='.$cmd,'e','Please Enter Api ID');
    }

    if($status=='Active'){
        $status='Active';
    }else{
        $status='Inactive';
    }


    if($schedule=='Yes'){
        $schedule='Yes';
    }else{
        $schedule='No';
    }



    $d=ORM::for_table('sms_gateway')->find_one($cmd);
    $d->api_link=$api_url;
    $d->username=$username;
    $d->password=$password;
    $d->api_id=$api_id;
    $d->status=$status;
    $d->schedule=$schedule;
    $d->save();

    conf($self.'?_sgid='.$cmd,'s','SMS Gateway Update Successfully');
}else{
    conf($self.'?_sgid='.$cmd,'e','Please Enter Information Again');
}

 ?>