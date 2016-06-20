<?php
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
';
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Sender_ID_Update']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li><a href="sender-id-manage.php"><?php echo $Lan['All_Sender_ID']; ?></a></li>
                <li class="active"><?php echo $Lan['Sender_ID_Update']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Sender_ID_Update']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="update-sender-id.php?_sid=<?php echo $d['id']; ?>" method="post">
                                <div class="form-group">
                                    <label for="dname" class="col-sm-3 control-label"><?php echo $Lan['Sender_ID_Name']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="s_name" name="s_name" value="<?php echo $d['s_id']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="show" class="col-sm-3 control-label"><?php echo $Lan['Block']; ?></label>
                                    <div class="col-sm-7">
                                        <div class="switch">
                                            <input type="checkbox"  name="status"  value="0" <?php if($d['status']=='0') { echo 'checked';} ?>>
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