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
                    <span>
                        <button  class="btn btn-success btn-flat md-trigger" data-modal="form-primary"><i class="fa fa-info"></i> <?php echo $Lan['Department']; ?></button>
                        <button class="btn btn-info btn-flat md-trigger" data-modal="form-status"><i class="fa fa-exchange"></i> <?php echo $Lan['Status']; ?></button>
                        <button class="btn btn-danger btn-flat md-trigger" data-modal="colored-danger"><i class="fa fa-trash-o"></i> <?php echo $Lan['Delete']; ?></button>
                    </span>
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

                    <span class="label label-danger label-sm"><?php echo $closed_by; ?></span>
                </p>
                        <?php
                    }
                        ?>
<hr>

                <p><b><?php echo $Lan['Message_Body']; ?> :</b> <br><?php echo htmlspecialchars_decode(stripslashes($ticmessage)); ?> </p>
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

                                    $adimgquery=ORM::for_table('admins')->find_one($aid);
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




        <!--Deparment Work-->

        <div class="md-modal colored-header custom-width md-effect-9" id="form-primary">
            <form method="post" action="change-support-ticket-department.php?_stid=<?php echo $cmd; ?>"  />
            <div class="md-content">
                <div class="modal-header">
                    <h3><?php echo $Lan['Change_Department']; ?></h3>
                    <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body form">
                    <div class="form-group">
                        <label><?php echo $Lan['Select_Department']; ?></label>
                        <select id="department" name="department" class="select2" data-placeholder="Click to Choose...">
                            <?php
                            $squery=ORM::for_table('supportdepartments')->find_many();
                            $select='Selected';
                            foreach ($squery as  $value) {
                                $tid=$value['id'];

                                ?>
                                <option value="<?php echo $tid; ?>"  <?php if ($tid==$sdid) {echo $select;} ?> ><?php echo $value['name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Cancel']; ?></button>
                    <button type="submit" name="submit" class="btn btn-primary btn-flat md-close"><?php echo $Lan['Update']; ?></button>
                </div>
            </div>
        </form>
        </div>
        <div class="md-modal colored-header custom-width md-effect-9" id="form-status">
            <form method="post" action="change-support-ticket-status.php?_stid=<?php echo $cmd; ?>"  />
            <div class="md-content">
                <div class="modal-header">
                    <h3><?php echo $Lan['Change_Status']; ?></h3>
                    <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body form">
                    <div class="form-group">
                        <label><?php echo $Lan['Change_Status']; ?></label>
                        <select id="status" name="status" class="select2" data-placeholder="Click to Choose...">
                            <?php
                            $select='Selected';

                            ?>
                            <option value="Pending"  <?php if ($status=='Pending') {echo $select;} ?> ><?php echo $Lan['Pending']; ?></option>
                            <option value="Answered"  <?php if ($status=='Answered') {echo $select;} ?> ><?php echo $Lan['Answered']; ?></option>
                            <option value="Customer Reply"  <?php if ($status=='Customer Reply') {echo $select;} ?> ><?php echo $Lan['Customer_Reply']; ?></option>
                            <option value="In Progress"  <?php if ($status=='In Progress') {echo $select;} ?> ><?php echo $Lan['In_Progress']; ?></option>
                            <option value="Closed"  <?php if ($status=='Closed') {echo $select;} ?> ><?php echo $Lan['Closed']; ?></option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Cancel']; ?></button>
                    <button type="submit" name="submit" class="btn btn-primary btn-flat md-close"><?php echo $Lan['Update']; ?></button>
                </div>
            </div>
        </form>
        </div>

        <div class="md-modal colored-header danger md-effect-10" id="colored-danger">
            <div class="md-content">
                <div class="modal-header">
                    <h3>Delete Support Ticket</h3>
                    <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="i-circle danger"><i class="fa fa-check"></i></div>
                        <h4><?php echo $Lan['Hi']; ?>!</h4>
                        <p><?php echo $Lan['Want_Delete_Support_Ticket']; ?>!</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['No']; ?></button>
                    <a href="delete-support-department-ticket.php?_stid=<?php echo $cmd; ?>" class="btn btn-danger btn-flat md-close"><?php echo $Lan['Yes']; ?></a>
                </div>
            </div>
        </div>


        <div class="md-overlay"></div>

    </div>


<?php

require ('theme/footer.tpl.php');

?>