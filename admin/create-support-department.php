<?php
require 'initapp.php';
$self='add-new-support-department.php';

if (isset($_POST['submit'])){
  $dname= _post('dname');
    
  if ($dname=='' OR $dname=='0'){
        conf($self,'e','Department Name is Required.');
    }
        
  $email = _post('demail');
    
  if ($email==''){
        conf($self,'e','Email is Required.');
    }else{
      $exist= ORM::for_table('supportdepartments')->where('email', $email)->count('id');
     if ($exist!='0'){
    conf($self,'e',"Email already Use Another Department");
   }
  }    
 
 $ordq=ORM::for_table('supportdepartments')->order_by_desc('id')->limit(1)->find_one();

 $order=$ordq['order'];

    $sclientp=_post('clientshow');

     if ($sclientp=='Yes') {
        $sclientp='Yes';
     }else{
      $sclientp='No';
     }

$order++;

    
    $supdept= ORM::for_table('supportdepartments')->create();
    $supdept->name = $dname;
    $supdept->email = $email;
    $supdept->show = $sclientp;
    $supdept->order = $order;
    $supdept->save();
    $sid=$supdept->id();
  
      conf("support-department-manage.php?_sid=".$sid,'s','Support Department Add Successfully');  
}
 conf($self,'e','There have some problems. Please try again');

?>