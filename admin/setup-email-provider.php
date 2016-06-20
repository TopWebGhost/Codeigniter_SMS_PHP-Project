<?php
require ('initapp.php');
$self = 'email-providers-manage.php';
if ($xstage=='Demo'){
conf($self,'e','Changing Settings is disabled in the Demo Mode');
}


$cmd=_get('_epid');

if(isset($_POST['submit'])){

    $host_name=_post('host_name');
    $username=_post('username');
    $password=_post('password');
    $port=_post('port');
    $status=_post('status');

   if($username==''){
        conf($self.'?_epid='.$cmd,'e','Please Enter User Name');
    }


   if($password==''){
        conf($self.'?_epid='.$cmd,'e','Please Enter Password');
    }


    if($status=='1'){
        $status='1';
    }else{
        $status='0';
    }

    $d=ORM::for_table('email_providers')->find_one($cmd);
    $d->host_name=$host_name;
    $d->username=$username;
    $d->password=$password;
    $d->port=$port;
    $d->status=$status;
    $d->save();

    conf($self.'?_epid='.$cmd,'s','Email Provider Update Successfully');
}else{
    conf($self.'?_epid='.$cmd,'e','Please Enter Information Again');
}

 ?>