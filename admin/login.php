<?php
                                    echo "<script type='text/javascript'>alert('password1');</script>";
echo "-----------login---------";
ob_start();
session_start();
define("_APP_RUN", true);
require "../AppINIT.php";
$self='login.php';
echo $_SERVER['REQUEST_METHOD'];
echo $_REQUEST['username'];
                                                            echo "<script type='text/javascript'>alert('password2');</script>";
if (isset($_REQUEST['username']))
{                                                       echo "<script type='text/javascript'>alert('password3');</script>";

    prf();
    echo "<script type='text/javascript'>alert('password3-1-3');</script>";
    $username=$_REQUEST['username'];
    $password=$_REQUEST['password'];
    echo "<script type='text/javascript'>alert('password3-1-2');</script>";
    if($username==''){
        conf($self,'e','Please Enter Your Username');
    }

    if($password==''){
        conf($self,'e','Please Enter Your Password');
    }
    $password = md5($secret . $password);


    echo $username;
    echo $password;
      echo "<script type='text/javascript'>alert('password3-1-1');</script>";
    require ('../lib/admin.class.php');
    $admin_login= new Admins;
    $login=$admin_login->login($username,$password);
}

else {                                              echo "<script type='text/javascript'>alert('password4');</script>";
    $theme=  appconfig('admintheme');
    require ("views/$theme/login.tpl.php");
}
                                                        echo "<script type='text/javascript'>alert('password5');</script>";
?>