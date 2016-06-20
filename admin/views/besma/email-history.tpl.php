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
            <h2><?php echo $Lan['Email_History']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['Email_History']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['Email_History']; ?></h3>
                        </div>
                        <div class="content">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo $Lan['SL']; ?></th>
                                        <th><?php echo $Lan['ID']; ?></th>
                                        <th><?php echo $Lan['Email']; ?></th>
                                        <th><?php echo $Lan['Subject']; ?></th>
                                        <th><?php echo $Lan['Date']; ?></th>
                                        <th><?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $email_history = ORM::for_table('email_logs')->order_by_asc('id')->find_many();
                                    if($email_history->count()>0){
                                        $serial='0';
                                        foreach($email_history as $value){
                                            $serial++;
                                            $ehid=$value['id'];
                                            $email=$value['email'];
                                            $subject=$value['subject'];
                                            $date=$value['date'];
                                    ?>

                                    <tr class="gradeA">
                                        <td><?php echo $serial; ?></td>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><a href="view-email.php?_eid=<?php echo $value['id']; ?>"><?php echo $subject; ?></a></td>
                                        <td><?php echo $date; ?></td>
                                        <td><a type="button" href="view-email.php?_eid=<?php echo $value['id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i> <?php echo $Lan['View']; ?> </a></td>
                                    </tr>
                                        <?php
                                    }
                                    }else{
                                        ?>
                                        <td><?php echo $Lan['Have_no_Email_History']; ?></td>
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