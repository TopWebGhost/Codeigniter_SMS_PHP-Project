<?php
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>

';
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['export_Client']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['export_Client']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>

            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3><?php echo $Lan['export_Client']; ?></h3>
                        </div>
                        <div class="content">


                            <form class="form-horizontal group-border-dashed" role="form" >


                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo $Lan['exportCSV']; ?></label>
                                    <div class="col-sm-6">
                                        <?php
                                        $query = "SELECT id,name,lname,company,website,email,address1,address2,state,city,postcode,country,phone,datecreated,email_gateway,sms_gateway  from accounts where parent='$cid' limit 0,1000";

                                        ?>

                                        <a href="make.php?_what=csv&amp;__use__=<?php _encode($query); ?>" class="btn btn-success  btn-large md-trigger "><i class="fa fa-list"></i> <?php echo $Lan['exportCSV']; ?></a>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

<?php  require ('theme/footer.tpl.php'); ?>