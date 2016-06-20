<?php
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
';
require '../lib/country.php';
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Add New Coverage</h2>
            <ol class="breadcrumb">
                <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
                <li><a href="coverage.php">Coverage</a></li>
                <li class="active">Add New Coverage</li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>

            <div class="row">


                <div class="col-sm-12 col-md-12">
                    <div class="block-flat">
                        <div class="header">
                            <h3>Add New Coverage</h3>
                        </div>
                        <div class="content">
                        <form class="form-horizontal group-border-dashed" role="form"  parsley-validate novalidate action="add-coverage.php" method="post">

                        <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $Lan['Country']; ?></label>
                        <div class="col-sm-6">
                               <select name="country" class="select2" required>
                                   <?php echo country::besma_countries(appconfig('defaultcountry')) ?>
                                    </select>
                        </div>
                        </div>


                        <div class="form-group">
                            <label for="fname" class="col-sm-3 control-label">Operator Name</label>
                            <div class="col-sm-7">
                                <input type="text" required class="form-control" id="operator" placeholder="Operator Name" name="operator">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="fname" class="col-sm-3 control-label">Country Code</label>
                            <div class="col-sm-7">
                                <input type="text" required  class="form-control" id="c_code" placeholder="Country Code" name="c_code">
                                <span class="help-block">Country Code Of Bangladesh is 880. Please Insert you country code </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fname" class="col-sm-3 control-label">Operator Code</label>
                            <div class="col-sm-7">
                                <input type="text" required  class="form-control" id="op_code" placeholder="Operator Code" name="op_code">
                                <span class="help-block">Operator Code Of Grammen Phone Bangladesh is 17. Please Insert you operator code </span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="fname" class="col-sm-3 control-label">Price</label>
                            <div class="col-sm-7">
                                <input type="text"  required class="form-control" id="price" placeholder="Price" name="price">
                                <span class="help-block">Cost For Per SMS </span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="show" class="col-sm-3 control-label"><?php echo $Lan['Status']; ?></label>
                            <div class="col-sm-7">
                                <div class="switch">
                                    <input type="checkbox" required name="status"  value="1" checked>
                                </div>
                            </div>
                        </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="submit" >Add Coverage</button>
                                        <button type="reset" class="btn btn-default"><?php echo $Lan['Cancel']; ?></button>
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