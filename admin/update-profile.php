<?php
require 'initapp.php';

$self='update-profile.php';

if (isset($_POST['update'])){

    $fname= _post('fname');
    if ($fname=='' OR $fname=='0'){
        conf($self,'e','First Name is Required.');
    }

    $lname=_post('lname');

    $email = _post('email');

    $emailcheck=ORM::for_table('admins')->find_one($cmd);

    $cemail=$emailcheck['email'];
    $oldpassword=$emailcheck['password'];

    if ($email==''){
        conf($self,'e','Email is Required.');
    }else{
        $exist= ORM::for_table('admins')->where('email', $emal)->count('id');
        if ($exist!='0'){
            conf($self,'e',"Email already exist");
        }
    }

    $password = _post('password');
    $rpassword = _post('rpassword');

    if ($password!=$rpassword){
        conf($self,'e','Password does not match');
    }

    if ($password=='' AND $rpassword==''){
        $password=$oldpassword;
    }

    if ($password!='' AND $rpassword==$password){
        $password = md5($secret . $password);
    }
    $roleid=_post('role');

    if ($roleid=='') {
        conf($self,'e','Role is Required');
    }

    $adminq=ORM::for_table('admins')->find_one($cmd);

    $adminq->fname = $fname;
    $adminq->lname = $lname;
    $adminq->email = $email;
    $adminq->password=$password;
    $adminq->roleid = $roleid;
    $adminq->save();

    conf($self,'s','Administrator Update Successfully');
}
conf($self,'e','There have some problems. Please try again');

?>