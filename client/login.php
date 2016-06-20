<?php
ob_start();
session_start();
define("_APP_RUN", true);
require '../AppINIT.php';
$footerTxt = appconfig('footerTxt');
$theme=  appconfig('theme');

if (isset($_POST['login']))
{
	$username=_post('username');
	$password=_post('password');

    if($username==''){
        conf('login.php','e','Please Enter Your Username');
    }

    if($password==''){
        conf('login.php','e','Please Enter Your Password');
    }

   $password = md5($secret . $password);

    $lastlogin=date("Y-m-d H:i:s");


$stmt = $dbh->prepare("SELECT id, email, password FROM accounts WHERE email = :user_id AND password = :password AND status='Active'");
        $stmt->bindParam(':user_id', $username, PDO::PARAM_STR, 12);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR, 30);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if ($stmt->rowCount() == "1") {
            foreach ($result as $value) {
                $cmd=$value['id'];
                $_SESSION['cid'] = $value['id'];
                $lid = md5(uniqid(rand(), TRUE));
                $_SESSION['lid'] = $lid;
                setcookie("_lid", "$lid", time() + 86400);
                $login=ORM::for_table('accounts')->find_one($cmd);
                 $login->online='1';
                 $login->lastlogin=$lastlogin;
                 $login->save();

                conf('index.php');

            }
        } else {
            conf('login.php', 'e', 'Invalid Userid or Password');
        }
}
require ("views/$theme/login.tpl.php");

?>