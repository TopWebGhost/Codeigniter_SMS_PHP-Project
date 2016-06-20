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
            <h2><?php echo $Lan['SMS_Price_Plan']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['SMS_Price_Plan']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['SMS_Price_Plan']; ?></h3>
                        </div>
                        <div class="content">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo $Lan['SL']; ?></th>
                                        <th><?php echo $Lan['ID']; ?></th>
                                        <th><?php echo $Lan['Plan_Name']; ?></th>
                                        <th><?php echo $Lan['Price']; ?></th>
                                        <th><?php echo $Lan['Show']; ?></th>
                                        <th><?php echo $Lan['Popular']; ?></th>
                                        <th><?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $price_plan = ORM::for_table('sms_price_plan')->order_by_asc('id')->find_many();
                                    if($price_plan->count()>0){
                                        $counter='0';
                                    foreach($price_plan as $value){
                                        $counter++;
                                        $status=$value['status'];
                                        $plan_name=$value['plan_name'];
                                        $popular=$value['popular'];
                                        $price=$value['price'];
                                    ?>

                                    <tr class="gradeA">
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><a href="manage-price-plan.php?_pid=<?php echo $value['id']; ?>"><?php echo $plan_name; ?></a></td>
                                        <td><?php echo appconfig('defaultcurrencysymbol').$price; ?></td>
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
                                            <?php
                                            if($popular=='1'){
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
                                            <a type="button" href="add-price-plan-feature.php?_pid=<?php echo $value['id']; ?>" class="btn btn-success btn-xs"><i class="fa fa-plus"></i><?php echo $Lan['Add_Features']; ?> </a>
                                            <a type="button" href="view-price-plan-feature.php?_pid=<?php echo $value['id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i><?php echo $Lan['View_Features']; ?> </a>
                                            <a type="button" href="manage-price-plan.php?_pid=<?php echo $value['id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i><?php echo $Lan['Manage_Plan']; ?> </a>
                                            <a type="button" href="delete-price-plan.php?_pid=<?php echo $value['id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i><?php echo $Lan['Delete']; ?> </a>
                                        </td>
                                    </tr>
                                        <?php
                                    }
                                    }else{
                                        ?>
                                        <td><?php echo $Lan['Have_no_Price_Plan']; ?></td>
                                        <td></td>
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