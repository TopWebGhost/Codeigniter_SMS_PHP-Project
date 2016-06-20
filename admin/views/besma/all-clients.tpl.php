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
            <h2><?php echo $Lan['All_Clients']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['All_Clients']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['All_Clients']; ?></h3>

                        </div>
                        <div class="content">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo $Lan['ID']; ?></th>
                                        <th><?php echo $Lan['Name']; ?></th>
                                        <th><?php echo $Lan['Company']; ?></th>
                                        <th><?php echo $Lan['Email']; ?></th>
                                        <th><?php echo $Lan['Date_Created']; ?></th>
                                        <th><?php echo $Lan['Created_By']; ?></th>
                                        <th><?php echo $Lan['Status']; ?></th>
                                        <th><?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $client = ORM::for_table('accounts')->order_by_desc('id')->find_many();
                                    if($client->count()>0){
                                    foreach($client as $value){
                                        $status=$value['status'];
                                        $parent_id=$value['parent'];

                                        if($parent_id=='0'){
                                            $create_by='Administrator';
                                        }else{
                                            $created=ORM::for_table('accounts')->find_one($parent_id);
                                            $create_by=$created['name'].' '.$created['lname'];
                                        }

                                    ?>

                                    <tr class="gradeA">
                                        <td><?php echo $value['id']; ?></td>
                                        <td><a href="client-manage.php?_clid=<?php echo $value['id']; ?>"><?php echo $value['name'].' '.$value['lname']; ?></a></td>
                                        <td><?php echo $value['company']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['datecreated']; ?></td>
                                        <?php
                                        if($parent_id=='0'){
                                            ?>
                                            <td><?php echo $create_by; ?></td>
                                            <?php
                                        }else{
                                            ?>
                                            <td><a href="client-manage.php?_clid=<?php echo $parent_id; ?>"><?php echo $create_by; ?></a></td>
                                        <?php
                                        }
                                        ?>
                                        <td>
                                            <?php
                                            if($status=='Active'){
                                            ?>
                                            <span class="label label-success"><?php echo $Lan['Active']; ?></span>
                                                <?php
                                            }else{
                                                ?>
                                            <span class="label label-danger"><?php echo $Lan['Inactive']; ?></span>
                                                <?php
                                            }
                                                ?>
                                        </td>
                                        <td><a type="button" href="client-manage.php?_clid=<?php echo $value['id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i><?php echo $Lan['Manage']; ?> </a></td>
                                    </tr>
                                        <?php
                                    }
                                    }else{
                                        ?>
                                        <td><?php echo $Lan['No_Clients']; ?></td>
                                        <td></td>
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