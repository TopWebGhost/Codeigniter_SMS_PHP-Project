<?php
error_reporting (0);
$appurl = $_POST['appurl'];
$db_host = $_POST['dbhost'];
$db_user = $_POST['dbuser'];
$db_password = $_POST['dbpass'];
$db_name = $_POST['dbname'];
$cn = '1';

if ($cn == '1') {
    $input = "<?php
".'$db_host'." 		= \"$db_host\";
".'$db_port'." 		= \"\";
".'$db_user'." 		= \"$db_user\";
".'$db_password'." 	= \"$db_password\";
".'$db_name'." 		= \"$db_name\";
".'define("BESMA", \'.php\')'.";
".'$secret'." = \"besma\";
?>
";
    $wConfig = "../AppConfig.php";
    $fh = fopen($wConfig, 'w') or die("can't create config file, your server does not support 'fopen' function,
 please create a file named - AppConfig.php with following contents- <br/>
 $input
 ");
    fwrite($fh, $input);
    fclose($fh);

    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

    $sql = file_get_contents('primary.sql');

    $qr = $dbh->exec($sql);

} else {
    header("location: step3.php?_error=1");
    exit;
}


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
        <?php
        if ($cn == '1') {
            $cururl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $appurl = str_replace('/install/step4.php', '', $cururl);
            ?>
            <p>
                <strong>Config File Created and Database Imported.</strong><br>
            </p>
            <form action="step5.php" method="post">
                <fieldset>
                    <legend>Configure your Application URL in the Database</legend>
                    <label>Application URL</label>
                    <input type='text' name="appurl" value="<?php echo $appurl; ?>">
                    <span class='help-block'>Please do not edit above url if you are unsure. Just click continue.</span>


                    <button type='submit' class='btn btn-primary'>Continue</button>
                </fieldset>
            </form>
        <?php
        } elseif ($cn == '2') {
            ?>
            <p> MySQL Connection was successful. An error occurred while adding data on MySQL. Unsuccessful
                Installation. Please refer manual installation in the Documentation or Contact softvillagebd@gmail.com for
                helping on installation</p>
        <?php
        } else {
            ?>

            <p> MySQL Connection Failed. </p>
        <?php

        }
        ?>
    </div>
</div>
<!--  contents area end  -->
</div>
<div class="footer">Copyright &copy; 2014-2015 All Rights Reserved<br/>
    <br/>
</div>

</body>
</html>

