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
            <h2><?php echo $Lan['All_Invoices']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['All_Invoices']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['All_Invoices']; ?></h3>
                        </div>
                        <div class="content">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo $Lan['SL']; ?></th>
                                        <th><?php echo $Lan['ID']; ?></th>
                                        <th><?php echo $Lan['Name']; ?></th>
                                        <th><?php echo $Lan['Amount']; ?></th>
                                        <th><?php echo $Lan['Date_Created']; ?></th>
                                        <th><?php echo $Lan['Status']; ?></th>
                                        <th><?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $invoices = ORM::for_table('invoices')->order_by_asc('id')->find_many();
                                    if($invoices->count()>0){
                                        $counter='0';
                                    foreach($invoices as $value){
                                        $counter++;
                                        $status=$value['status'];
                                        $userid=$value['userid'];
                                        $cl=ORM::for_table('accounts')->find_one($userid);
                                    ?>

                                    <tr class="gradeA">
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><a href="client-manage.php?_clid=<?php echo $userid; ?>"><?php echo $cl['name'].' '.$cl['lname']; ?></a></td>
                                        <td><?php echo $value['total']; ?></td>
                                        <td><?php echo $value['created']; ?></td>
                                        <td>
                                            <?php
                                            if($status=='Unpaid'){
                                            ?>
                                            <span class="label label-warning"><?php echo $Lan['Unpaid']; ?></span>
                                                <?php
                                            }elseif($status=='Paid'){
                                                ?>
                                            <span class="label label-success"><?php echo $Lan['Paid']; ?></span>
                                                <?php
                                            }else{
                                                ?>
                                                <span class="label label-danger"><?php echo $Lan['Cancelled']; ?></span>
                                                <?php
                                            }
                                                ?>
                                        </td>
                                        <td><a type="button" href="invoice-manage.php?_inid=<?php echo $value['id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i><?php echo $Lan['Manage']; ?> </a></td>
                                    </tr>
                                        <?php
                                    }
                                    }else{
                                        ?>
                                        <td><?php echo $Lan['No_Invoice']; ?></td>
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