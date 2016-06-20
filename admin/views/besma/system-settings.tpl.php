<?php
$xheader='
<link rel="stylesheet" type="text/css" href="views/besma/assets/js/fuelux/css/fuelux.css" />
<link rel="stylesheet" type="text/css" href="views/besma/assets/js/fuelux/css/fuelux-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="views/besma/assets/css/pygments.css" />
<link rel="stylesheet" type="text/css" href="views/besma/assets/js/redactor-js/redactor/redactor.css" />
';
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
    <script src="views/besma/assets/js/fuelux/loader.min.js" type="text/javascript" ></script>
    <script src="views/besma/assets/js/modernizr.js" type="text/javascript" ></script>
    <script src="views/besma/assets/js/redactor-js/redactor/redactor.js" type="text/javascript" ></script>
      <script type="text/javascript">
    $(document).ready(function(){
        App.init();
      App.wizard();
       $(\'#content\').redactor();
        });
  </script>
';


require ('theme/header.tpl.php');
?>

<div class="container-fluid" id="pcont">
<div class="page-head">
    <h2><?php echo $Lan['System_Settings']; ?></h2>
    <ol class="breadcrumb">
        <li><a href="index.php"> <?php echo $Lan['Home']; ?></a></li>
        <li class="active"><?php echo $Lan['System_Settings']; ?></li>
    </ol>
</div>
<div class="cl-mcont">
<?php notify(); ?>
<div class="row">

    <div class="col-sm-12 col-md-12">
        <div class="tab-container">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#companyinfo" data-toggle="tab"><i class="fa fa-home"></i> <?php echo $Lan['Company_Information']; ?></a></li>
                <li><a href="#appconfig" data-toggle="tab"><i class="fa fa-cog"></i> <?php echo $Lan['Application_Configuration']; ?></a></li>
                <li><a href="#currency" data-toggle="tab"><i class="fa fa-money"></i> <?php echo $Lan['Currency_Localization']; ?></a></li>
                <li><a href="#logo" data-toggle="tab"><i class="fa fa-camera-retro"></i> <?php echo $Lan['Logo']; ?> </a></li>
            </ul>

            <?php
            $company = appconfig('CompanyName');
            $email = appconfig('Email');
            $appurl = appconfig('sysUrl');
            $caddress = appconfig('caddress');
            ?>

            <div class="tab-content">
                <div class="tab-pane active cont" id="companyinfo">
                    <form role="form" class="form-horizontal group-border-dashed"  method="post" action="update-companyinfo.php">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="company"><?php echo $Lan['Company']; ?> <?php echo $Lan['A_Name']; ?></label>
                            <div class="col-sm-7">
                                <input type="text" required placeholder="<?php echo $Lan['Company']; ?> <?php echo $Lan['A_Name']; ?>" name="company" id="company"  value="<?php echo $company;  ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="email"><?php echo $Lan['Email']; ?></label>
                            <div class="col-sm-8">
                                <input type="email" required name="email" id="email" placeholder="<?php echo $Lan['Email']; ?>"  value="<?php echo $email;  ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="caddress"><?php echo $Lan['Company']; ?> <?php echo $Lan['Address']; ?> </label>
                            <div class="col-sm-8">
                                <textarea  class="form-control" id="content" name="caddress"><?php echo $caddress; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="appurl"><?php echo $Lan['Application_URL']; ?></label>
                            <div class="col-sm-8">
                                <input type="text" required name="appurl" id="appurl" placeholder="<?php echo $Lan['Application_URL']; ?>"  value="<?php echo $appurl;  ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button class="btn btn-primary" type="submit" name="update"><?php echo $Lan['Update']; ?></button>

                            </div>
                        </div>
                    </form>

                </div>
                <?php
                $CompanyTitle = appconfig('WebsiteTitle');
                $footerTxt = appconfig('footerTxt');
                $BrandName = appconfig('BrandName');
                $EmailPerm = appconfig('email_perm');
                $SMSPerm = appconfig('sms_perm');
                $Cl_Reg = appconfig('Client_Registration');
                ?>


                <div class="tab-pane cont" id="appconfig">
                    <form role="form" class="form-horizontal group-border-dashed"  method="post" action="update-appconfig.php">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="apptitle"><?php echo $Lan['Application_Title']; ?></label>
                            <div class="col-sm-8">
                                <input type="text" required placeholder="<?php echo $Lan['Application_Title']; ?>" name="websitetitle" id="websitetitle"  value="<?php echo $CompanyTitle;  ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="brandname"><?php echo $Lan['Brand_Name']; ?></label>
                            <div class="col-sm-8">
                                <input type="text" required name="brandname" id="brandname" placeholder="<?php echo $Lan['Brand_Name']; ?>"  value="<?php echo $BrandName;  ?>" class="form-control">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="footertxt"><?php echo $Lan['Footer_Text']; ?></label>
                            <div class="col-sm-8">
                                <input type="text" required name="footertxt" id="footertxt" placeholder="<?php echo $Lan['Footer_Text']; ?>"  value="<?php echo $footerTxt;  ?>" class="form-control">
                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="email_access"><?php echo $Lan['Send_Bulk_Email']; ?></label>
                            <div class="col-sm-8">
                                <select class="select2" name="email_access">
                                    <option value="1" <?php if($EmailPerm=='1'){echo 'Selected'; } ?>><?php echo $Lan['Yes']; ?></option>
                                    <option value="0" <?php if($EmailPerm=='0'){echo 'Selected'; } ?>><?php echo $Lan['No']; ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="sms_access"><?php echo $Lan['Send_Bulk_SMS']; ?></label>
                            <div class="col-sm-8">
                                <select class="select2" name="sms_access">
                                    <option value="1" <?php if($SMSPerm=='1'){echo 'Selected'; } ?>><?php echo $Lan['Yes']; ?></option>
                                    <option value="0" <?php if($SMSPerm=='0'){echo 'Selected'; } ?>><?php echo $Lan['No']; ?></option>

                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="registration"><?php echo $Lan['Client_Registration']; ?></label>
                            <div class="col-sm-8">
                                <select class="select2" name="cl_reg">
                                    <option value="1" <?php if($Cl_Reg=='1'){echo 'Selected'; } ?>><?php echo $Lan['Yes']; ?></option>
                                    <option value="0" <?php if($Cl_Reg=='0'){echo 'Selected'; } ?>><?php echo $Lan['No']; ?></option>

                                </select>
                            </div>
                        </div>






                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button class="btn btn-primary" type="submit" name="submit"><?php echo $Lan['Update']; ?></button>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane cont" id="currency">
                    <form role="form" class="form-horizontal group-border-dashed"  method="post" action="update-appconfig.php">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="country"><?php echo $Lan['Country']; ?></label>
                            <div class="col-sm-7">
                                <input type="text" required placeholder="<?php echo $Lan['Country']; ?>" name="country" id="country"  value="<?php echo appconfig('defaultcountry');  ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="currency"><?php echo $Lan['Currency']; ?></label>
                            <div class="col-sm-8">
                                <input type="text" required name="currency" id="currency" placeholder="<?php echo $Lan['Currency']; ?>"  value="<?php echo appconfig('defaultcurrency');  ?>" class="form-control">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="symbol"><?php echo $Lan['Currency_Symbol']; ?></label>
                            <div class="col-sm-8">
                                <input type="text" required name="symbol" id="symbol" placeholder="<?php echo $Lan['Currency_Symbol']; ?>"  value="<?php echo appconfig('defaultcurrencysymbol');  ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="language"><?php echo $Lan['Language']; ?></label>
                            <div class="col-sm-8">
                                <input type="text" required name="language" id="language" placeholder="<?php echo $Lan['Language']; ?>"  value="<?php echo appconfig('adminlanguage');  ?>" class="form-control">
                                <p>If you need to translate this in Other Language, you will have to create a Language Handler. Create a file with the Language Name (e.g. German.php) in <b><i class="label label-success">language</i></b> folder, copy contents from English.php and Translate it. Enter the Language Name (e.g. German) and Click Update.</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button class="btn btn-primary" type="submit" name="submit"><?php echo $Lan['Update']; ?></button>

                            </div>
                        </div>
                    </form>
                </div>





                <div class="tab-pane" id="logo">

                    <form role="form" class="form-horizontal group-border-dashed"  method="post" action="update-logo.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="logo"><?php echo $Lan['Application_Logo']; ?></label>
                            <div class="col-sm-7">
                                <img  alt=" Logo" src="<?php echo $logo; ?>" width="150px" height="44px"/>
                                <input type="file" required placeholder="<?php echo $Lan['Application_Logo']; ?>" name="myFile" id="myFile" >
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button class="btn btn-primary" type="submit" name="submit"><?php echo $Lan['Update']; ?></button>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>



</div>

</div>
</div>

<?php  require ('theme/bulk-email-footer.tpl.php'); ?>