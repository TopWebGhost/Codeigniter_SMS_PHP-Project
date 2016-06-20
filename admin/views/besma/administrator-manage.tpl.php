<?php
$xheader="
<link rel=\"stylesheet\" href=\"views/besma/assets/js/jquery.niftymodals/css/component.css\" />
<link rel=\"stylesheet\" href=\"views/besma/assets/js/jquery.crop/css/jquery.Jcrop.css\" />
";

$xfooter="

<script src=\"views/besma/assets/js/jquery.niftymodals/js/jquery.modalEffects.js\"></script>
<script src=\"views/besma/assets/js/masonry.js\"></script>
<script src=\"views/besma/assets/js/jquery.crop/js/jquery.Jcrop.js\"></script>
<script src=\"views/besma/assets/js/jquery.upload/js/jquery.iframe-transport.js\"></script>
<script src=\"views/besma/assets/js/jquery.upload/js/jquery.fileupload.js\"></script>
    <script type=\"text/javascript\">
      $(document).ready(function(){
        $('.md-trigger').modalEffects();
      });
    </script>
";

require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">

    <div class="page-head">
        <h2><?php echo $Lan['Administrator_Manage']; ?></h2>
        <ol class="breadcrumb">
            <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
            <li><a href="administrators.php"><?php echo $Lan['Administrators']; ?></a></li>
            <li class="active"><?php echo $Lan['Administrator_Manage']; ?></li>
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
                            <h1 class="name"><?php echo ucwords($amq['fname'].' '.$amq['lname']); ?></h1>
                            <p class="description">
                                <strong><?php echo $Lan['Email']; ?>: </strong> <?php echo $amq['email']; ?><br>
                                <strong><?php echo $Lan['User_Name']; ?>: </strong><?php echo $amq['username']; ?>
                            <p>
                               <button type="button" class="btn btn-info btn-large md-trigger" data-modal="form-primary"><i class="fa fa-camera-retro"></i><?php echo $Lan['Change_Image']; ?></button>
                                <button class="btn btn-danger btn-flat md-trigger" data-modal="colored-danger"><i class="fa fa-trash-o"></i><?php echo $Lan['Delete']; ?></button>
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
        <li  class="active"><a data-toggle="tab" href="#home"><?php echo $Lan['Information']; ?></a></li>
        <li><a data-toggle="tab" href="#settings"><?php echo $Lan['Settings']; ?></a></li>
    </ul>
    <div class="tab-content">
    <div id="home" class="tab-pane active  cont">
        <table class="no-border no-strip information">
            <tbody class="no-border-x no-border-y">
            <tr>
                <td style="width:20%;" class="category"><strong><?php echo $Lan['CONTACT']; ?></strong></td>
                <td>
                    <table class="no-border no-strip skills">
                        <tbody class="no-border-x no-border-y">

                        <tr><td style="width:20%;"><b><?php echo $Lan['Full_Name']; ?></b></td><td><?php echo ucwords($amq['fname'].' '.$amq['lname']); ?></td></tr>
                        <tr><td style="width:20%;"><b><?php echo $Lan['Email']; ?></b></td><td><?php echo $amq['email']; ?></td></tr>
                        <tr><td style="width:20%;"><b><?php echo $Lan['User_Name']; ?></b></td><td><?php echo $amq['username']; ?></td></tr>
                        <?php
                        $roleid=$amq['roleid'];
                        $roleq=ORM::for_table('adminroles')->find_one($roleid);
                        $rolename=$roleq['name'];

                        ?>
                        <tr><td style="width:20%;"><b><?php echo $Lan['Role']; ?></b></td><td><?php echo$rolename;  ?></td></tr>
                        <?php
                        $lastlogin=$amq['lastlogin'];
                        if ($lastlogin=='') {
                            ?>
                            <tr><td style="width:20%;"><b><?php echo $Lan['Last_Online']; ?></b></td><td><?php echo $Lan['Never_Login']; ?></td></tr>
                        <?php
                        }else{
                            ?>
                            <tr><td style="width:20%;"><b><?php echo $Lan['Last_Online']; ?></b></td><td><?php echo $lastlogin; ?></td></tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div id="settings" class="tab-pane">
        <form role="form" class="form-horizontal group-border-dashed"  method="post" action="update-administrator.php?_id=<?php echo $adid ; ?>">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="fname"><?php echo $Lan['First_Name']; ?></label>
                <div class="col-sm-9">
                    <input type="text" required placeholder="<?php echo $Lan['First_Name']; ?>" name="fname" id="fname"  value="<?php echo $amq['fname'];  ?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="lname"><?php echo $Lan['Last_Name']; ?></label>
                <div class="col-sm-9">
                    <input type="text" name="lname" id="lname"  value="<?php echo $amq['lname'];  ?>" class="form-control" placeholder="<?php echo $Lan['Last_Name']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputEmail3"><?php echo $Lan['Email']; ?></label>
                <div class="col-sm-9">
                    <input type="email" required placeholder="<?php echo $Lan['Email']; ?>" name="email" id="email" value="<?php echo $amq['email'];  ?>" class="form-control">
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label" for="Role"><?php echo $Lan['Role']; ?>:</label>
                <div class="col-sm-9">
                    <select id="role" name="role" class="select2" data-placeholder="Click to Choose...">
                        <?php
                        $cquery=ORM::for_table('adminroles')->find_many();
                        foreach ($cquery as $value) {
                            $id=$value['id'];
                            $name=$value['name'];
                            ?>

                            <option value="<?php echo $id; ?>" <?php if($id==$roleid){echo 'Selected'; } ?>><?php echo $name; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>




            <div class="form-group spacer2">
                <div class="col-sm-3"></div>
                <label class="col-sm-9" for="inputPassword3"><?php echo $Lan['Change_Password']; ?></label>

            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="password"><?php echo $Lan['Password']; ?></label>
                <div class="col-sm-9">
                    <input type="password" placeholder="<?php echo $Lan['Password']; ?>" id="password" name="password" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="rpassword"><?php echo $Lan['R_Password']; ?></label>
                <div class="col-sm-9">
                    <input type="password" placeholder="<?php echo $Lan['R_Password']; ?>" id="rpassword" name="rpassword" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button class="btn btn-primary" type="submit" name="update"><?php echo $Lan['Update']; ?></button>

                </div>
            </div>
        </form>

    </div>
    </div>
    </div>


    </div>

    </div>

    </div>

    <div class="md-modal colored-header custom-width md-effect-9" id="form-primary">
        <div class="md-content">
            <form action="upload-admin-image.php?_id=<?php echo $amq['id']; ?>" method="post" role="form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3><?php echo $Lan['Change_Image']; ?></h3>
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
            </form>
        </div>
    </div>
    <div class="md-overlay"></div>


    <div class="md-modal colored-header danger md-effect-10" id="colored-danger">
        <div class="md-content">
            <div class="modal-header">
                <h3><?php echo $Lan['Delete_Administrator']; ?></h3>
                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle danger"><i class="fa fa-check"></i></div>
                    <h4><?php echo $Lan['Hi']; ?>!</h4>
                    <p><?php echo $Lan['Want_delete_Administrator']; ?>?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['No']; ?></button>
                <a href="delete-administrator.php?_cmd=<?php echo $adid; ?>" type="button" class="btn btn-danger btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Yes']; ?></a>
            </div>
        </div>
    </div>

    <div class="md-overlay"></div>

<?php

require ('theme/footer.tpl.php');

?>