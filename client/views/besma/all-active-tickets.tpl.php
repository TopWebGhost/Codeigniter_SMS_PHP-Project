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
            <h2><?php echo $Lan['All_Active_Tickets']; ?> </h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['All_Active_Tickets']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['All_Active_Tickets']; ?></h3>
                        </div>
                        <div class="content">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo $Lan['SL']; ?></th>
                                        <th><?php echo $Lan['Name']; ?></th>
                                        <th><?php echo $Lan['Email']; ?></th>
                                        <th><?php echo $Lan['Subject']; ?></th>
                                        <th><?php echo $Lan['Date']; ?></th>
                                        <th><?php echo $Lan['Status']; ?></th>
                                        <th><?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $cl=ORM::for_table('tickets')->where('status','In Progress')->where('userid',$cid)->find_many();
                                    $clcount=count($cl);
                                    $serial=0;
                                    if ($clcount>0) {
                                        foreach ($cl as $value) {
                                            $serial++;
                                            $id = $value['id'];
                                            $userid=$value['userid'];
                                            $name = $value['name'];
                                            $email=$value['email'];
                                            $subject=$value['subject'];
                                            $date=$value['date'];
                                            $status=$value['status'];
                                            ?>

                                            <tr class="gradeA">
                                                <td><?php echo $serial; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><a href="support-ticket-manage.php?_stid=<?php echo $id; ?>"><?php echo $subject; ?></a></td>
                                                <td><?php echo $date; ?></td>
                                                <td>
                                                    <?php
                                                    if ($status=='Pending') {
                                                        ?>
                                                        <span class="label label-warning"><?php echo $status; ?></span>
                                                    <?php
                                                    }elseif ($status=='Answered') {
                                                        ?>
                                                        <span class="label label-info"><?php echo $status; ?></span>
                                                    <?php
                                                    }elseif($status=='Closed'){
                                                        ?>
                                                        <span class="label label-danger"><?php echo $status; ?></span>
                                                    <?php
                                                    }elseif ($status=='In Progress') {
                                                        ?>
                                                        <span class="label label-success"><?php echo $status; ?></span>
                                                    <?php
                                                    }else{
                                                        ?>
                                                        <span class="label label-primary"><?php echo $status; ?></span>
                                                    <?php
                                                    }
                                                    ?>


                                                </td>
                                                <td><a type="button" href="support-ticket-manage.php?_stid=<?php echo $id; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> <?php echo $Lan['Manage']; ?> </a></td>
                                            </tr>
                                        <?php
                                        }
                                    }else{
                                        ?>
                                        <td><?php echo $Lan['No_Active_Support_Tickets']; ?></td>
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