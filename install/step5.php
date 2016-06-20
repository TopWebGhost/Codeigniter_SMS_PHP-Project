<?php
require "../AppConfig.php";
try {
    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
$appurl = $_POST['appurl'];

$stmt = $dbh->prepare("UPDATE appconfig SET value = '$appurl'  where setting= 'sysUrl'");
$result = $stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>BESMA Auto Installer</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/admin/favicon.png">
    <style type="text/css">


    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link type='text/css' href='style.css' rel='stylesheet'/>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet">


    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

</head>
<body style='background-color: #deead3;'>
<div class='main-container'>
    <div class='header'>
        <div class="header-box wrapper">
            <div class="hd-logo"><a href="#"><img src="../assets/uploads/logo.png" alt="Logo"/></a></div>
        </div>

    </div>
    <!--  contents area start  -->
    <div class="span12">
        <h4>BESMA Auto Installer </h4>

        <p>
            <strong>Congratulations!</strong><br>
            You have Successfully Install BESMA Application!<br>
            To Login Admin Portal:<br>
            Use this link -
            <?php
            $cururl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $appurl = str_replace('/install/step5.php', '', $cururl);
            echo '<a href="' . $appurl . '/admin">' . $appurl . '/admin</a>';
            ?>
            <br>
            Username: admin<br>
            Password: admin.password<br>
            After login, go to Settings -> System Settings Menu to change other Configurations.
        </p>

    </div>
</div>
<!--  contents area end  -->
</div>
<div class="footer">Copyright &copy; 2014 All Rights Reserved<br/>
    <br/>
</div>

</body>
</html>