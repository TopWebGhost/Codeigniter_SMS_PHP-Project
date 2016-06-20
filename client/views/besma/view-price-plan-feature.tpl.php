<?php
$xheader="
<link rel=\"stylesheet\" href=\"views/besma/assets/js/jquery.niftymodals/css/component.css\" />
";
$xfooter="
<script src=\"views/besma/assets/js/jquery.niftymodals/js/jquery.modalEffects.js\"></script>
    <script type=\"text/javascript\">
      $(document).ready(function(){
        $('.md-trigger').modalEffects();
      });
    </script>
";
 require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['View_SMS_Plan_Feature']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li><a href="purchase-sms-plan.php"><?php echo $Lan['Purchase_SMS_Plan']; ?></a></li>
                <li class="active"><?php echo $Lan['View_SMS_Plan_Feature']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $plan_name; ?></h3>
                        </div>
                        <div class="content">
                            <table class="no-border">
                                <thead class="no-border">
                                <tr>
                                    <th style="width:70%;"></th>
                                    <th class="text-center <?php if($popular=='1'){echo 'primary-emphasis';} ?>"><?php echo $plan_name; ?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody class="no-border-y">
                                <?php
                                $pr_plan=ORM::for_table('sms_plan_feature')->where('pid',$pid)->where('status','1')->find_many();
                                if($pr_plan->count()>0){

                                foreach($pr_plan as $value){
                                    $fname=$value['fname'];
                                    $fvalue=$value['fvalue'];
                                    ?>
                                    <tr>
                                        <td><?php echo $fname; ?></td>
                                        <td class="text-center <?php if($popular=='1'){echo 'primary-emphasis';} ?>"><?php echo $fvalue; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>


                                    <?php
                                }
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><button class="btn btn-success btn-flat md-trigger" data-modal="form-edit"><i class="fa fa-shopping-cart"></i> <?php echo $Lan['Buy_Plan']; ?></button> </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }else{
                                    ?>
                                    <tr>
                                        <td><?php echo $Lan['Have_no_Feature']; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="md-modal colored-header custom-width md-effect-9" id="form-edit">
                <form method="post" action="buy-sms-plan.php?_pid=<?php echo $pid; ?>"  />
                <div class="md-content">
                    <div class="modal-header">
                        <h3><?php echo $Lan['Payment_Method']; ?></h3>
                        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body form">
                        <div class="form-group">
                            <label><?php echo $Lan['Select_Payment_Method']; ?></label>
                            <select id="gateway" name="gateway" class="select2" data-placeholder="Click to Choose...">
                                <?php
                                $pgquery=ORM::for_table('payment_gateways')->where('status','active')->find_many();

                                foreach ($pgquery as  $value) {
                                    $name=$value['name'];
                                    $gateway=$value['settings'];

                                    ?>
                                    <option value="<?php echo $gateway; ?>"><?php echo $name; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Cancel']; ?></button>
                        <button type="submit" name="submit" class="btn btn-primary btn-flat md-close"><?php echo $Lan['Pay']; ?></button>
                    </div>
                </div>
                </form>
            </div>
            <div class="md-overlay"></div>

        </div>
    </div>

<?php  require ('theme/footer.tpl.php'); ?>