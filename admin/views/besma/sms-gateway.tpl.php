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
            <h2><?php echo $Lan['SMS_Gateway']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['SMS_Gateway']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['SMS_Gateway']; ?></h3>
                        </div>
                        <div class="content">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo $Lan['SL']; ?></th>
                                        <th><?php echo $Lan['ID']; ?></th>
                                        <th><?php echo $Lan['Gateway_Name']; ?></th>
                                        <th><?php echo $Lan['Schedule_SMS']; ?></th>
                                        <th><?php echo $Lan['Status']; ?></th>
                                        <th><?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $sms_gateway=ORM::for_table('sms_gateway')->find_many();
                                    $serial='0';

                                    foreach($sms_gateway as $value){
                                        $serial++;
                                        $gat_id=$value['id'];
                                        $gat_name=$value['name'];
                                        $gat_status=$value['status'];
                                        $sms_credit=$value['credit'];
                                        $schedule=$value['schedule'];
                                        ?>

                                        <tr class="gradeA">
                                            <td><?php echo $serial; ?></td>
                                            <td><?php echo $gat_id; ?></td>
                                            <td><?php echo $gat_name; ?></td>
                                            <td>
                                                <?php
                                                if($schedule=='Yes'){
                                                ?>
                                                <span class="label label-success"><?php echo $Lan['Yes']; ?></span></td>
                                            <?php
                                            }else{

                                                ?>
                                                <span class="label label-danger"><?php echo $Lan['No']; ?></span></td>
                                            <?php
                                            }
                                            ?>
                                            <td>
                                                <?php
                                                if($gat_status=='Active'){
                                                ?>
                                                <span class="label label-success"><?php echo $Lan['Active']; ?></span></td>
                                            <?php
                                            }else{

                                                ?>
                                                <span class="label label-danger"><?php echo $Lan['Inactive']; ?></span></td>
                                            <?php
                                            }
                                            ?>

                                            <td><a type="button" href="sms-gateway-manage.php?_sgid=<?php echo $gat_id; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> <?php echo $Lan['Manage']; ?> </a></td>
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
            </div>



        </div>
    </div>

<?php  require ('theme/footer.tpl.php'); ?>