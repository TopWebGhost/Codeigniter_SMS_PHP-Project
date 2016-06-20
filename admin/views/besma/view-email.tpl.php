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
                <h3><?php if($clid=='0'){
                        echo 'Send From File';
                    }else{
                        echo $clname;
                    } ?><span> <button class="btn btn-danger btn-flat md-trigger" data-modal="colored-danger"><i class="fa fa-trash-o"></i><?php echo $Lan['Delete']; ?> </button>
                        <a class="btn btn-primary btn-flat" type="button" style="color: #fff" href="email-history.php"><i class="fa fa-reply"></i> <?php echo $Lan['Back_To_Email_History']; ?></a></span></h3>
                <h4><?php echo $email; ?><span><i class="fa fa-clock-o"></i> <?php echo $date; ?></span></h4>
            </div>
            <div class="mail">
                <h3><?php echo $Lan['Subject']; ?>:  <span><?php echo $subject; ?></span></h3>
                <p><?php echo htmlspecialchars_decode(stripslashes($message)); ?> </p>
            </div>
        </div>
    </div>
    <div class="md-modal colored-header danger md-effect-10" id="colored-danger">
        <div class="md-content">
            <div class="modal-header">
                <h3><?php echo $Lan['Delete_Email']; ?></h3>
                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle danger"><i class="fa fa-trash-o"></i></div>
                    <h4><?php echo $Lan['Confirm']; ?>!</h4>
                    <p><?php echo $Lan['Want_To_Delete_This_Email']; ?>!</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['No']; ?></button>
                <a type="button" class="btn btn-danger btn-flat md-close" href="delete-email.php?_eid=<?php echo $cmd; ?>"><?php echo $Lan['Yes']; ?></a>
            </div>
        </div>
    </div>
    <div class="md-overlay"></div>

<?php  

require ('theme/footer.tpl.php'); 

?>