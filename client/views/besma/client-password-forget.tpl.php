<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../assets/admin/favicon.png">


    <title><?php echo appconfig('CompanyName') ?> | <?php echo $Lan['Client_Password_Reset']; ?></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap core CSS -->
    <link href="views/besma/assets/js/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" href="views/besma/assets/fonts/font-awesome-4/css/font-awesome.min.css">


    <!-- Custom styles for this template -->
    <link href="views/besma/assets/css/style.css" rel="stylesheet" />

</head>

<body class="texture">

<div id="cl-wrapper" class="forgotpassword-container">

    <div class="middle">
        <div class="block-flat">
            <div class="header">
                <h3 class="text-center"><img class="logo-img" src="<?php echo appconfig('logo'); ?>" width="32px" height="32px" alt="logo"/> <?php echo appconfig('CompanyName') ?></h3>
            </div>
            <div>
                <form style="margin-bottom: 0px !important;" class="form-horizontal" action="forgot_password.php" parsley-validate novalidate method="post">
                    <div class="content">
                        <h5 class="title text-center"><strong><?php echo $Lan['Forgot_Password']; ?>?</strong></h5>
                        <p class="text-center"><?php echo $Lan['Retrieve_Password']; ?></p>
                        <p class="text-center"> <a href="login.php"><?php echo $Lan['Back_to_login']; ?></a> </p>
                        <hr/>


                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" name="email" parsley-trigger="change" parsley-error-container="#email-error" required placeholder="<?php echo $Lan['Your_Email']; ?>" class="form-control">
                                </div>
                                <div id="email-error"></div>
                            </div>
                        </div>
                        <button class="btn btn-block btn-primary btn-rad btn-lg" type="submit" name="submit"><?php echo $Lan['Reset_Password']; ?></button>

                    </div>
                </form>
            </div>
        </div>
        <div class="text-center out-links"><?php echo appconfig('footerTxt'); ?></div>
    </div>

</div>


<script src="views/besma/assets/js/jquery.js"></script>
<script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript"></script>
<script src="views/besma/assets/js/behaviour/general.js" type="text/javascript"></script>

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
