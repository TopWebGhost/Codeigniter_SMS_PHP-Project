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
            <h2><?php echo $Lan['Administrators_Role']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['Administrators_Role']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Administrators_Role']; ?></h3>
                        </div>
                        <div class="content">
                            <a href="add-new-administrator-role.php" class="btn btn-success" type="button"><i class="fa fa-plus"></i> <?php echo $Lan['Add_New']; ?></a>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo $Lan['SL']; ?></th>
                                        <th><?php echo $Lan['ID']; ?></th>
                                        <th><?php echo $Lan['Role_Name']; ?></th>
                                        <th><?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $cl= ORM::for_table('adminroles')->order_by_asc('id')->find_many();
                                    $clcount=count($cl);
                                    $serial=0;
                                    if ($clcount>0) {
                                        foreach ($cl as $value) {
                                            $serial++;
                                            $id = $value['id'];
                                            $name = $value['name'];
                                            ?>

                                            <tr class="gradeA">
                                                <td><?php echo $serial;?></td>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><a type="button" href="administrator-role-manage.php?_rid=<?php echo $id; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> <?php echo $Lan['Manage']; ?> </a></td>
                                            </tr>
                                        <?php
                                        }
                                    }else{
                                        ?>
                                        <td><?php echo $Lan['No_Administrators_role']; ?></td>
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