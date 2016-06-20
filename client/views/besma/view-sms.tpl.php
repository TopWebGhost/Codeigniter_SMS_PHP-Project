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
        <div class="message">
            <div class="head">
                <h3><?php echo $Lan['Sender']; ?>: <?php echo $sender;?>
                    <span> <a class="btn btn-primary btn-flat" type="button" style="color: #fff" href="sms-history.php"><i class="fa fa-reply"></i> <?php echo $Lan['Back_To_SMS_History']; ?></a></span></h3>
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

<?php  

require ('theme/footer.tpl.php'); 

?>