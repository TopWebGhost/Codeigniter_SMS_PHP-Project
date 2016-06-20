<?php
$xheader="
<link rel=\"stylesheet\" href=\"views/besma/assets/js/jquery.niftymodals/css/component.css\" />
";

$xfooter="
    <script src=\"views/besma/assets/js/jquery.parsley/parsley.js\" type=\"text/javascript\" ></script>
    <script src=\"views/besma/assets/js/jquery.niftymodals/js/jquery.modalEffects.js\"></script>
    <script type=\"text/javascript\">
      $(document).ready(function(){
        $('.md-trigger').modalEffects();
      });
    </script>
";
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Update_Coverage']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li><a href="coverage.php"><?php echo $Lan['Coverage']; ?></a></li>
                <li class="active"><?php echo $Lan['Update_Coverage']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>

            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Update_Coverage']; ?></h3>
                        </div>
                        <div class="content">
                                <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="update-coverage.php" method="post">

                        <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $Lan['Country']; ?></label>
                        <div class="col-sm-7">
                            <input type="text"  class="form-control"  value="<?php echo $d['country_name']; ?>" readonly>
                        </div>
                        </div>


                        <div class="form-group">
                            <label for="fname" class="col-sm-3 control-label"><?php echo $Lan['ISO_Code']; ?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control"  value="<?php echo $d['iso_code']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fname" class="col-sm-3 control-label"><?php echo $Lan['Country_Code']; ?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control"  value="<?php echo $d['country_code']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fname" class="col-sm-3 control-label"><?php echo $Lan['Tariff']; ?></label>
                            <div class="col-sm-7">
                                <input type="text"  required class="form-control" id="tariff" placeholder="Tariff" name="tariff"  value="<?php echo $d['tariff']; ?>">
                                <span class="help-block"><?php echo $Lan['Cost_For_Per_SMS']; ?> </span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="show" class="col-sm-3 control-label"><?php echo $Lan['Status']; ?></label>
                            <div class="col-sm-7">
                                <div class="switch">
                                    <input type="checkbox" required name="status"  value="1" <?php if($d['active']=='1'){echo 'checked';} ?>>
                                </div>
                            </div>
                        </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <input type="hidden" value="<?php echo $d['id'] ?>" name="cmd">
                                        <button type="submit" class="btn btn-primary" name="submit" ><?php echo $Lan['Update_Coverage']; ?></button>
                                        <button type="reset" class="btn btn-default"><?php echo $Lan['Cancel']; ?></button>
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