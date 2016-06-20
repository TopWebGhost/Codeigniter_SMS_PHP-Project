<?php
$xheader='
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
      $(\'#content\').redactor();
        });
  </script>
';
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Email_Template_Manage']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li><a href="email-templates.php"><?php echo $Lan['Email_Templates']; ?></a></li>
                <li class="active"><?php echo $Lan['Email_Template_Manage']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Email_Template_Manage']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="update-email-template.php?_tplid=<?php echo $eid; ?>" method="post">


                                <div class="form-group">
                                    <label for="tname" class="col-sm-3 control-label"><?php echo $Lan['Template_Name']; ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" required  class="form-control" id="tname" placeholder="<?php echo $Lan['Template_Name']; ?>" name="tname" readonly value="<?php echo $eres['tplname']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Subject" class="col-sm-3 control-label"><?php echo $Lan['Subject']; ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" required  class="form-control" id="subject" placeholder="<?php echo $Lan['Subject']; ?>" name="subject" value="<?php echo $eres['subject']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="show" class="col-sm-3 control-label"><?php echo $Lan['Show_In_Client']; ?></label>
                                    <div class="col-sm-7">
                                        <div class="switch">
                                            <input type="checkbox"  name="clientshow"  value="Yes" <?php if($showportal=='Yes') { echo 'checked';} ?>>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="subject" class="col-sm-3 control-label"><?php echo $Lan['Message']; ?></label>
                                    <div class="col-sm-8">
                                        <textarea  class="form-control" id="content" name="message"><?php echo $eres['message']; ?></textarea>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="update" ><?php echo $Lan['Update']; ?> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

<?php  require ('theme/bulk-email-footer.tpl.php'); ?>