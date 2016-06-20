<?php
require 'initapp.php';
$self='update-password.php';

$cmd=$cid;

if ($xstage=='Demo'){
     conf($self,'e','Updating Profile Password is disabled in the demo mode');
}

if (isset($_POST['updatepassword'])){

    $password=_post('password');
    $cpassword=_post('rpassword');


if ($password=='' OR $password!=$cpassword){
    conf($self,'e',"Password are empty or not match");
}
$password = md5($secret . $password);
$aclient=ORM::for_table('accounts')->find_one($cmd);
$aclient->password=$password;
$aclient->save(); 
$did = $aclient->id();
   conf($self,'s','Password Update Successfully');
}
else{
     conf($self,'e','Please Submit your password Again');
}

?>