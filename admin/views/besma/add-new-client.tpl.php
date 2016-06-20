<?php
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
';
 require '../lib/country.php';
 require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Add_New_Client']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li><a href="all-clients.php"><?php echo $Lan['All_Clients']; ?></a></li>
                <li class="active"><?php echo $Lan['Add_New_Client']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>

            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Add_New_Client']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="add-client.php" method="post">
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
                                    <label for="company" class="col-sm-3 control-label"><?php echo $Lan['Company']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text"  required class="form-control" id="company" placeholder="<?php echo $Lan['Company']; ?>" name="company">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="website" class="col-sm-3 control-label"><?php echo $Lan['Website']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="website" placeholder="<?php echo $Lan['Website']; ?>" name="website">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Address" class="col-sm-3 control-label"><?php echo $Lan['Address']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="address1" placeholder="<?php echo $Lan['Address']; ?>" name="address1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address2" class="col-sm-3 control-label"><?php echo $Lan['Address_two']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text"  class="form-control" id="address2" placeholder="<?php echo $Lan['Address_two']; ?>" name="address2">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="City" class="col-sm-3 control-label"><?php echo $Lan['City']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text"  required class="form-control" id="city" placeholder="<?php echo $Lan['City']; ?>" name="city">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="State" class="col-sm-3 control-label"><?php echo $Lan['State']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="state" placeholder="<?php echo $Lan['State']; ?>" name="state">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Zip" class="col-sm-3 control-label"><?php echo $Lan['Zip_Code']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="zip" placeholder="<?php echo $Lan['Zip_Code']; ?>" name="zip">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $Lan['Country']; ?></label>
                                    <div class="col-sm-6">
                                        <select class="select2" name="country">
                                            <?php echo country::countries(appconfig('defaultcountrycode')) ?>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="phone" class="col-sm-3 control-label"><?php echo $Lan['Phone']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" required  class="form-control" id="phone" placeholder="<?php echo $Lan['Phone']; ?>" name="phone">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Email" class="col-sm-3 control-label"><?php echo $Lan['Email']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="email" required class="form-control" id="email" name="email" placeholder="<?php echo $Lan['Email']; ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="password" class="col-sm-3 control-label"><?php echo $Lan['Password']; ?></label>
                                    <div class="col-sm-7">
                                        <input type="password" required class="form-control" id="password" placeholder="<?php echo $Lan['Password']; ?>" name="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $Lan['Group']; ?></label>
                                    <div class="col-sm-6">
                                        <select class="select2" name="group">
                                            <option value="0"><?php echo $Lan['None']; ?></option>
                                            <?php
                                            $clgroup=ORM::for_table('accgroups')->find_many();
                                            if ($clgroup->count()> 0) {
                                                foreach($clgroup as $value) {
                                                    $id = $value['id'];
                                                    $name = $value['groupname'];
                                                    ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>




                                <div class="form-group spacer2">
                                    <div class="col-sm-3"></div>
                                    <label class="col-sm-9" for="inputPassword3"><?php echo $Lan['Access_permission']; ?></label>

                                </div>



                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="email_access"><?php echo $Lan['Bulk_Email']; ?></label>
                                    <div class="col-sm-6">
                                        <select class="select2" name="email_access">
                                            <option value="1" <?php if($cquery['email_perm']=='1'){echo 'Selected'; } ?>><?php echo $Lan['Yes']; ?></option>
                                            <option value="0" <?php if($cquery['email_perm']=='0'){echo 'Selected'; } ?>><?php echo $Lan['No']; ?></option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="sms_access"><?php echo $Lan['Bulk_SMS']; ?></label>
                                    <div class="col-sm-6">
                                        <select class="select2" name="sms_access">
                                            <option value="1" <?php if($cquery['sms_perm']=='1'){echo 'Selected'; } ?>><?php echo $Lan['Yes']; ?></option>
                                            <option value="0" <?php if($cquery['sms_perm']=='0'){echo 'Selected'; } ?>><?php echo $Lan['No']; ?></option>

                                        </select>
                                    </div>
                                </div>




                                <div class="form-group spacer2">
                                    <div class="col-sm-3"></div>
                                    <label class="col-sm-9" for="inputPassword3"><?php echo $Lan['Default_Gateway']; ?></label>

                                </div>



                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $Lan['Default_Email_Gateway']; ?></label>
                                    <div class="col-sm-6">
                                        <select class="select2" name="email_gateway">
                                            <option value="0"><?php echo $Lan['None']; ?></option>
                                            <?php
                                            $clgroup=ORM::for_table('email_providers')->where('status','1')->find_many();
                                            if ($clgroup->count()> 0) {
                                                foreach($clgroup as $value) {
                                                    $name = $value['name'];
                                                    ?>
                                                    <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $Lan['Default_SMS_Gateway']; ?></label>
                                    <div class="col-sm-6">
                                        <select class="select2" name="sms_gateway">
                                            <option value="0"><?php echo $Lan['None']; ?></option>
                                            <?php
                                            $clgroup=ORM::for_table('sms_gateway')->where('status','Active')->find_many();
                                            if ($clgroup->count()> 0) {
                                                foreach($clgroup as $value) {
                                                    $name = $value['name'];
                                                    ?>
                                                    <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="submit" ><?php echo $Lan['Add_Client']; ?></button>
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