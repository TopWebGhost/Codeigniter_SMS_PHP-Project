<?php
Class Admins {
public static function login($username,$password){
    global $dbh;
    $lastlogin=date("Y-m-d H:i:s");
 echo "<script type='text/javascript'>alert('password3-1');</script>";
    $stmt = $dbh->prepare("SELECT id, username, password FROM admins WHERE username = :user_id AND password = :password AND status='Active'");
    $stmt->bindParam(':user_id', $username, PDO::PARAM_STR, 12);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR, 30);
    $stmt->execute();
    $result = $stmt->fetchAll();

	if ($stmt->rowCount()=="1") {
        foreach ($result as $value) {
             $cmd=$value['id'];
            $_SESSION['aid']=$value['id'];
            $lid = md5(uniqid(rand(),TRUE));
            $_SESSION['lid'] = $lid;
            setcookie("_lid", "$lid", time()+86400);

            $login=ORM::for_table('admins')->find_one($cmd);
            $login->lastlogin=$lastlogin;
            $login->online='1';
            $login->save();

           conf('index.php');

        }
    }
    else {
        conf('login.php','e','Invalid User Name or Password');
    }

}
}

?>