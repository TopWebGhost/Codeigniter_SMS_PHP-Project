<?php
require ('initapp.php');
$self = 'payment-gateway-manage.php';

$cmd=_get('_pgid');


if ($xstage=='Demo'){
    conf($self.'?_pgid='.$cmd,'e','Changing Settings is disabled in the Demo Mode');
}


if(isset($_POST['submit'])){

    $gat_name=_post('gat_name');
    $gat_value=_post('value');
    $extra_value=_post('extra_value');
    $status=_post('status');

    if($gat_name==''){
        conf($self.'?_pgid='.$cmd,'e','Please Enter Gateway Name');
    }

    if($gat_value==''){
        conf($self.'?_pgid='.$cmd,'e','Please Enter Email/Key/Login ID/Details');
    }

    if($status=='active'){
        $status='active';
    }else{
        $status='inactive';
    }

    $d=ORM::for_table('payment_gateways')->find_one($cmd);
    $d->name=$gat_name;
    $d->value=$gat_value;
    $d->extra_value=$extra_value;
    $d->status=$status;
    $d->save();

    conf($self.'?_pgid='.$cmd,'s','Payment Gateway Update Successfully');
}else{
    conf($self.'?_pgid='.$cmd,'e','Please Enter Information Again');
}

?>