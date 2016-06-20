<?php
require '../lib/country.php';
?>

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
    <link rel="stylesheet" type="text/css" href="views/besma/assets/js/jquery.select2/select2.css" />

</head>

<body class="texture">

<div id="cl-wrapper" class="sign-up-container">

    <div class="middle-sign-up">
        <div class="block-flat">
            <div class="header">
                <h3 class="text-center"><img class="logo-img" src="<?php echo appconfig('logo'); ?>" width="32px" height="32px" alt="logo"/><?php echo $bardname; ?></h3>
            </div>
            <div>
                <?php notify(); ?>

                <form style="margin-bottom: 0px !important;" class="form-horizontal" action="register-client-post.php" method="post">
                    <div class="content">
                        <h4 class="title"><?php echo $Lan['Register_To']; ?> <?php echo $bardname; ?></h4>


                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" placeholder="<?php echo $Lan['First_Name']; ?>" name="fname" id="fname" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" placeholder="<?php echo $Lan['Last_Name']; ?>" name="lname" id="lname" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                    <input type="text" placeholder="<?php echo $Lan['Company']; ?>" name="company" id="company" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                    <input type="text" placeholder="<?php echo $Lan['Website']; ?>" name="website" id="website" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" placeholder="<?php echo $Lan['Address']; ?>" name="address" id="address" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" placeholder="<?php echo $Lan['Address_two']; ?>" name="address2" id="address2" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" placeholder="<?php echo $Lan['City']; ?>" name="city" id="city" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" placeholder="<?php echo $Lan['State']; ?>" name="state" id="state" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" placeholder="<?php echo $Lan['Zip_Code']; ?>" name="zipcode" id="zipcode" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa  fa-globe"></i></span>
                                <select class="form-control" name="country">
                                    <?php echo country::countries(appconfig('defaultcountrycode')) ?>
                                  </select>
                                    </div>
                                </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                    <input type="text" placeholder="<?php echo $Lan['Phone']; ?>" name="phone" id="phone" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" placeholder="<?php echo $Lan['Email']; ?>" name="email" id="email" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" placeholder="<?php echo $Lan['Password']; ?>" name="password" id="password" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" placeholder="<?php echo $Lan['R_Password']; ?>" name="rpassword" id="rpassword" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group text-center">

                                    <img src="../lib/pnp/captcha/captcha.php" alt="CAPTCHA security code" id="captcha" /><br />

	       <span class="help-block"><a href="#" onclick="
    document.getElementById('captcha').src='../lib/pnp/captcha/captcha.php?'+Math.random();
    document.getElementById('captcha-form').focus();"
                                       id="change-image"><?php echo $Lan['Not_readable']; ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                    <input type="text" placeholder="<?php echo $Lan['Enter_Above_Code']; ?>"  name="captcha" class="form-control">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="foot">

                        <a class="btn btn-default" href="login.php"><?php echo $Lan['Back_to_login']; ?></a>

                        <button name="register"  class="btn btn-primary" type="submit"><?php echo $Lan['Register']; ?> </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center out-links"><?php echo appconfig('footerTxt'); ?></div>
    </div>

</div>

<script src="views/besma/assets/js/jquery.select2/select2.min.js" type="text/javascript"></script>

<script src="views/besma/assets/js/jquery.js"></script>
<script type="text/javascript" src="views/besma/assets/js/behaviour/general.js"></script>
<script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
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
