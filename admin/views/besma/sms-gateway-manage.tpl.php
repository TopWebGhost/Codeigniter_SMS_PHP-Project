<?php
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
';
 require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['SMS_Gateway_Manage']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['SMS_Gateway_Manage']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['SMS_Gateway_Manage']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="setup-sms-api.php?_sgid=<?php echo $cmd; ?>" method="post">
                                <div class="form-group">
                                    <label for="gname" class="col-sm-3 control-label"><?php echo $Lan['SMS_Gateway_Name']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" readonly  class="form-control" id="gat_name" name="gat_name" value="<?php echo $d['name']; ?>">
                                    </div>
                                </div>
                                <?php


                                if($d['name']!='Twilio' AND $d['name']!='TelAPI'){

                                ?>
                                <div class="form-group">
                                    <label for="gname" class="col-sm-3 control-label"><?php echo $Lan['SMS_API_URL']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="apiurl" name="apiurl" value="<?php echo $d['api_link']; ?>">
                                    </div>
                                </div>
                                <?php
                                }
                                ?>

                                <div class="form-group">
                                    <label for="gname" class="col-sm-3 control-label">
                                        <?php
                                        if($d['name']=='Telenorcsms'){
                                            echo "Msisdn";
                                        }
                                        elseif($d['name']!='Twilio' OR $d['name']!='TelAPI'){

                                            ?>
                                            <?php echo $Lan['SMS_API_User_Name'];
                                        }
                                        else{
                                            echo $Lan['Account_Sid'];                                         }
                                            ?>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="username"  name="username" value="<?php echo $d['username']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gname" class="col-sm-3 control-label">

                                        <?php
                                        if($d['name']=='Twilio'  OR $d['name']=='TelAPI'){

                                            ?>
                                            <?php echo $Lan['Auth_Token']; ?>
                                        <?php
                                        }elseif($d['name']=='SMSKaufen'  OR $d['name']=='NibsSMS'){
                                            ?>
                                            <?php echo $Lan['SMS_API_Key']; ?>
                                            <?php

                                        }else{
                                            ?>
                                            <?php echo $Lan['SMS_API_Password']; ?>
                                        <?php
                                        }
                                        ?>

                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="password"  name="password" value="<?php echo $d['password']; ?>">
                                    </div>
                                </div>

                                <?php
                                if($d['name']=='Clickatell'){

                                ?>
                                <div class="form-group">
                                    <label for="gname" class="col-sm-3 control-label"><?php echo $Lan['API_ID']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="api_id" name="api_id" value="<?php echo $d['api_id']; ?>">
                                    </div>
                                </div>

                                <?php
                                }
                                ?>

                                <?php
                                if($d['name']=='NibsSMS'){

                                ?>
                                <div class="form-group">
                                    <label for="gname" class="col-sm-3 control-label">Country ID</label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="api_id" name="api_id" value="<?php echo $d['api_id']; ?>">
                                    </div>
                                </div>

                                <?php
                                }
                                ?>


                                <?php
                                 if($d['name']=='SMSGlobal' OR $d['name']=='NibsSMS'){
                                     ?>

                                <div class="form-group">
                                    <label for="show" class="col-sm-3 control-label"><?php echo $Lan['Schedule_SMS']; ?></label>
                                    <div class="col-sm-7">
                                        <div class="switch">
                                            <input type="checkbox"  name="schedule"  value="Yes" <?php if($d['schedule']=='Yes') { echo 'checked';} ?>>
                                        </div>
                                    </div>
                                </div>
                                 <?php
                                 }
                                ?>

                                <div class="form-group">
                                    <label for="show" class="col-sm-3 control-label"><?php echo $Lan['Status']; ?></label>
                                    <div class="col-sm-7">
                                        <div class="switch">
                                            <input type="checkbox"  name="status"  value="Active" <?php if($d['status']=='Active') { echo 'checked';} ?>>
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