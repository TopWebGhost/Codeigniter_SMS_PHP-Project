<?php
require 'initapp.php';
$self='coverage-manage.php';

if (isset($_POST['submit'])){

    $cmd=_post('cmd');
    $price=_post('tariff');
    $status=_post('status');

    if($status=='1'){
        $status='1';
    }else{
        $status='0';
    }

    if($price==''){
        conf($self.'?_coid='.$cmd,'e','Insert Tariff Amount');
    }

    $d=ORM::for_table('int_country_codes')->find_one($cmd);
    $d->tariff=$price;
    $d->active=$status;
    $d->save();

    conf($self.'?_coid='.$cmd,'s','Coverage Update Successfully');
}else{
    conf($self.'?_coid='.$cmd,'e','Please Insert Information again');
}
?>