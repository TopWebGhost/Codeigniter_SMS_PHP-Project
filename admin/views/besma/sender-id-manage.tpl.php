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
            <h2><?php echo $Lan['Sender_ID_Manage']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['Sender_ID_Manage']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Sender_ID_Manage']; ?></h3>
                        </div>
                        <div class="content">
                            <a href="add-new-sender-id.php" class="btn btn-success" type="button"><i class="fa fa-plus"></i><?php echo $Lan['Add_New']; ?> </a>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo $Lan['SL']; ?></th>
                                        <th><?php echo $Lan['ID']; ?></th>
                                        <th><?php echo $Lan['Sender_ID_Name']; ?></th>
                                        <th><?php echo $Lan['Status']; ?></th>
                                        <th><?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $cl=ORM::for_table('manage_sender')->find_many();
                                    $clcount=count($cl);
                                    $serial=0;
                                    if ($clcount>0) {
                                        foreach ($cl as $value) {
                                            $serial++;
                                            $id = $value['id'];
                                            $name = $value['s_id'];
                                            $show=$value['status'];
                                            ?>


                                            <tr class="gradeA">
                                                <td><?php echo $serial; ?></td>
                                                <td><?php echo $id; ?></td>
                                                <td><a href="sender-id-update.php?_sid=<?php echo $id; ?>"><?php echo $name; ?></a></td>
                                                <?php
                                                if ($show=='1') {
                                                    ?>
                                                    <td ><span class="label label-success"><?php echo $Lan['Unblock']; ?></span></td>
                                                <?php
                                                }else{
                                                    ?>
                                                    <td ><span class="label label-danger"><?php echo $Lan['Block']; ?></span></td>
                                                <?php
                                                }
                                                ?>
                                                <td>
                                                    <a href="sender-id-update.php?_sid=<?php echo $id; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> <?php echo $Lan['Manage']; ?> </a>
                                                    <a href="delete-sender-id.php?_sid=<?php echo $id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $Lan['Delete']; ?> </a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    }else{
                                        ?>
                                        <td><?php echo $Lan['Have_no_Sender_Id_for_block']; ?></td>
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