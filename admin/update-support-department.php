<?php
require 'initapp.php';
$sid=_get('_sid');
$self='support-department-manage.php?_sid='.$sid;

if (isset($_POST['update'])){
  $dname= _post('dname');


    
  if ($dname=='' OR $dname=='0'){
        conf($self,'e','Department Name is Required.');
    }
        
  $email = _post('demail');
  
  $findemail= ORM::for_table('supportdepartments')->where('email', $email)->find_one($sid);
  $oremail=$findemail['email'];



  if ($email==''){
        conf($self,'e','Email is Required.');
    }elseif ($email==$oremail) {
        $email=$oremail;
    }
    else{

      $exist= ORM::for_table('supportdepartments')->where('email', $email)->count('id');
     if ($exist!='0'){
    conf($self,'e',"Email already Use Another Department");
   }
  }    

    $sclientp=_post('clientshow');
    
    $supdept= ORM::for_table('supportdepartments')->find_one($sid);
    $supdept->name = $dname;
    $supdept->email = $email;
    $supdept->show = $sclientp;
    $supdept->save();
    $sid=$supdept->id();
  
      conf($self,'s','Support Department Update Successfully');  
}
 conf($self,'e','There have some problems. Please try again');

?>