<?php
require 'initapp.php';
$eid=_get('_tplid');
$self='email-templates-manage.php?_eid='.$eid;


if (isset($_POST['update'])){
  $subject= _post('subject');
    
  if ($subject=='' OR $subject=='0'){
        conf($self,'e','Subject Name is Required.');
    }

    $sclientp=_post('clientshow');

    if ($sclientp=='Yes') {
       $sclientp='Yes';
    }else{
      $sclientp='No';
    }
     
     $message=$_POST['message'];
//      $message=html_entity_decode($message);


    $tplup= ORM::for_table('email_templates')->find_one($eid);
    $tplup->subject = $subject;
    $tplup->message = $message;
    $tplup->core= $sclientp;
    $tplup->save();
    $sid=$tplup->id();
  
      conf($self,'s','Email Template Update Successfully');  
}
 conf($self,'e','There have some problems. Please try again');

?>