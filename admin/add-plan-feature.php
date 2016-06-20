<?php
require 'initapp.php';
$self='add-price-plan-feature.php';

$pid=_get('_pid');


if (isset($_POST['submit'])){
  $plan_name= _post('plan_name');
    
  if ($plan_name==''){
        conf($self.'?_pid='.$pid,'e','Plan Name is Required.');
    }

    $feature_name= _post('feature');

  if ($feature_name==''){
        conf($self.'?_pid='.$pid,'e','Feature Name is Required.');
    }

    $feature_value= _post('value');

  if ($feature_value==''){
        conf($self.'?_pid='.$pid,'e','Feature value is Required.');
    }

    $sclientp=_post('clientshow');

     if ($sclientp=='1') {
        $sclientp='1';
     }else{
      $sclientp='0';
     }

    
    $feature= ORM::for_table('sms_plan_feature')->create();
    $feature->pid = $pid;
    $feature->fname = $feature_name;
    $feature->fvalue = $feature_value;
    $feature->status = $sclientp;
    $feature->save();
      conf("view-price-plan-feature.php?_pid=$pid",'s','Feature Add Successfully');
}
 conf($self,'e','There have some problems. Please try again');

?>