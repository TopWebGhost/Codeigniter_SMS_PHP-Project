<?php
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
';
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Update_Password']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['Update_Password']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">

            <?php notify(); ?>

            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Update_Password']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="update-admin-password.php" method="post">
                                <div class="form-group">
                                    <label for="password" class="col-sm-3 control-label"><?php echo $Lan['Password']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="password" required  class="form-control" id="password" placeholder="<?php echo $Lan['Password']; ?>" name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rpassword" class="col-sm-3 control-label"><?php echo $Lan['R_Password']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="password" required  class="form-control" id="password2" placeholder="<?php echo $Lan['R_Password']; ?>" name="rpassword">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="updatepassword" ><?php echo $Lan['Update_Password']; ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

<?php  require ('theme/footer.tpl.php'); ?>