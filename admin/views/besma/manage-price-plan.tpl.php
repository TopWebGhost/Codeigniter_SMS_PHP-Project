<?php
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
';
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Manage_SMS_Price_Plan']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li><a href="sms-price-plan.php"><?php echo $Lan['SMS_Price_Plan']; ?></a></li>
                <li class="active"><?php echo $Lan['Manage_SMS_Price_Plan']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Manage_SMS_Price_Plan']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="update-sms-price-plan.php?_pid=<?php echo $pid; ?>" method="post">
                                <div class="form-group">
                                    <label for="pname" class="col-sm-3 control-label"><?php echo $Lan['Plan_Name']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="pname" placeholder="<?php echo $Lan['Plan_Name']; ?>" name="pname" value="<?php echo $plan_name; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pname" class="col-sm-3 control-label"><?php echo $Lan['Price']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="price" placeholder="<?php echo $Lan['Price']; ?>" name="price" value="<?php echo $price; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="show" class="col-sm-3 control-label"><?php echo $Lan['Show_In_Client']; ?></label>
                                    <div class="col-sm-7">
                                        <div class="switch">
                                            <input type="checkbox"  name="clientshow"  value="1" <?php if($status=='1') { echo 'checked';} ?>>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="show" class="col-sm-3 control-label"><?php echo $Lan['Mark']; ?> <?php echo $Lan['Popular']; ?></label>
                                    <div class="col-sm-7">
                                        <div class="switch">
                                            <input  name="popular" type="checkbox" value="1" <?php if($popular=='1') { echo 'checked';} ?>>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="update" ><?php echo $Lan['Update']; ?></button>

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