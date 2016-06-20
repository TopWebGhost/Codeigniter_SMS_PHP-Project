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
            <h2><?php echo $Lan['Email_Providers']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['Email_Providers']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Email_Providers']; ?></h3>
                        </div>
                        <div class="content">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo $Lan['SL']; ?></th>
                                        <th><?php echo $Lan['ID']; ?></th>
                                        <th><?php echo $Lan['Provider_Name']; ?></th>
                                        <th><?php echo $Lan['Status']; ?></th>
                                        <th><?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $email_providers=ORM::for_table('email_providers')->find_many();
                                    $serial='0';

                                    foreach($email_providers as $value){
                                        $serial++;
                                        $ep_id=$value['id'];
                                        $ep_name=$value['name'];
                                        $ep_status=$value['status'];
                                        ?>

                                        <tr class="gradeA">
                                            <td><?php echo $serial; ?></td>
                                            <td><?php echo $ep_id; ?></td>
                                            <td><?php echo $ep_name; ?></td>
                                            <td>
                                                <?php
                                                if($ep_status=='1'){
                                                ?>
                                                <span class="label label-success"><?php echo $Lan['Active']; ?></span></td>
                                            <?php
                                            }else{

                                                ?>
                                                <span class="label label-danger"><?php echo $Lan['Inactive']; ?></span></td>
                                            <?php
                                            }
                                            ?>

                                            <td><a type="button" href="email-providers-manage.php?_epid=<?php echo $ep_id; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> <?php echo $Lan['Manage']; ?> </a></td>
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