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
                <h3><?php
                        echo $clname;
                     ?>
                   <span class="label label-success"><?php echo $Lan['Created_Date']; ?></span>
                </h3>
                <h4><?php echo $email; ?><span><i class="fa fa-clock-o"></i> <?php echo $date; ?></span></h4>
            </div>

       <?php notify(); ?>
            <div class="col-sm-6 col-md-6">
            <div class="mail">
                <h3><?php echo $Lan['Subject']; ?>:  <span><?php echo $subject; ?></span></h3>
                <p><b><?php echo $Lan['Created_By']; ?>:</b>  <span> <?php
                        if($createdby!='client' AND $createdby!=''){
                            echo $createdby;
                        }
                        else{
                            echo $clname;
                        }
                        ?></span></p>
                <p><b><?php echo $Lan['Department']; ?>:</b>  <span> <?php

                            echo $dept;
                        ?></span></p>

                <p><b><?php echo $Lan['Status']; ?>:</b>

                    <?php
                    if ($status=='Pending') {
                        ?>
                        <span class="label label-warning"><?php echo $status; ?></span>
                    <?php
                    } elseif ($status=='Answered') {
                        ?>
                        <span class="label label-info "><?php echo $status; ?></span>
                    <?php
                    }elseif($status=='Closed'){
                        ?>
                        <span class="label label-danger label-sm"><?php echo $status; ?></span>
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
                </p>
                <?php
                if ($status=='Closed') {
                    ?>

                    <p><b><?php echo $Lan['Closed_by']; ?>:</b>

                        <span class="label label-danger label-sm"><?php echo $stm['closed_by']; ?></span>
                    </p>
                <?php
                }
                ?>

<hr>

                <p><b><?php echo $Lan['Message_Body']; ?>:</b> <br><?php echo htmlspecialchars_decode(stripslashes($ticmessage)); ?> </p>
            </div>
        </div>
</div>


        <div class="col-sm-6 col-md-6">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#chat-1" data-toggle="tab"><?php echo $Lan['Reply_Ticket']; ?></a></li>
            </ul>
            <div class="tab-content no-padding">
                <div class="tab-pane active cont">
                    <div class="chat-wi">
                        <div class="chat-space nano nscroller">
                            <div class="chat-content content">
                            <?php
                            $stmf=ORM::for_table('ticketreplies')->where('tid',$cmd)->find_many();
                            $stmfcount=count($stmf);
                            if ($stmfcount>0) {
                                foreach ($stmf as $value) {
                                    $clname = $value['name'];
                                    $date= $value['date'];
                                    $message= $value['message'];
                                    $admin=$value['admin'];
                                    $clientid=$value['userid'];
                                    $climgquery=ORM::for_table('accounts')->find_one($clientid);
                                    $climage=$climgquery['image'];

                                    $adimgquery=ORM::for_table('admins')->where('username',$admin)->find_one();
                                    $admimage=$adimgquery['image'];

                                    if ($admin!='' AND $admin!='client') {
                                    ?>



                                <div class="chat-conv">
                                    <img alt="Avatar" class="c-avatar ttip" src="<?php echo $admimage; ?>"   />
                                    <div class="c-bubble">
                                        <div class="msg"><?php echo $message; ?></div>
                                        <div><small><?php echo $date; ?></small></div>
                                        <span></span>
                                    </div>
                                </div>
                                        <?php

                                    }else{
                                        ?>

                                <div class="chat-conv sent">
                                    <img alt="Avatar" class="c-avatar ttip" src="<?php echo $climage; ?>" />
                                    <div class="c-bubble">
                                        <div class="msg"><?php echo $message; ?></div>
                                        <div><small><?php echo $date; ?></small></div>
                                        <span></span>
                                    </div>
                                </div>
                                    <?php
                                    }
                                }
                            }
                                    ?>
                            </div>
                        </div>
                        <div class="chat-in">
                            <form method="post" action="support-ticket-reply.php?_stid=<?php echo $cmd; ?>">
                                <button type="submit"  name="submit" class="pull-right"><?php echo $Lan['Send']; ?></button>
                                <div class="input">
                                    <input type="text"  placeholder="Send a message..." name="message" />

                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>





    </div>


<?php

require ('theme/footer.tpl.php');

?>