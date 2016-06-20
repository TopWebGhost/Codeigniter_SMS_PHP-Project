<?php
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
';
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Add_New_Administrator']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li><a href="administrators.php"><?php echo $Lan['Administrators']; ?></a></li>
                <li class="active"><?php echo $Lan['Add_New_Administrator']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>

            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Add_New_Administrator']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="add-administrator.php" method="post">
                                <div class="form-group">
                                    <label for="fname" class="col-sm-3 control-label"><?php echo $Lan['First_Name']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="fname" placeholder="<?php echo $Lan['First_Name']; ?>" name="fname">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="fname" class="col-sm-3 control-label"><?php echo $Lan['Last_Name']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text"  class="form-control" id="lname" placeholder="<?php echo $Lan['Last_Name']; ?>" name="lname">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="Email" class="col-sm-3 control-label"><?php echo $Lan['Email']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="email" required class="form-control" id="email" name="email" placeholder="<?php echo $Lan['Email']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="col-sm-3 control-label"><?php echo $Lan['User_Name']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="username" placeholder="<?php echo $Lan['User_Name']; ?>" name="username">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-sm-3 control-label"><?php echo $Lan['Password']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="password" required class="form-control" id="password" placeholder="<?php echo $Lan['Password']; ?>" name="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password2" class="col-sm-3 control-label"><?php echo $Lan['R_Password']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="password" required class="form-control" id="password2" placeholder="<?php echo $Lan['R_Password']; ?>" name="rpassword">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $Lan['Role']; ?></label>
                                    <div class="col-sm-6">
                                        <select id="role" name="role" class="select2" data-placeholder="Click to Choose...">
                                            <?php
                                            $cquery=ORM::for_table('adminroles')->find_many();
                                            foreach ($cquery as $value) {
                                                $id=$value['id'];
                                                $name=$value['name'];
                                                ?>

                                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="submit" ><?php echo $Lan['Add_Administrator']; ?></button>
                                        <button class="btn btn-default"><?php echo $Lan['Cancel']; ?></button>
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