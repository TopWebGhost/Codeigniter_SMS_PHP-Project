<?php
require 'initapp.php';
$id= _get('_clid');

$cquery=ORM::for_table('accounts')->find_one($id);
$sms=$cquery['sms_limit'];
$email=$cquery['email_limit'];

if(isset($_POST['submit'])){

    $email_limit=_post('email_limit');
    $sms_limit=_post('sms_limit');

    if($email_limit!=''){
        $d=ORM::for_table('email_transaction')->create();
        $d->userid=$id;
        $d->amount=$email_limit;
        $d->save();

        $remaining_email=$email+$email_limit;
        $cquery->email_limit=$remaining_email;
        $cquery->save();
    }

    if($sms_limit!=''){

        $d=ORM::for_table('sms_transaction')->create();
        $d->userid=$id;
        $d->amount=$sms_limit;
        $d->save();

        $remaining_sms=$sms+$sms_limit;
        $cquery->sms_limit=$remaining_sms;
        $cquery->save();
    }


    conf('client-manage.php?_clid='.$id,'s','Change Quote Successfully');
}else{
    conf('client-manage.php?_clid='.$id,'e','Please Try Again');
}



 ?>

