<?php
$xheader='
 <link href="views/besma/assets/js/jquery.icheck/skins/square/blue.css" rel="stylesheet">
 <link rel="stylesheet" href="views/besma/assets/js/jquery.niftymodals/css/component.css" />
';
$xfooter='
<script src="views/besma/assets/js/jquery.icheck/icheck.min.js" type="text/javascript"></script>

<script src="views/besma/assets/js/jquery.niftymodals/js/jquery.modalEffects.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(\'.md-trigger\').modalEffects();
      });
    </script>
';
require ('theme/header.tpl.php');
?>

<div class="container-fluid" id="pcont">


<div class="page-head">
    <h2><?php echo $Lan['Administrator_Role_Manage']; ?></h2>
    <span> <button class="btn btn-danger btn-flat md-trigger pull-right" data-modal="colored-danger"><i class="fa fa-trash-o"></i> <?php echo $Lan['Delete_Administrator_Role']; ?></button>
    <ol class="breadcrumb">
        <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
        <li><a href="administrators-role.php"><?php echo $Lan['Administrators_Role']; ?></a></li>
        <li class="active"><?php echo $Lan['Administrator_Role_Manage']; ?></li>
    </ol>
</div>
<div class="cl-mcont">


    <?php notify(); ?>

<div class="row">
<div class="col-md-12">


<div class="block-flat">
    <div class="header">
        <h3><?php echo $rname; ?></h3>
    </div>
    <div class="content">
        <form class="form-horizontal group-border-dashed" action="edit.administrator-role-manage.php?_rid=<?php echo $roleid; ?>" style="border-radius: 0px;" method="post">

            <div class="form-group">
                <label><?php echo $Lan['Role_Name']; ?></label> <input type="text" name="rname" placeholder="Enter Role Name" class="form-control" value="<?php echo $rname; ?>">
            </div>


            <div class="form-group">

                <div class="col-sm-6">

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="1"  <?php if (permission($roleid,'1')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Dashboard']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="2"  <?php if (permission($roleid,'2')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['All_Clients']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="3"  <?php if (permission($roleid,'3')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Add_New_Client']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="4"  <?php if (permission($roleid,'4')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Client_Manage']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="5"  <?php if (permission($roleid,'5')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['All_Groups']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="6"  <?php if (permission($roleid,'6')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Add_New_Group']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="7"  <?php if (permission($roleid,'7')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Client_Group_Manage']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="8"  <?php if (permission($roleid,'8')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Send_Bulk_Email']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="9"  <?php if (permission($roleid,'9')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Send_Email_From_File']; ?> </label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="10"  <?php if (permission($roleid,'10')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Email_History']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="11"  <?php if (permission($roleid,'11')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['View_Email']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="12"  <?php if (permission($roleid,'12')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Send_Bulk_SMS']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="13"  <?php if (permission($roleid,'13')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Send_SMS_From_File']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="14"  <?php if (permission($roleid,'14')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['SMS_History']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="15"  <?php if (permission($roleid,'15')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['View_SMS']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="16"  <?php if (permission($roleid,'16')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['SMS_API_Setup']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="17"  <?php if (permission($roleid,'17')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['All_Active_Tickets']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="18"  <?php if (permission($roleid,'18')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['All_Pending_Tickets']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="19"  <?php if (permission($roleid,'19')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['All_Answered_Tickets']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="20"  <?php if (permission($roleid,'20')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['All_Closed_Tickets']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="21"  <?php if (permission($roleid,'21')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['All_Support_Tickets']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="22"  <?php if (permission($roleid,'22')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Create_New_Ticket']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="23"  <?php if (permission($roleid,'23')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Support_Ticket_Manage']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="24"  <?php if (permission($roleid,'24')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Support_Departments']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="25"  <?php if (permission($roleid,'25')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Add_New_Support_Department']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="26"  <?php if (permission($roleid,'26')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Support_Department_Manage']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="27"  <?php if (permission($roleid,'27')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Administrators']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="28"  <?php if (permission($roleid,'28')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Add_New_Administrator']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="29"  <?php if (permission($roleid,'29')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Administrator_Manage']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="30"  <?php if (permission($roleid,'30')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Administrators_Role']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="31"  <?php if (permission($roleid,'31')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Add_New_Administrator_Role']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="32"  <?php if (permission($roleid,'32')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Administrator_Role_Manage']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="33"  <?php if (permission($roleid,'33')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['System_Settings']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="34"  <?php if (permission($roleid,'34')) { echo 'checked="checked"'; } ?> class="icheck "> <?php echo $Lan['Email_Templates']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="35"  <?php if (permission($roleid,'35')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Email_Templates_Manage']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="36"  <?php if (permission($roleid,'36')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Email_Providers']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="37"  <?php if (permission($roleid,'37')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Email_Provider_Manage']; ?></label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="38"  <?php if (permission($roleid,'38')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['SMS_Gateway']; ?> </label>
                    </div>
                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="39"  <?php if (permission($roleid,'39')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['SMS_Gateway_Manage']; ?></label>
                    </div>                    

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="40"  <?php if (permission($roleid,'40')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['All_Invoices']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="41"  <?php if (permission($roleid,'41')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Create_New_Invoice']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="42"  <?php if (permission($roleid,'42')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Invoice_Manage']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="43"  <?php if (permission($roleid,'43')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['SMS_Price_Plan']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="44"  <?php if (permission($roleid,'44')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Add_SMS_Price_Plan']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="45"  <?php if (permission($roleid,'45')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Manage_SMS_Price_Plan']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="46"  <?php if (permission($roleid,'46')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Add_SMS_Price_Plan_Feature']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="47"  <?php if (permission($roleid,'47')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Manage_SMS_Price_Plan_Feature']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="48"  <?php if (permission($roleid,'48')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['View_SMS_Price_Plan_Feature']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="49"  <?php if (permission($roleid,'49')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Payment_Gateways']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="50"  <?php if (permission($roleid,'50')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Payment_Gateway_Manage']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="51"  <?php if (permission($roleid,'51')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['send_schedule_sms']; ?></label>
                    </div>


                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="52"  <?php if (permission($roleid,'52')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['schedule_sms_from_file']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="53"  <?php if (permission($roleid,'53')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Coverage']; ?></label>
                    </div>

                    <div class="radio">
                        <label> <input type="checkbox" name="perms[]" value="54"  <?php if (permission($roleid,'54')) { echo 'checked="checked"'; } ?> class="icheck"> <?php echo $Lan['Sender_ID_Manage']; ?></label>
                    </div>


                </div>
            </div>
            <br>
            <button class="btn btn-primary center" type="submit" name="edit" ><?php echo $Lan['Save_Changes']; ?></button>
            <br>
            <br>
        </form>
    </div>
</div>



</div>
</div>

    <div class="md-modal colored-header danger md-effect-10" id="colored-danger">
        <div class="md-content">
            <div class="modal-header">
                <h3><?php echo $Lan['Delete_Administrator_Role']; ?></h3>
                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle danger"><i class="fa fa-trash-o"></i></div>
                    <h4><?php echo $Lan['Confirm']; ?>!</h4>
                    <p><?php echo $Lan['Want_To_Delete_This_Administrator_Role']; ?>!</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['No']; ?></button>
                <a type="button" class="btn btn-danger btn-flat md-close" href="delete-administrator-role.php?_rid=<?php echo $roleid; ?>"><?php echo $Lan['Yes']; ?></a>
            </div>
        </div>
    </div>
    <div class="md-overlay"></div>

</div>
</div>

<?php  require ('theme/footer.tpl.php'); ?>