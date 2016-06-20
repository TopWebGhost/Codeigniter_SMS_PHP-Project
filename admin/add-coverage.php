<?php
require 'initapp.php';
$self='add-new-coverage.php';

if (isset($_POST['submit'])){

    $country=_post('country');
    $operator=_post('operator');
    $c_code=_post('c_code');
    $op_code=_post('op_code');
    $price=_post('price');
    $status=_post('status');

    if($status=='1'){
        $status='Live';
    }else{
        $status='Offline';
    }

    $f_c=ORM::for_table('coverage')->where('operator',$operator)->find_one();
    $exit_operator=$f_c['operator'];

    if($operator!='' AND $exit_operator==$operator){
           if($f_c){
               conf($self,'e','This operator Already Exist');
           }
    }

    $f_c=ORM::for_table('coverage')->where('op_code',$op_code)->find_one();
    $exit_op_code=$f_c['op_code'];

    if($op_code!='' AND $exit_op_code==$op_code){
           if($f_c){
               conf($self,'e','This Operator Code Already Exist');
           }
    }



    $d = ORM::for_table('coverage')->create();
    $d->country=$country;
    $d->operator=$operator;
    $d->c_code=$c_code;
    $d->op_code=$op_code;
    $d->price=$price;
    $d->status=$status;
    $d->save();
    $did = $d->id();

    conf('coverage.php','s','Coverage Add Successfully');
}else{
    conf($self,'e','Please Insert Information again');
}
?>