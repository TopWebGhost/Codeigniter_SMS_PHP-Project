<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../assets/admin/favicon.png">

    <title><?php echo $WebsiteTitle; ?></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap core CSS -->
    <link href="views/besma/assets/js/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" href="views/besma/assets/fonts/font-awesome-4/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="views/besma/assets/css/style.css" rel="stylesheet" />

</head>

<body class="texture">

<div id="cl-wrapper" class="login-container">

    <div class="middle-login">
        <div class="block-flat">
            <div class="header">
                <h3 class="text-center"><img class="logo-img" src="<?php echo appconfig('logo'); ?>" width="32px" height="32px" alt="logo"/><?php echo appconfig('CompanyName') ?></h3>
            </div>
            <div>
                <?php notify(); ?>

                <form style="margin-bottom: 0px !important;" class="form-horizontal" action="login.php" method="post">
                    <div class="content">
                        <h4 class="title"><?php echo $Lan['Login_Access']; ?></h4>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" placeholder="<?php echo $Lan['Username']; ?>"  name="username" id="username" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" placeholder="<?php echo $Lan['Password']; ?>"  name="password" id="password" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="foot">

                        <a class="btn btn-default" href="client-password-forget.php"><?php echo $Lan['Forgot_Password']; ?>?</a>
                        <?php
                        if(appconfig('Client_Registration')=='1'){
                            ?>
                            <a class="btn btn-default" href="register.php"><?php echo $Lan['Register']; ?></a>
                        <?php
                        }
                        ?>

                        <button name="login"  class="btn btn-primary"><?php echo $Lan['login']; ?></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center out-links"><?php echo appconfig('footerTxt'); ?></div>
    </div>

</div>

<script src="views/besma/assets/js/jquery.js"></script>
<script type="text/javascript" src="views/besma/assets/js/behaviour/general.js"></script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="views/besma/assets/js/behaviour/voice-commands.js"></script>
<script src="views/besma/assets/js/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="views/besma/assets/js/jquery.flot/jquery.flot.js"></script>
<script type="text/javascript" src="views/besma/assets/js/jquery.flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="views/besma/assets/js/jquery.flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="views/besma/assets/js/jquery.flot/jquery.flot.labels.js"></script>
</body>
</html>
