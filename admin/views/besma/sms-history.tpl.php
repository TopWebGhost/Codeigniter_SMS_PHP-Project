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
            <h2><?php echo $Lan['SMS_History']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['SMS_History']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['SMS_History']; ?></h3>
                        </div>
                        <div class="content">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" >
                                    <thead>
                                    <tr>
                                        <th><?php echo $Lan['SL']; ?></th>
                                        <th><?php echo $Lan['Sender']; ?></th>
                                        <th><?php echo $Lan['Receiver']; ?></th>
                                        <th><?php echo $Lan['SMS_Count']; ?></th>
                                        <th><?php echo $Lan['Date']; ?></th>
                                        <th><?php echo $Lan['Report']; ?></th>
                                        <th><?php echo $Lan['Actions']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sms_history = ORM::for_table('sms_history')->order_by_asc('id')->find_many();
                                    if($sms_history->count()>0){
                                        $serial='0';
                                        foreach($sms_history as $value){
                                            $serial++;
                                            $sender_raw=$value['sender'];
                                            $sender=str_replace('+',' ',$sender_raw);
                                            $receiver=$value['receiver'];
                                            $date=$value['reqlogtime'];
                                            $report=$value['report'];
                                            $amount=$value['amount'];
                                            ?>

                                            <tr class="gradeA">
                                                <td><?php echo $serial; ?></td>
                                                <td><?php echo $sender; ?></td>
                                                <td><?php echo $receiver; ?></td>
                                                <td><?php echo $amount; ?></td>
                                                <td><?php echo $date; ?></td>
                                                <td><?php echo $report; ?></td>
                                                <td><a type="button" href="view-sms.php?_sid=<?php echo $value['id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i> <?php echo $Lan['View']; ?> </a></td>
                                            </tr>
                                        <?php
                                        }
                                    }else{
                                        ?>
                                        <td><?php echo $Lan['Have_no_SMS_History']; ?></td>
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