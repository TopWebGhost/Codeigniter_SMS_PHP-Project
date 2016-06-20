<?php
require 'initapp.php';
$self='manage-sms-plan-feature.php';

$fid=_get('_fid');

if ($xstage=='Demo'){
    conf($self.'?_fid='.$fid,'e','Update SMS Plan Feature is disabled in the demo mode');
}


if (isset($_POST['update'])){
  $plan_name= _post('plan_name');
    
  if ($plan_name==''){
        conf($self.'?_fid='.$fid,'e','Plan Name is Required.');
    }

    $feature_name= _post('feature');

  if ($feature_name==''){
        conf($self.'?_fid='.$fid,'e','Feature Name is Required.');
    }

    $feature_value= _post('value');

  if ($feature_value==''){
        conf($self.'?_fid='.$fid,'e','Feature value is Required.');
    }

    $sclientp=_post('clientshow');

     if ($sclientp=='1') {
        $sclientp='1';
     }else{
      $sclientp='0';
     }

    
    $feature= ORM::for_table('sms_plan_feature')->find_one($fid);
    $feature->pid = $plan_name;
    $feature->fname = $feature_name;
    $feature->fvalue = $feature_value;
    $feature->status = $sclientp;
    $feature->save();
      conf("view-price-plan-feature.php?_pid=$plan_name",'s','Feature Update Successfully');
}
 conf($self,'e','There have some problems. Please try again');

?>