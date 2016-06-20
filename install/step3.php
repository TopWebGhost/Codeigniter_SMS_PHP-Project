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
        if (isset($_GET['_error']) && ($_GET['_error']) == '1') {
            echo '<h4 style="color: red;"> Unable to Connect Database, Please make sure database info is correct and try again ! </h4>';
        }
        ?>
        <?php
        $cururl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $appurl = str_replace('/install/step3.php', '', $cururl);


        ?>

        <form action="step4.php" method="post">
            <fieldset>
                <legend>Database Connection &amp Application configuration</legend>
                <label>Application URL</label>
                <input type='text' name="appurl" value="<?php echo $appurl; ?>">
                <span class='help-block'>Please Enter Your Application URL Like (e.g. http://example.com/besma).OR Keep default, if you are unsure.</span>
                <hr>
                <label>Database Host</label>
                <input type='text' name="dbhost">
                <span class='help-block'>e.g. localhost</span>
                <label>Database Username</label>
                <input type='text' name="dbuser">
                <label>Database Password</label>
                <input type='text' name="dbpass">
                <label>Database Name</label>
                <input type='text' name="dbname">
                <label>&nbsp;</label>
                <button type='submit' class='btn btn-primary'>Submit</button>
            </fieldset>
        </form>
    </div>
</div>
<!--  contents area end  -->
</div>
<div class="footer">Copyright &copy; 2014-2015 All Rights Reserved<br/>
    <br/>
</div>

</body>
</html>

