<?php

$xheader='
<link rel="stylesheet" type="text/css" href="views/besma/assets/js/fuelux/css/fuelux.css" />
<link rel="stylesheet" type="text/css" href="views/besma/assets/js/fuelux/css/fuelux-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="views/besma/assets/css/pygments.css" />
<link rel="stylesheet" type="text/css" href="views/besma/assets/js/jquery.niftymodals/css/component.css" />
<link rel="stylesheet" type="text/css" href="views/besma/assets/js/redactor-js/redactor/redactor.css" />
';
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
    <script src="views/besma/assets/js/fuelux/loader.min.js" type="text/javascript" ></script>
    <script src="views/besma/assets/js/modernizr.js" type="text/javascript" ></script>
    <script src="views/besma/assets/js/jquery.niftymodals/js/jquery.modalEffects.js" type="text/javascript" ></script>
        <script src="views/besma/assets/js/redactor-js/redactor/redactor.js" type="text/javascript" ></script>
      <script type="text/javascript">
    $(document).ready(function(){
        App.init();
      App.wizard();
      $(\'#content\').redactor();
       $(\'.md-trigger\').modalEffects();
        });
  </script>
';
 require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Send_Email_From_File']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.pp"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['Send_Email_From_File']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row wizard-row">
                <div class="col-md-12 fuelux">
                    <div class="block-wizard">
                        <div id="wizard1" class="wizard wizard-ux">
                            <ul class="steps">
                                <li data-target="#step1" class="active"><?php echo $Lan['Choose_File']; ?><span class="chevron"></span></li>
                                <li data-target="#step2"><?php echo $Lan['Compose_Email']; ?><span class="chevron"></span></li>
                                <li data-target="#step3"><?php echo $Lan['Confirm_And_Send']; ?><span class="chevron"></span></li>
                            </ul>
                            <div class="actions">
                                <button type="button" class="btn btn-xs btn-prev btn-default"> <i class="icon-arrow-left"></i> <?php echo $Lan['Prev']; ?></button>
                                <button type="button" class="btn btn-xs btn-next btn-default" data-last="Finish"><?php echo $Lan['Next']; ?> <i class="icon-arrow-right"></i></button>
                            </div>
                        </div>
                        <div class="step-content">
                            <form class="form-horizontal group-border-dashed" action="email-send-from-file.php" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate enctype="multipart/form-data">
                                <div class="step-pane active" id="step1">
                                    <div class="form-group no-padding">
                                        <div class="col-sm-7">
                                            <h3 class="hthin"><?php echo $Lan['Choose_File']; ?></h3>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo $Lan['Choose_File']; ?></label>
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-primary btn-large md-trigger" data-modal="form-primary"><?php echo $Lan['For_Sample_File_Preview']; ?></button>
                                            <input type="file" name="uploaded_file">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo $Lan['Select_Email_Provider']; ?></label>
                                        <div class="col-sm-6">
                                            <select class="select2" name="email_provider">
                                                <option value="default"><?php echo $Lan['System_Default']; ?></option>
                                                <?php
                                                $sms_gat=ORM::for_table('email_providers')->where('status','1')->find_many();
                                                foreach($sms_gat as $sgn){
                                                    $smgtid=$sgn['id'];
                                                    $smgname=$sgn['name'];
                                                    ?>
                                                    <option value="<?php echo $smgname; ?>"><?php echo $smgname; ?></option>
                                                <?php
                                                }
                                                ?>


                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-default"><?php echo $Lan['Cancel']; ?></button>
                                            <button data-wizard="#wizard1" class="btn btn-primary wizard-next"><?php echo $Lan['Next_Step']; ?> <i class="fa fa-caret-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-pane" id="step2">
                                    <div class="form-group no-padding">
                                        <div class="col-sm-7">
                                            <h3 class="hthin"><?php echo $Lan['Compose_Email']; ?></h3>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="esubject" class="col-sm-2 control-label"><?php echo $Lan['Email_Subject']; ?></label>
                                        <div class="col-sm-8">
                                            <input type="text" required  class="form-control"  placeholder="<?php echo $Lan['Email_Subject']; ?>" name="subject" id="subject">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?php echo $Lan['Email_Message']; ?></label>
                                        <div class="col-sm-8">
                                            <textarea rows="4" class="form-control" id="content" name="message"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> <?php echo $Lan['Previous']; ?></button>
                                            <button data-wizard="#wizard1" class="btn btn-primary wizard-next"><?php echo $Lan['Next_Step']; ?> <i class="fa fa-caret-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-pane" id="step3">
                                    <div class="form-group no-padding">
                                        <div class="col-sm-7">
                                            <h3 class="hthin"><?php echo $Lan['Confirm_And_Send']; ?></h3>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <button type="submit" class="btn btn-info btn-block " name="submit"><i class="fa fa-mail-forward"></i><?php echo $Lan['Confirm_And_Send']; ?></button>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i><?php echo $Lan['Previous']; ?> </button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md-modal colored-header custom-width md-effect-9" id="form-primary">
                <div class="md-content">
                    <div class="modal-header">
                        <h3><?php echo $Lan['Sample_File_Preview']; ?></h3>
                        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body form">
                        <div class="form-group">
                            <img src="../assets/email_file/notepad.jpg"  class="profile-avatar img-thumbnail align-center">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Cancel']; ?></button>
                        <a type="button" class="btn btn-danger btn-flat md-close" href="download-file.php?_xClick=test file.txt"><?php echo $Lan['Download']; ?></a>
                    </div>
                </div>
            </div>
            <div class="md-overlay"></div>


        </div>
    </div>
<?php  require ('theme/bulk-email-footer.tpl.php'); ?>