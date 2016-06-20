<?php
require 'initapp.php';
$self='add-sms-price-plan.php';

if (isset($_POST['submit'])){
  $pname= _post('pname');
    
  if ($pname=='' OR $pname=='0'){
        conf($self,'e','Plan Name is Required.');
    }

    $price= _post('price');

  if ($price==''){
        conf($self,'e','Plan Price is Required.');
    }



    $sclientp=_post('clientshow');

     if ($sclientp=='1') {
        $sclientp='1';
     }else{
      $sclientp='0';
     }

    $popular=_post('popular');

     if ($popular=='1') {
         $popular='1';
     }else{
         $popular='0';
     }

    $price_plan= ORM::for_table('sms_price_plan')->create();
    $price_plan->plan_name = $pname;
    $price_plan->price = $price;
    $price_plan->status = $sclientp;
    $price_plan->popular = $popular;
    $price_plan->save();
      conf("sms-price-plan.php",'s','Price Plan Add Successfully');
}
 conf($self,'e','There have some problems. Please try again');

?>