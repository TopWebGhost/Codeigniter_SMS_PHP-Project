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
            <h2> <?php echo $Lan['Payment_Gateways']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"> <?php echo $Lan['Home']; ?></a></li>
                <li class="active"> <?php echo $Lan['Payment_Gateways']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3> <?php echo $Lan['Payment_Gateways']; ?></h3>
                        </div>
                        <div class="content">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th> <?php echo $Lan['SL']; ?></th>
                                        <th> <?php echo $Lan['ID']; ?></th>
                                        <th> <?php echo $Lan['Gateway_Name']; ?></th>
                                        <th> <?php echo $Lan['Status']; ?></th>
                                        <th> <?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $pg_query = ORM::for_table('payment_gateways')->order_by_asc('id')->find_many();
                                    if($pg_query->count()>0){
                                        $counter='0';
                                    foreach($pg_query as $value){
                                        $counter++;
                                        $pgid=$value['id'];
                                        $pg_name=$value['name'];
                                        $pg_status=$value['status'];

                                    ?>

                                    <tr class="gradeA">
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $pgid; ?></td>
                                        <td><a href="payment-gateway-manage.php?_pgid=<?php echo $pgid; ?>"><?php echo $pg_name; ?></a></td>
                                        <td>
                                            <?php
                                            if($pg_status=='active'){
                                            ?>
                                            <span class="label label-success"> <?php echo $Lan['Active']; ?></span>
                                                <?php
                                            }else{
                                                ?>
                                            <span class="label label-danger"> <?php echo $Lan['Inactive']; ?></span>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td><a type="button" href="payment-gateway-manage.php?_pgid=<?php echo $pgid; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>  <?php echo $Lan['Manage']; ?> </a></td>
                                    </tr>
                                        <?php
                                    }
                                    }else{
                                        ?>
                                        <td> <?php echo $Lan['Have_no_Payment_Gateways']; ?></td>
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