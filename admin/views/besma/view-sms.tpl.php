<?php
$xheader="
<link rel=\"stylesheet\" href=\"views/besma/assets/js/jquery.niftymodals/css/component.css\" />
";

$xfooter="

<script src=\"views/besma/assets/js/jquery.niftymodals/js/jquery.modalEffects.js\"></script>
    <script type=\"text/javascript\">
      $(document).ready(function(){
        $('.md-trigger').modalEffects();
      });
    </script>
";

 require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <?php notify(); ?>
        <div class="message">
            <div class="head">
                <h3><?php echo $Lan['Sender']; ?>: <?php echo $sender;?>
                    <span> <button class="btn btn-danger btn-flat md-trigger" data-modal="colored-danger"><i class="fa fa-trash-o"></i> <?php echo $Lan['Delete']; ?> </button><a class="btn btn-primary btn-flat" type="button" style="color: #fff" href="sms-history.php"><i class="fa fa-reply"></i>  <?php echo $Lan['Back_To_SMS_History']; ?></a></span></h3>
                <h3><?php echo $Lan['Receiver']; ?>: <?php echo $receiver; ?><span><i class="fa fa-clock-o"></i> <?php echo $date; ?></span></h3>
            </div>
            <div class="mail">
                <h4><?php echo $Lan['SMS']; ?>:  <span><?php echo $sms; ?></span></h4>
                <h4><?php echo $Lan['Report']; ?>:  <span><?php echo $report; ?></span></h4>
                <h4><?php echo $Lan['SMS_Count']; ?>:  <span><?php echo $amount; ?></span></h4>
                <h4><?php echo $Lan['From_IP']; ?>:  <span><?php echo $ip; ?></span></h4>

            </div>
        </div>
    </div>
    <div class="md-modal colored-header danger md-effect-10" id="colored-danger">
        <div class="md-content">
            <div class="modal-header">
                <h3><?php echo $Lan['Delete_SMS']; ?></h3>
                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle danger"><i class="fa fa-trash-o"></i></div>
                    <h4><?php echo $Lan['Confirm']; ?>!</h4>
                    <p><?php echo $Lan['Want_To_Delete_This_SMS']; ?>!</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['No']; ?></button>
                <a type="button" class="btn btn-danger btn-flat md-close" href="delete-sms.php?_sid=<?php echo $cmd; ?>"><?php echo $Lan['Yes']; ?></a>
            </div>
        </div>
    </div>
    <div class="md-overlay"></div>

<?php  

require ('theme/footer.tpl.php'); 

?>