<?php
$xheader="
<link rel=\"stylesheet\" href=\"views/besma/assets/js/jquery.niftymodals/css/component.css\" />
";

$xfooter="

<script src=\"views/besma/assets/js/jquery.niftymodals/js/jquery.modalEffects.js\"></script>
<script src=\"views/besma/assets/js/masonry.js\"></script>
<script src=\"views/besma/assets/js/jquery.upload/js/jquery.iframe-transport.js\"></script>

    <script type=\"text/javascript\">
      $(document).ready(function(){
        $('.md-trigger').modalEffects();
      });
    </script>
";

require ('theme/header.tpl.php');
$amq=ORM::for_table('admins')->find_one($aid);
?>

    <div class="container-fluid" id="pcont">

    <div class="page-head">
        <h2><?php echo $Lan['Profile_Setting']; ?></h2>
        <ol class="breadcrumb">
            <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
            <li class="active"><?php echo $Lan['Profile_Setting']; ?></li>
        </ol>
    </div>

    <div class="cl-mcont">
    <?php notify(); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="block-flat profile-info">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="avatar">
                            <img src="<?php echo $amq['image']; ?>" class="profile-avatar" />
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="personal">
                            <h1 class="name">
                                <?php
                                $clnme=$amq['fname'].' '.$amq['lname'];
                                $clname=ucwords($clnme);
                                echo $clname;
                                ?></h1>
                            <p class="description">
                                <strong><?php echo $Lan['Email']; ?>: </strong> <?php echo $amq['email'];  ?><br>
                                <strong><?php echo $Lan['User_Name']; ?>: </strong><?php echo $amq['username'];  ?>
                            <p>
                                <button type="button" class="btn btn-primary btn-large md-trigger" data-modal="form-primary"><i class="fa fa-camera-retro"></i><?php echo $Lan['Change_Image']; ?></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




    <div class="row">
    <div class="col-sm-8">
        <div class="tab-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home"><?php echo $Lan['Information']; ?></a></li>
                <li><a data-toggle="tab" href="#settings"><?php echo $Lan['Settings']; ?></a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane active cont">
                    <table class="no-border no-strip information">
                        <tbody class="no-border-x no-border-y">
                        <tr>
                            <td style="width:20%;" class="category"><strong><?php echo $Lan['CONTACT']; ?></strong></td>
                            <td>
                                <table class="no-border no-strip skills">
                                    <tbody class="no-border-x no-border-y">

                                    <tr><td style="width:20%;"><b><?php echo $Lan['Full_Name']; ?></b></td><td><?php echo $amq['fname'].' '.$amq['lname']; ?></td></tr>
                                    <tr><td style="width:20%;"><b><?php echo $Lan['Email']; ?></b></td><td><?php echo $amq['email'];  ?></td></tr>
                                    <tr><td style="width:20%;"><b><?php echo $Lan['User_Name']; ?></b></td><td><?php echo $amq['username'];  ?></td></tr>
                                    <tr>
                                          <td style="width:20%;"><b><?php echo $Lan['Last_Online']; ?></b></td>
                                           <td>
                                                <?php
                                                        $lastlogin=$amq['lastlogin'];
                                                         if ($lastlogin=='') {
                                                             echo "Never Login";
                                                         }else{
                                                             echo $amq['lastlogin'];
                                                         }
                                                ?>
                                           </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div id="settings" class="tab-pane">
                    <form role="form" class="form-horizontal group-border-dashed"  method="post" action="profile-setting.php">

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="fname"><?php echo $Lan['First_Name']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" required placeholder="<?php echo $Lan['First_Name']; ?>" id="fname" class="form-control" name="fname" value="<?php echo $amq['fname'];  ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="lname"><?php echo $Lan['Last_Name']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="<?php echo $Lan['Last_Name']; ?>" id="lname" class="form-control" name="lname" value="<?php echo $amq['lname'];  ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputEmail3"><?php echo $Lan['Email']; ?></label>
                            <div class="col-sm-9">
                                <input type="email" placeholder="<?php echo $Lan['Email']; ?>" class="form-control" name="email" id="email"  value="<?php echo $amq['email'];  ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input name="updateprof" type="hidden" value="edit">
                                <button class="btn btn-primary" type="submit" name="update"><?php echo $Lan['Update']; ?></button>
                                <button class="btn btn-default" type="reset"><?php echo $Lan['Cancel']; ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    </div>

        <div class="md-modal colored-header custom-width md-effect-9" id="form-primary">
            <div class="md-content">
                <form action="upload-profile-image.php?_id=<?php echo $amq['id']; ?>" method="post" role="form" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h3><?php echo $Lan['Update_Profile_Image']; ?></h3>
                        <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body form">
                        <div class="form-group">
                            <input type="file" name="myFile" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Cancel']; ?></button>
                        <button class="btn btn-small btn-success" type="submit" name="avatar" ><?php echo $Lan['Upload']; ?></button>
                    </div>
            </div>
        </div>
        <div class="md-overlay"></div>

    </div>

    </div>


<?php

require ('theme/footer.tpl.php');

?>