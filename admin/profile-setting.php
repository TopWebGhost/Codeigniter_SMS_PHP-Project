<?php
require 'initapp.php';
$self='profile-setting.php';
$action = _post('updateprof');
if($action=='edit'){
    if ($xstage=='Demo'){
        conf($self,'e','Changing Settings is disabled in the Demo Mode');
    }
    $id = $aid;
    $fname = _post('fname');
    $lname = _post('lname');
    $email = _post('email');
    if ($fname==''){
        conf($self,'e','First Name is Required');

    } 
    if ($lname=='') {
        conf($self,'e','Last Name is Required');
    } 
    if($email==''){
        conf($self,'e','Email is Required');
    }
    $adminq = ORM::for_table('admins')->find_one($id);
    $adminq->fname = $fname;
    $adminq->lname = $lname;
    $adminq->email = $email;
    $adminq->save();
    conf($self,'s','Profile Edited Successfully');
}
require ("views/$theme/profile-setting.tpl.php");

?>