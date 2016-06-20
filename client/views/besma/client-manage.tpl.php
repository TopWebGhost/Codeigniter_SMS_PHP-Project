<?php
$xheader="
<link rel=\"stylesheet\" href=\"views/besma/assets/js/jquery.niftymodals/css/component.css\" />
<link rel=\"stylesheet\" href=\"views/besma/assets/js/jquery.crop/css/jquery.Jcrop.css\" />
";

$xfooter="

<script src=\"views/besma/assets/js/jquery.niftymodals/js/jquery.modalEffects.js\"></script>
<script src=\"views/besma/assets/js/masonry.js\"></script>
<script src=\"views/besma/assets/js/jquery.crop/js/jquery.Jcrop.js\"></script>
<script src=\"views/besma/assets/js/jquery.upload/js/jquery.iframe-transport.js\"></script>
<script src=\"views/besma/assets/js/jquery.upload/js/jquery.fileupload.js\"></script>
    <script type=\"text/javascript\">
      $(document).ready(function(){
        $('.md-trigger').modalEffects();
      });
    </script>
";
require '../lib/country.php';
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">

    <div class="page-head">
        <h2><?php echo $Lan['Manage_Client']; ?></h2>
        <ol class="breadcrumb">
            <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
            <li><a href="all-clients.php"><?php echo $Lan['All_Clients']; ?></a></li>
            <li class="active"><?php echo $Lan['Manage_Client']; ?></li>
        </ol>
    </div>

    <div class="cl-mcont">
    <?php notify(); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="block-flat profile-info">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="avatar">
                            <img src="<?php echo $cquery['image']; ?>" class="profile-avatar" />
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="personal">
                            <h1 class="name"><?php echo ucwords($cquery['name'].' '.$cquery['lname']); ?></h1>
                            <p class="description">
                                <strong><?php echo $Lan['Company']; ?>: </strong> <?php echo $cquery['company']; ?><br>
                                <strong><?php echo $Lan['Address']; ?>: </strong><?php echo $cquery['address1'].' '.$cquery['address2'].' '.$cquery['state'].' '.$cquery['city'].' '.$cquery['country'] ?>
                            <p>
                                <button class="btn btn-primary btn-flat md-trigger" data-modal="form-green"><i class="fa fa-envelope"></i> <?php echo $Lan['Send_Email']; ?></button>
                                <button class="btn btn-success  btn-flat btn-rad md-trigger" data-modal="form-sms"><i class="fa fa-tablet"></i> <?php  echo $Lan['Send_SMS'];?></button>
                                <button type="button" class="btn btn-info btn-large md-trigger" data-modal="form-primary"><i class="fa fa-camera-retro"></i><?php echo $Lan['Change_Image']; ?></button>
                                <button type="button" class="btn btn-warning btn-large md-trigger" data-modal="form-quota"><i class="fa fa-exchange"></i> <?php echo $Lan['Change_Quota']; ?></button>
                                <button class="btn btn-danger btn-flat md-trigger" data-modal="colored-danger"><i class="fa fa-trash-o"></i> <?php echo $Lan['Delete']; ?></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-sm-8">
    <div class="tab-container">
    <ul class="nav nav-tabs">
        <li  class="active"><a data-toggle="tab" href="#home"><?php echo $Lan['Information']; ?></a></li>
        <li><a data-toggle="tab" href="#sms_tr"><?php echo $Lan['SMS_Transaction']; ?></a></li>
        <li><a data-toggle="tab" href="#email_tr"><?php echo $Lan['Email_Transaction']; ?></a></li>
        <li><a data-toggle="tab" href="#settings"><?php echo $Lan['Settings']; ?></a></li>
    </ul>
    <div class="tab-content">
    <div id="home" class="tab-pane active  cont">
        <table class="no-border no-strip information">
            <tbody class="no-border-x no-border-y">
            <tr>
                <td style="width:20%;" class="category"><strong><?php echo $Lan['CONTACT']; ?></strong></td>
                <td>
                    <table class="no-border no-strip skills">
                        <tbody class="no-border-x no-border-y">
                        <?php
                        if($website!=''){
                            ?>
                            <tr><td style="width:20%;"><b><?php echo $Lan['Website']; ?></b></td><td><?php echo $website; ?></td></tr>
                        <?php
                        }
                        ?>
                        <tr><td style="width:20%;"><b><?php echo $Lan['Email']; ?></b></td><td><?php echo $cquery['email']; ?></td></tr>
                        <tr><td style="width:20%;"><b><?php echo $Lan['Phone']; ?></b></td><td><?php echo $cquery['phone']; ?></td></tr>
                        <tr><td style="width:20%;"><b><?php echo $Lan['Location']; ?></b></td><td><?php echo $cquery['address1'].' '.$cquery['address2'].' '.$cquery['state'].' '.$cquery['city'].' '.$cquery['postcode'].' '.$cquery['country']; ?></td></tr>
                         </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div id="sms_tr" class="tab-pane cont">

        <div class="block-flat">
            <div class="content">
                <table class="no-border">
                    <thead class="no-border">
                    <tr>
                        <th><?php echo $Lan['SL']; ?></th>
                        <th><?php echo $Lan['Quantity']; ?></th>
                        <th style="width:50%;"><?php echo $Lan['Date']; ?></th>
                    </tr>
                    </thead>
                    <tbody class="no-border-x no-border-y">
                    <?php
                    $smscount=count($sms_tr);
                    if ($smscount>0) {
                        $counter='0';
                        foreach ($sms_tr as $value) {
                            $counter++;
                            $sms_date=$value['date'];
                            $amount=$value['amount'];
                            ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td style="width:50%;"><?php echo $sms_date; ?></td>
                            </tr>
                        <?php
                        }

                    }else{
                        ?>
                        <td colspan='3'><?php echo $Lan['Have_no_sms_transaction']; ?></td>
                    <?php
                    }
                    ?>
                    </tbody>`
                </table>
            </div>


        </div>
    </div>
    <div id="email_tr" class="tab-pane cont">

        <div class="block-flat">
            <div class="content">
                <table class="no-border">
                    <thead class="no-border">
                    <tr>
                        <th><?php echo $Lan['SL']; ?></th>
                        <th><?php echo $Lan['Quantity']; ?></th>
                        <th style="width:50%;"><?php echo $Lan['Date']; ?></th>
                    </tr>
                    </thead>
                    <tbody class="no-border-x no-border-y">
                    <?php
                    $emailcount=count($email_tr);
                    if ($emailcount>0) {
                        $counter='0';
                        foreach ($email_tr as $value) {
                            $counter++;
                            $email_date=$value['date'];
                            $amount=$value['amount'];
                            ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td style="width:50%;"><?php echo $email_date; ?></td>
                            </tr>
                        <?php
                        }

                    }else{
                        ?>
                        <td colspan='3'><?php echo $Lan['Have_no_email_transaction']; ?></td>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>


    <div id="settings" class="tab-pane">
        <form role="form" class="form-horizontal group-border-dashed"  method="post" action="<?php echo 'update-client-user.php?_id='.$cmd; ?>">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="fname"><?php echo $Lan['First_Name']; ?></label>
                <div class="col-sm-9">
                    <input type="text" required placeholder="<?php echo $Lan['First_Name']; ?>" name="fname" id="fname"  value="<?php echo $cquery['name'];?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="lname"><?php echo $Lan['Last_Name']; ?></label>
                <div class="col-sm-9">
                    <input type="text" name="lname" id="lname"  value="<?php echo $cquery['lname'];?>" class="form-control" placeholder="<?php echo $Lan['Last_Name']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputEmail3"><?php echo $Lan['Email']; ?></label>
                <div class="col-sm-9">
                    <input type="email" required placeholder="<?php echo $Lan['Email']; ?>" name="email" id="email" value="<?php echo $cquery['email'];?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="company"><?php echo $Lan['Company']; ?></label>
                <div class="col-sm-9">
                    <input type="text" required  placeholder="<?php echo $Lan['Company']; ?>" name="company" id="company" value="<?php echo $cquery['company'];?>" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="Website"><?php echo $Lan['Website']; ?></label>
                <div class="col-sm-9">
                    <input type="text" placeholder="<?php echo $Lan['Website']; ?>" name="website" id="website" value="<?php echo $cquery['website'];?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="phone"><?php echo $Lan['Phone']; ?></label>
                <div class="col-sm-9">
                    <input type="tel" required placeholder="<?php echo $Lan['Phone']; ?>" name="phone" id="phone" value="<?php echo $cquery['phone'];?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="address1"><?php echo $Lan['Address']; ?></label>
                <div class="col-sm-9">
                    <input type="text" required placeholder="<?php echo $Lan['Address']; ?>" name="address" id="address" value="<?php echo $cquery['address1'];?>" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="address2"><?php echo $Lan['Address_two']; ?></label>
                <div class="col-sm-9">
                    <input type="text" placeholder="<?php echo $Lan['Address_two']; ?>" name="address2" id="address2" value="<?php echo $cquery['address2'];?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="zipcode"><?php echo $Lan['Zip_Code']; ?></label>
                <div class="col-sm-9">
                    <input type="text" required placeholder="<?php echo $Lan['Zip_Code']; ?>" name="zipcode" id="zipcode" value="<?php echo $cquery['postcode'];?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="city"><?php echo $Lan['City']; ?></label>
                <div class="col-sm-9">
                    <input type="text" required placeholder="<?php echo $Lan['City']; ?>" name="city" id="city" value="<?php echo $cquery['city'];?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="country"><?php echo $Lan['Country']; ?></label>
                <div class="col-sm-9">
                    <?php
                    $country=$cquery['country'];
                    ?>
                    <select class="select2" name="country">
                        <?php echo country::countries($country); ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="group"><?php echo $Lan['Group']; ?></label>
                <div class="col-sm-9">
                    <select class="select2" name="group">
                        <option value="0"><?php echo $Lan['None']; ?></option>
                        <?php
                        $clgroup=ORM::for_table('accgroups')->where('parent',$cid)->find_many();
                        $groupid=$cquery['groupid'];
                        $selected="selected";

                        if ($clgroup->count()> 0) {
                            foreach($clgroup as $value) {
                                $id = $value['id'];
                                $name = $value['groupname'];
                                ?>
                                <option value="<?php echo $id; ?>" <?php if ($groupid==$id){ echo $selected; } ?>><?php echo $name; ?></option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <?php
            $p_query=ORM::for_table('accounts')->find_one($cid);

             if($p_query['email_perm']=='1' OR $p_query['sms_perm']=='1' ){

             ?>



            <div class="form-group spacer2">
                <div class="col-sm-3"></div>
                <label class="col-sm-9" for="inputPassword3"><?php echo $Lan['Access_permission']; ?></label>
            </div>
                 <?php
                 if($p_query['email_perm']=='1'){
                     ?>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="email_access"><?php echo $Lan['Bulk_Email']; ?></label>
                <div class="col-sm-9">
                    <select class="select2" name="email_access">
                        <option value="1" <?php if($cquery['email_perm']=='1'){echo 'Selected'; } ?>><?php echo $Lan['Yes']; ?></option>
                        <option value="0" <?php if($cquery['email_perm']=='0'){echo 'Selected'; } ?>><?php echo $Lan['No']; ?></option>

                    </select>
                </div>
            </div>
                 <?php
                 }
                 if($p_query['sms_perm']=='1') {
                     ?>

                     <div class="form-group">
                         <label class="col-sm-3 control-label" for="sms_access"><?php echo $Lan['Bulk_SMS']; ?></label>

                         <div class="col-sm-9">
                             <select class="select2" name="sms_access">
                                 <option value="1" <?php if ($cquery['sms_perm'] == '1') {
                                     echo 'Selected';
                                 } ?>><?php echo $Lan['Yes']; ?></option>
                                 <option value="0" <?php if ($cquery['sms_perm'] == '0') {
                                     echo 'Selected';
                                 } ?>><?php echo $Lan['No']; ?></option>

                             </select>
                         </div>
                     </div>
                 <?php
                 }
             }
             ?>




            <div class="form-group spacer2">
                <div class="col-sm-3"></div>
                <label class="col-sm-9" for="inputPassword3"><?php echo $Lan['Change_Password']; ?></label>

            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="password"><?php echo $Lan['Password']; ?></label>
                <div class="col-sm-9">
                    <input type="password" placeholder="<?php echo $Lan['Password']; ?>" id="password" name="password" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="rpassword"><?php echo $Lan['R_Password']; ?></label>
                <div class="col-sm-9">
                    <input type="password" placeholder="<?php echo $Lan['R_Password']; ?>" id="rpassword" name="rpassword" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button class="btn btn-primary" type="submit" name="update"><?php echo $Lan['Update_Client']; ?></button>

                </div>
            </div>
        </form>

    </div>
    </div>
    </div>


    </div>

    <div class="col-sm-4 side-right">
        <div class="block-flat bars-widget">
            <div class="spk4 pull-right">
                <h4><?php echo $Lan['Remaining']; ?></h4>
                <h3><?php echo $email_limit; ?></h3>
            </div>
            <h4><?php echo $Lan['Total_Email_Send']; ?></h4>
            <h3><?php echo $total_email; ?></h3>
        </div>

        <div class="block-flat bars-widget">
            <div class="spk5 pull-right">
                <h4><?php echo $Lan['Remaining']; ?></h4>
                <h3><?php echo $sms_limit; ?></h3>
            </div>
            <h4><?php echo $Lan['Total_SMS_Send']; ?></h4>
            <h3><?php echo $total_sms; ?></h3>
        </div>

    </div>
    </div>

    </div>

    <div class="md-modal colored-header custom-width md-effect-9" id="form-primary">
        <div class="md-content">
            <form action="upload-image.php?_id=<?php echo $cmd ; ?>" method="post" role="form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3><?php echo $Lan['Update_Profile_Image']; ?></h3>
                    <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body form">
                    <div class="form-group">
                        <input type="file" name="myFile" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Cancel']; ?></button>
                    <button class="btn btn-small btn-success" type="submit" name="avatar" ><?php echo $Lan['Upload']; ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="md-overlay"></div>

    <div class="md-modal colored-header custom-width md-effect-9" id="form-green">
        <form class="form-horizontal group-border-dashed" autocomplete="off" action="single-email-send.php" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate accept-charset="UTF-8">
            <div class="md-content">
                <div class="modal-header">
                    <h3><?php echo $Lan['Send_Email']; ?></h3>
                    <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body form">
                    <div class="form-group">
                        <label><?php echo $Lan['Email_Subject']; ?></label> <input type="text" name="subject" class="form-control" placeholder="<?php echo $Lan['Email_Subject']; ?>">
                    </div>
                    <div class="form-group">
                        <label><?php echo $Lan['Message']; ?></label> <br><textarea name="message" style="height: 150px;width: 100%"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                      <input type="hidden" value="<?php echo $cmd; ?>" name="cmd">
                    <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Cancel']; ?></button>
                    <button type="submit" class="btn btn-primary btn-flat md-close" data-dismiss="modal" name="submit"><?php echo $Lan['Send']; ?></button>
                </div>
        </form>
    </div>
    </div>


    <div class="md-overlay"></div>


    <div class="md-modal colored-header custom-width md-effect-9" id="form-sms">
        <form class="form-horizontal group-border-dashed" autocomplete="off" action="single-sms-send.php" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate>
            <div class="md-content">
                <div class="modal-header">
                    <h3><?php echo $Lan['Send_SMS']; ?></h3>
                    <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body form">
                    <div class="form-group">
                        <label><?php echo $Lan['Sender_ID']; ?></label> <input type="text" name="sender_id" class="form-control" placeholder="<?php echo $Lan['Sender_ID']; ?>">
                    </div>
                    <div class="form-group">
                        <label><?php echo $Lan['Message']; ?></label> <br><textarea name="message" style="height: 150px;width: 100%"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" value="<?php echo $cmd; ?>" name="cmd">
                    <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Cancel']; ?></button>
                    <button type="submit" class="btn btn-primary btn-flat md-close" data-dismiss="modal" name="submit"><?php echo $Lan['Send']; ?></button>
                </div>
        </form>
    </div>
    </div>
    <div class="md-overlay"></div>




    <div class="md-modal colored-header custom-width md-effect-9" id="form-quota">
        <form class="form-horizontal group-border-dashed" action="change-quota.php?_clid=<?php echo $cmd; ?>" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate>
            <div class="md-content">
                <div class="modal-header">
                    <h3><?php echo $Lan['Change_Quota']; ?></h3>
                    <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body form">
                    <div class="form-group">
                        <label><?php echo $Lan['Add_Email_Limit']; ?></label> <input type="number" value="" name="email_limit" class="form-control" placeholder="<?php echo $Lan['Enter_Limit']; ?>">
                    </div>
                    <div class="form-group">
                        <label><?php echo $Lan['Add_SMS_Limit']; ?></label> <input type="number" value="" name="sms_limit" class="form-control" placeholder="<?php echo $Lan['Enter_Limit']; ?>">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Cancel']; ?></button>
                    <button type="submit" class="btn btn-primary btn-flat md-close" data-dismiss="modal" name="submit"><?php echo $Lan['Add']; ?></button>
                </div>
        </form>
    </div>
    </div>
    <div class="md-overlay"></div>



    <div class="md-modal colored-header danger md-effect-10" id="colored-danger">
        <div class="md-content">
            <div class="modal-header">
                <h3><?php echo $Lan['Delete_Client']; ?></h3>
                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle danger"><i class="fa fa-check"></i></div>
                    <h4><?php echo $Lan['Hi']; ?>!</h4>
                    <p><?php echo $Lan['Want_delete_Client']; ?>?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['No']; ?></button>
                <a href="delete-client.php?_cmd=<?php echo $cmd; ?>" type="button" class="btn btn-danger btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Yes']; ?></a>
            </div>
        </div>
    </div>

    <div class="md-overlay"></div>

<?php

require ('theme/footer.tpl.php');

?>