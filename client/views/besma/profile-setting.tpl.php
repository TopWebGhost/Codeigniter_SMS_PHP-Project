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
require '../lib/country.php';
require ('theme/header.tpl.php');
$clq=ORM::for_table('accounts')->find_one($cid);
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
                            <img src="<?php echo $clq['image']; ?>" class="profile-avatar" />
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="personal">
                            <h1 class="name">
                                <?php
                                $clnme=$clq['name'].' '.$clq['lname'];
                                $clname=ucwords($clnme);
                                echo $clname;
                                ?></h1>
                            <p class="description">
                                <strong><?php echo $Lan['Company']; ?>: </strong> <?php echo $clq['company']; ?><br>
                                <strong><?php echo $Lan['Address']; ?>: </strong><?php echo $clq['address1'].' '.$clq['address2'].' '.$clq['state'].' '.$clq['city'].' '.$clq['country'] ?>
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

                                    <tr><td style="width:20%;"><b><?php echo $Lan['Full_Name']; ?></b></td><td><?php echo $clq['name'].' '.$clq['lname']; ?></td></tr>
                                    <tr><td style="width:20%;"><b><?php echo $Lan['Email']; ?></b></td><td><?php echo $clq['email'];  ?></td></tr>
                                    <tr><td style="width:20%;"><b><?php echo $Lan['Phone']; ?></b></td><td><?php echo $clq['phone']; ?></td></tr>
                                    <?php
                                    if($clq['website']!=''){
                                        ?>
                                        <tr><td style="width:20%;"><b><?php echo $Lan['Website']; ?></b></td><td><?php echo $clq['website']; ?></td></tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                          <td style="width:20%;"><b><?php echo $Lan['Last_Online']; ?></b></td>
                                           <td>
                                                <?php
                                                        $lastlogin=$clq['lastlogin'];
                                                         if ($lastlogin=='') {
                                                             echo "Never Login";
                                                         }else{
                                                             echo $clq['lastlogin'];
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
                    <form role="form" class="form-horizontal group-border-dashed"  method="post" action="<?php echo 'update-client.php?_id='.$cid; ?>">

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="fname"><?php echo $Lan['First_Name']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" required placeholder="<?php echo $Lan['First_Name']; ?>" id="fname" class="form-control" name="fname" value="<?php echo $clq['name'];  ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="lname"><?php echo $Lan['Last_Name']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="<?php echo $Lan['Last_Name']; ?>" id="lname" class="form-control" name="lname" value="<?php echo $clq['lname'];  ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputEmail3"><?php echo $Lan['Email']; ?></label>
                            <div class="col-sm-9">
                                <input type="email" required placeholder="<?php echo $Lan['Email']; ?>" class="form-control" name="email" id="email"  value="<?php echo $clq['email'];  ?>">
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="company"><?php echo $Lan['Company']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" required placeholder="<?php echo $Lan['Company']; ?>" id="company" class="form-control" name="company" value="<?php echo $clq['company'];  ?>">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="Website"><?php echo $Lan['Website']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="<?php echo $Lan['Website']; ?>" name="website" id="website" value="<?php echo $clq['website'];?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="phone"><?php echo $Lan['Phone']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" required placeholder="<?php echo $Lan['Phone']; ?>" id="phone" class="form-control" name="phone" value="<?php echo $clq['phone'];  ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="address"><?php echo $Lan['Address']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" required placeholder="<?php echo $Lan['Address']; ?>" id="address" class="form-control" name="address" value="<?php echo $clq['address1'];  ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="address1"><?php echo $Lan['Address_two']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="<?php echo $Lan['Address_two']; ?>" id="address2" class="form-control" name="address2" value="<?php echo $clq['address2'];  ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="zipcode"><?php echo $Lan['Zip_Code']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" required placeholder="<?php echo $Lan['Zip_Code']; ?>" id="zipcode" class="form-control" name="zipcode" value="<?php echo $clq['postcode'];  ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="city"><?php echo $Lan['City']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" required placeholder="<?php echo $Lan['City']; ?>" id="city" class="form-control" name="city" value="<?php echo $clq['city'];  ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="country"><?php echo $Lan['Country']; ?></label>
                            <div class="col-sm-9">
                                <?php
                                $country=$clq['country'];
                                ?>
                                <select class="select2" name="country">
                                    <?php echo country::countries($country); ?>
                                </select>
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
                <form action="upload-profile-image.php?_id=<?php echo $clq['id']; ?>" method="post" role="form" enctype="multipart/form-data">
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