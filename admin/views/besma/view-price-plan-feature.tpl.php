<?php
$xheader="";
$xfooter='
<script src="views/besma/assets/js/jquery.datatables/jquery.datatables.min.js" type="text/javascript"></script>
    <script src="views/besma/assets/js/jquery.datatables/bootstrap-adapter/js/datatables.js" type="text/javascript"></script>
    <script src="views/besma/assets/js/jquery.nestable/jquery.nestable.js" type="text/javascript"></script>
    <script type="text/javascript">



      $(document).ready(function(){

        App.dataTables();




      $(\'.dataTables_filter input\').addClass(\'form-control\').attr(\'placeholder\',\'Search\');
      $(\'.dataTables_length select\').addClass(\'form-control\');


      });
    </script>

';
 require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['View_SMS_Plan_Feature']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li><a href="sms-price-plan.php"><?php echo $Lan['SMS_Price_Plan']; ?></a></li>
                <li class="active"><?php echo $Lan['View_SMS_Plan_Feature']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['View_SMS_Plan_Feature']; ?></h3>
                        </div>
                        <div class="content">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo $Lan['ID']; ?></th>
                                        <th><?php echo $Lan['Plan_Name']; ?></th>
                                        <th><?php echo $Lan['Feature_Name']; ?></th>
                                        <th><?php echo $Lan['Feature_Value']; ?></th>
                                        <th><?php echo $Lan['Status']; ?></th>
                                        <th><?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $fquery = ORM::for_table('sms_plan_feature')->where('pid',$pid)->find_many();
                                    if($fquery->count()>0){
                                    foreach($fquery as $value){
                                        $status=$value['status'];

                                        $pr_query=ORM::for_table('sms_price_plan')->find_one($pid);
                                        $plan_name=$pr_query['plan_name'];
                                    ?>

                                    <tr class="gradeA">
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $plan_name; ?></td>
                                        <td><?php echo $value['fname']; ?></td>
                                        <td><?php echo $value['fvalue']; ?></td>
                                        <td>
                                            <?php
                                            if($status=='1'){
                                            ?>
                                            <span class="label label-success"><?php echo $Lan['Yes']; ?></span>
                                                <?php
                                            }else{
                                                ?>
                                            <span class="label label-danger"><?php echo $Lan['No']; ?></span>
                                                <?php
                                            }
                                                ?>
                                        </td>
                                        <td>
                                            <a type="button" href="manage-sms-plan-feature.php?_fid=<?php echo $value['id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> <?php echo $Lan['Manage']; ?> </a>
                                            <a type="button" href="delete-sms-plan-feature.php?_fid=<?php echo $value['id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $Lan['Delete']; ?> </a>
                                        </td>
                                    </tr>
                                        <?php
                                    }
                                    }else{
                                        ?>
                                        <td><?php echo $Lan['Have_no_Feature']; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <?php
                                    }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

<?php  require ('theme/footer.tpl.php'); ?>