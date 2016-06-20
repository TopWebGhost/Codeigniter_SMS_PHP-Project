<?php
require 'initapp.php';
$id= _get('_clid');

if(isset($_POST['submit'])){

    $sms_gateway=_post('sms_gateway');
    $email_gateway=_post('email_gateway');

    $cquery=ORM::for_table('accounts')->find_one($id);
    if($cquery){
        $cquery->sms_gateway=$sms_gateway;
        $cquery->email_gateway=$email_gateway;
        $cquery->save();
        conf('client-manage.php?_clid='.$id,'s','Change Gateway Successfully');
    }else{
        conf('client-manage.php?_clid='.$id,'e','There Have no Client');
    }

}else{
    conf('client-manage.php?_clid='.$id,'e','Please Try Again');
}



 ?>

