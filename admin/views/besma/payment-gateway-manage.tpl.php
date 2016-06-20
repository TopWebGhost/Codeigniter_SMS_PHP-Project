<?php
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
';
 require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Payment_Gateway_Manage']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li><a href="payment-gateways.php"><?php echo $Lan['Payment_Gateways']; ?></a></li>
                <li class="active"><?php echo $Lan['Payment_Gateway_Manage']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Payment_Gateway_Manage']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="update-payment-gateway.php?_pgid=<?php echo $cmd; ?>" method="post">
                                <div class="form-group">
                                    <label for="gname" class="col-sm-3 control-label"><?php echo $Lan['Gateway_Name']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" readonly  class="form-control" data-readOnly  id="gat_name" name="gat_name" value="<?php echo $pg['name']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="value" class="col-sm-3 control-label">
                                        <?php
                                        if($pg_name=='Paypal'){
                                            ?>
                                            <?php echo $Lan['Paypal_Email']; ?>
                                            <?php
                                        }elseif($pg_name=='Stripe'){
                                            ?>
                                            <?php echo $Lan['Publishable_Key']; ?>
                                            <?php
                                        }elseif($pg_name=='Bank'){
                                            ?>
                                            <?php echo $Lan['Bank_Details']; ?>
                                            <?php
                                        }elseif($pg_name=='Authorize.net'){
                                            ?>
                                            <?php echo $Lan['Api_Login_ID']; ?>
                                            <?php

                                        }else{
                                    echo "Value";
                                        }
                                        ?>

                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="value" name="value" value="<?php echo $pg['value']; ?>">
                                    </div>
                                </div>





                                <?php
                                if($pg_name=='Stripe' OR $pg_name=='Authorize.net'){

                                ?>
                                <div class="form-group">
                                    <label for="extra_value" class="col-sm-3 control-label">
                                        <?php
                                        if($pg_name=='Stripe'){

                                            ?>
                                            <?php echo $Lan['Secret_Key']; ?>
                                        <?php
                                        }else{
                                            ?>
                                            <?php echo $Lan['Transaction_Key']; ?>
                                        <?php
                                        }
                                        ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="extra_value"  name="extra_value" value="<?php echo $pg['extra_value']; ?>">
                                    </div>
                                </div>

                                <?php
                                }
                                ?>

                                <div class="form-group">
                                    <label for="show" class="col-sm-3 control-label"><?php echo $Lan['Status']; ?></label>
                                    <div class="col-sm-7">
                                        <div class="switch">
                                            <input type="checkbox"  name="status"  value="active" <?php if($pg['status']=='active') { echo 'checked';} ?>>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="submit" ><?php echo $Lan['Update']; ?></button>
                                        <button class="btn btn-default" type="reset"><?php echo $Lan['Cancel']; ?></button>
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