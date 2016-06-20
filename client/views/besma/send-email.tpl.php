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
            <h2><?php echo $Lan['Send_Email']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['Send_Email']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Send_Email']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="single-email-send.php" method="post">


                                <div class="form-group">
                                    <label for="email" class="col-sm-3 control-label"><?php echo $Lan['Email']; ?></label>
                                    <div class="col-sm-8">
                                        <input type="email" required  class="form-control" id="email" placeholder="<?php echo $Lan['Email']; ?>" name="email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="subject" class="col-sm-3 control-label"><?php echo $Lan['Subject']; ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" required  class="form-control" id="subject" placeholder="<?php echo $Lan['Subject']; ?>" name="subject">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="col-sm-3 control-label"><?php echo $Lan['Message']; ?></label>
                                    <div class="col-sm-8">
                                        <textarea rows="4" class="form-control" id="content" name="message"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="submit" ><?php echo $Lan['Send_Email']; ?></button>

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