<?php
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
';
 require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Email_Provider_Manage']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['Email_Provider_Manage']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Email_Provider_Manage']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="setup-email-provider.php?_epid=<?php echo $cmd; ?>" method="post">
                                <div class="form-group">
                                    <label for="gname" class="col-sm-3 control-label"><?php echo $Lan['Email_Provider_Name']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" readonly  class="form-control" id="ep_name" name="ep_name" value="<?php echo $d['name']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gname" class="col-sm-3 control-label"><?php echo $Lan['SMTP_Host_Name']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="host_name" placeholder="<?php echo $Lan['SMTP_Host_Name']; ?>" name="host_name" value="<?php echo $d['host_name']; ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="gname" class="col-sm-3 control-label"><?php echo $Lan['SMTP_Username']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="username" placeholder="<?php echo $Lan['SMTP_Username']; ?>" name="username" value="<?php echo $d['username']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gname" class="col-sm-3 control-label"><?php echo $Lan['SMTP_Password']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="password" placeholder="<?php echo $Lan['SMTP_Password']; ?>" name="password" value="<?php echo $d['password']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gname" class="col-sm-3 control-label"><?php echo $Lan['Port']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="port" placeholder="<?php echo $Lan['Port']; ?>" name="port" value="<?php echo $d['port']; ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="show" class="col-sm-3 control-label"><?php echo $Lan['Status']; ?></label>
                                    <div class="col-sm-7">
                                        <div class="switch">
                                            <input type="checkbox"  name="status"  value="1" <?php if($d['status']=='1') { echo 'checked';} ?>>
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