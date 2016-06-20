<?php
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
';
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Support_Department_Manage']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li><a href="support-departments.php"><?php echo $Lan['Support_Departments']; ?></a></li>
                <li class="active"><?php echo $Lan['Support_Department_Manage']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Support_Department_Manage']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="update-support-department.php?_sid=<?php echo $sid; ?>" method="post">
                                <div class="form-group">
                                    <label for="dname" class="col-sm-3 control-label"><?php echo $Lan['Department_Name']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="dname" placeholder="<?php echo $Lan['Department_Name']; ?>" name="dname" value="<?php echo $sdname; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="demail" class="col-sm-3 control-label"><?php echo $Lan['Department_Email']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="email" required  class="form-control" id="demail" placeholder="<?php echo $Lan['Department_Email']; ?>" name="demail" value="<?php echo $email; ?>">
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
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="update" ><?php echo $Lan['Update_Department']; ?></button>

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