<?php
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
';
 require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Add_Sender_ID']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li><a href="sender-id-manage.php"><?php echo $Lan['All_Sender_ID']; ?></a></li>
                <li class="active"><?php echo $Lan['Add_Sender_ID']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">

            <?php notify(); ?>

            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Add_Sender_ID']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="add-sender.php" method="post">
                                <div class="form-group">
                                    <label for="gname" class="col-sm-3 control-label"><?php echo $Lan['Sender_ID_Name']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="s_name" placeholder="Sender ID Name" name="s_name">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="submit" ><?php echo $Lan['Add']; ?></button>
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