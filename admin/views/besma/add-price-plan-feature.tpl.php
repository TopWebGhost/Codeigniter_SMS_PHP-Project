<?php

$xheader='';
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>

';
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Add_Plan_Feature']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li><a href="sms-price-plan.php"><?php echo $Lan['SMS_Price_Plan']; ?></a></li>
                <li class="active"><?php echo $Lan['Add_Plan_Feature']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>

            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Add_Plan_Feature']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="add-plan-feature.php?_pid=<?php echo $pid;?>" method="post">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $Lan['Price_Plane']; ?></label>
                                    <div class="col-sm-6">
                                        <select class="select2" name="plan_name">
                                            <?php
                                            $pquery=ORM::for_table('sms_price_plan')->find_many();
                                            foreach ($pquery as $value) {
                                                $id=$value['id'];
                                                $name=$value['plan_name'];
                                                ?>

                                                <option value="<?php echo $id; ?>" <?php if($name==$plan_find){ echo 'Selected';} ?>><?php echo $name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="feature" class="col-sm-3 control-label"><?php echo $Lan['Feature_Name']; ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" required  class="form-control" id="feature" placeholder="<?php echo $Lan['Feature_Name']; ?>" name="feature">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="feature" class="col-sm-3 control-label"><?php echo $Lan['Feature_Value']; ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" required  class="form-control" id="value" placeholder="<?php echo $Lan['Feature_Value']; ?>" name="value">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="show" class="col-sm-3 control-label"><?php echo $Lan['Show_In_Client']; ?></label>
                                    <div class="col-sm-7">
                                        <div class="switch">
                                            <input  name="clientshow" type="checkbox" value="1" checked>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="submit" ><?php echo $Lan['Add_Feature']; ?></button>
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