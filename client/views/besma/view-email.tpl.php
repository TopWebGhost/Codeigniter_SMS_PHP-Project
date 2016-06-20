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
                <h3><?php if($clid=='0'){
                        echo 'Send From File';
                    }else{
                        echo $clname;
                    } ?><span><a class="btn btn-primary btn-flat" type="button" style="color: #fff" href="email-history.php"><i class="fa fa-reply"></i> <?php echo $Lan['Back_To_Email_History']; ?></a></span></h3>
                <h4><?php echo $email; ?><span><i class="fa fa-clock-o"></i> <?php echo $date; ?></span></h4>
            </div>
            <div class="mail">
                <h3><?php echo $Lan['Subject']; ?>:  <span><?php echo $subject; ?></span></h3>
                <p><?php echo htmlspecialchars_decode(stripslashes($message)); ?> </p>
            </div>
        </div>
    </div>


<?php  

require ('theme/footer.tpl.php'); 

?>