<?php

$xheader='
<link rel="stylesheet" type="text/css" href="views/besma/assets/js/fuelux/css/fuelux.css" />
<link rel="stylesheet" type="text/css" href="views/besma/assets/js/fuelux/css/fuelux-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="views/besma/assets/css/pygments.css" />
<link rel="stylesheet" type="text/css" href="views/besma/assets/js/redactor-js/redactor/redactor.css" />

';
$xfooter='
    <script src="views/besma/assets/js/jquery.parsley/parsley.js" type="text/javascript" ></script>
    <script src="views/besma/assets/js/fuelux/loader.min.js" type="text/javascript" ></script>
    <script src="views/besma/assets/js/modernizr.js" type="text/javascript" ></script>
<script src="views/besma/assets/js/invoice.js" type="text/javascript" ></script>
<script src="views/besma/assets/js/redactor-js/redactor/redactor.js" type="text/javascript" ></script>
      <script type="text/javascript">
    $(document).ready(function(){
        App.init();
      App.wizard();
      $(\'#content\').redactor();
        });
  </script>
';
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2><?php echo $Lan['Create_New_Invoice']; ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.pp"><?php echo $Lan['Home']; ?></a></li>
                <li class="active"><?php echo $Lan['Create_New_Invoice']; ?></li>
            </ol>
        </div>
        <div class="cl-mcont">
            <?php notify(); ?>
            <div class="row wizard-row">
                <div class="col-md-12 fuelux">
                    <div class="block-wizard">
                        <div id="wizard1" class="wizard wizard-ux">
                            <ul class="steps">
                                <li data-target="#step1" class="active"><?php echo $Lan['Choose_Clients']; ?><span class="chevron"></span></li>
                                <li data-target="#step2"><?php echo $Lan['Chose_Product']; ?><span class="chevron"></span></li>
                                <li data-target="#step3"><?php echo $Lan['Tax']; ?><span class="chevron"></span></li>
                                <li data-target="#step4"><?php echo $Lan['Confirm_And_Send']; ?><span class="chevron"></span></li>
                            </ul>
                            <div class="actions">
                                <button type="button" class="btn btn-xs btn-prev btn-default"> <i class="icon-arrow-left"></i><?php echo $Lan['Prev']; ?></button>
                                <button type="button" class="btn btn-xs btn-next btn-default" data-last="Finish"><?php echo $Lan['Next']; ?><i class="icon-arrow-right"></i></button>
                            </div>
                        </div>
                        <div class="step-content">
                            <form class="form-horizontal group-border-dashed" action="add-invoice.php" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate>
                                <div class="step-pane active" id="step1">
                                    <div class="form-group no-padding">
                                        <div class="col-sm-7">
                                            <h3 class="hthin"><?php echo $Lan['Choose_Clients']; ?></h3>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo $Lan['Invoice_For_Client']; ?></label>
                                        <div class="col-sm-6">
                                            <select class="select2" name="client">
                                                <?php
                                                $cquery=ORM::for_table('accounts')->find_many();
                                                foreach ($cquery as $value) {
                                                    $id=$value['id'];
                                                    $name=$value['name'].' '.$value['lname'];
                                                    ?>

                                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-default"><?php echo $Lan['Cancel']; ?></button>
                                            <button data-wizard="#wizard1" class="btn btn-primary wizard-next"><?php echo $Lan['Next_Step']; ?> <i class="fa fa-caret-right"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="step-pane" id="step2">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="block-flat">
                                                <div class="header">
                                                    <h3><?php echo $Lan['Chose_Product']; ?></h3>
                                                </div>
                                                <div class="content">
                                                    <div class="table-responsive">
                                                        <table class="table no-border hover invoice-items">
                                                            <thead>
                                                            <tr>
                                                                <th width="5%"></th>
                                                                <th width="30%"><?php echo $Lan['Item_Name']; ?></th>
                                                                <th><?php echo $Lan['Qty']; ?></th>
                                                                <th><?php echo $Lan['Price']; ?> </th>
                                                                <th width="18%"><?php echo $Lan['Total']; ?></th>
                                                                <th></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="item-row">
                                                                <td></td>
                                                                <td><input type="text" autocomplete="off" required name="description[]"    class="form-control description"></td>
                                                                <td><input type="text" autocomplete="off" required name="qty[]"  class="form-control qty"> </td>
                                                                <td><input type="text" autocomplete="off" required name="price[]"  class="form-control price" ></td>
                                                                <td><span class="amount" name="amount[]">0</span></td>
                                                                <td><button class="btn btn-success item-add"><i class="fa fa-plus"></i> <?php echo $Lan['Add_Item']; ?></button> </td>
                                                            </tr>

                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-right"><strong><?php echo $Lan['Total']; ?></strong> </td>
                                                                <td><span class="total" name="total_amount"></td>
                                                                <td></td>
                                                            </tr>


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>






                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> <?php echo $Lan['Previous']; ?></button>
                                            <button data-wizard="#wizard1" class="btn btn-primary wizard-next"><?php echo $Lan['Next_Step']; ?> <i class="fa fa-caret-right"></i></button>
                                        </div>
                                    </div>
                                </div>


                                <div class="step-pane" id="step3">
                                    <div class="form-group no-padding">
                                        <div class="col-sm-7">
                                            <h3 class="hthin"><?php echo $Lan['Tax']; ?></h3>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject" class="col-sm-3 control-label"><?php echo $Lan['Tax']; ?></label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tax" placeholder="<?php echo $Lan['Tax']; ?>">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="subject" class="col-sm-3 control-label"><?php echo $Lan['Discount']; ?></label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="discount" placeholder="<?php echo $Lan['Discount']; ?>">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>





                                    <div class="form-group">
                                        <label for="subject" class="col-sm-3 control-label"><?php echo $Lan['Notes']; ?></label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="content" name="message"></textarea>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> <?php echo $Lan['Previous']; ?></button>
                                            <button data-wizard="#wizard1" class="btn btn-primary wizard-next"><?php echo $Lan['Next_Step']; ?> <i class="fa fa-caret-right"></i></button>
                                        </div>
                                    </div>
                                </div>


                                <div class="step-pane" id="step4">
                                    <div class="form-group no-padding">
                                        <div class="col-sm-7">
                                            <h3 class="hthin"><?php echo $Lan['Confirm_And_Send']; ?></h3>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <button type="submit" class="btn btn-info btn-block " name="submit"><i class="fa fa-mail-forward"></i> <?php echo $Lan['Confirm_And_Send']; ?></button>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> <?php echo $Lan['Previous']; ?></button>

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php  require ('theme/bulk-email-footer.tpl.php'); ?>