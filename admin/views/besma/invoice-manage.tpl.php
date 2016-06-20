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

    <div class="page-head">
        <h2><?php echo $Lan['Invoice_Manage']; ?></h2>
        <ol class="breadcrumb">
            <li><a href="index.php"><?php echo $Lan['Home']; ?></a></li>
            <li><a href="all-invoices.php"><?php echo $Lan['All_Invoices']; ?></a></li>
            <li class="active"><?php echo $Lan['Invoice_Manage']; ?></li>
        </ol>
    </div>

    <div class="cl-mcont">
    <?php notify(); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="block-flat profile-info">
                <div class="row">

                    <div class="col-sm-6">
                        <div class="personal">
                            <h3 class="name"><?php echo $Lan['Company_Info']; ?></h3>
                            <hr>
                            <p class="description">
                                <?php echo html_entity_decode(appconfig('caddress')); ?>
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="personal">
                            <h3 class="name"><?php echo $Lan['Customer_Info']; ?></h3>
                            <hr>
                            <p class="description">
                                <strong><?php echo $Lan['Name']; ?>: </strong> <?php echo $cl['name'].' '.$cl['lname']; ?><br>
                                <strong><?php echo $Lan['Email']; ?>: </strong><?php echo $cl['email']; ?><br>
                                <strong><?php echo $Lan['Address']; ?>: </strong><?php echo $cl['address1'].' '.$cl['address2'].' '.$cl['state'].' '.$cl['city'].' '.$cl['postcode'].' '.$cl['country']; ?><br>
                                <strong><?php echo $Lan['Date_Created']; ?>: </strong><?php echo $idate; ?><br>
                                <strong><?php echo $Lan['Paid_Date']; ?>: </strong><?php echo $paiddate; ?><br>
                                <strong><?php echo $Lan['Status']; ?>: </strong>

                                <?php
                                            if($status=='Unpaid'){
                                                ?>
                                                <span class="label label-warning"><?php echo $Lan['Unpaid']; ?></span>
                                            <?php
                                            }elseif($status=='Paid'){
                                                ?>
                                                <span class="label label-success"><?php echo $Lan['Paid']; ?></span>
                                            <?php
                                            }else{
                                                ?>
                                                <span class="label label-danger"><?php echo $Lan['Cancelled']; ?></span>
                                            <?php
                                            }
                                                ?>

                           <br>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


        <div class="block-flat">
            <div class="header">
                <h3><?php echo $Lan['Invoice_Details']; ?></h3>
            </div>
            <div class="content">
                <table class="no-border">
                    <thead class="no-border">

                          <tr>
                              <th style="width:50%;"><?php echo $Lan['Item']; ?></th>
                              <th><?php echo $Lan['Price']; ?></th>
                              <th><?php echo $Lan['Qty']; ?></th>
                              <th class="text-right"><?php echo $Lan['Amount']; ?></th>
                          </tr>




                    </thead>
                    <tbody class="no-border-y">
                    <?php
                    $ifound=ORM::for_table('invoiceitems')->where('invoiceid',$inid)->find_many();

                    foreach($ifound as $ifn){

                    ?>
                    <tr>
                        <td style="width:30%;"><?php echo $ifn['item']; ?></td>
                        <td><?php echo $ifn['price']; ?></td>
                        <td><?php echo $ifn['qty']; ?></td>
                        <td class="text-right"><?php echo $ifn['tamount'].' '.appconfig('defaultcurrencysymbol'); ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td style="width:30%;"></td>
                        <td></td>
                        <td class="text-right"><?php echo $Lan['Sub_Total']; ?> :</td>
                        <td class="text-right"><?php echo $inv['subtotal'].' '.appconfig('defaultcurrencysymbol'); ?></td>
                    </tr>

                    <tr>
                        <td style="width:30%;"></td>
                        <td></td>
                        <td class="text-right"><?php echo $Lan['Tax']; ?> :</td>
                        <td class="text-right"><?php echo $inv['tax'].' '.appconfig('defaultcurrencysymbol'); ?></td>
                    </tr>
                    <tr>
                        <td style="width:30%;"></td>
                        <td></td>
                        <td class="text-right"><?php echo $Lan['Discount']; ?> :</td>
                        <td class="text-right"><?php echo $inv['discount'].' '.appconfig('defaultcurrencysymbol'); ?></td>
                    </tr>
                    <tr>
                        <td style="width:30%;"></td>
                        <td></td>
                        <td class="text-right"><?php echo $Lan['Total']; ?> :</td>
                        <td class="text-right"><?php echo $inv['total'].' '.appconfig('defaultcurrencysymbol'); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    <div class="row">
    <div class="col-sm-12">
    <div class="block-flat profile-info">
    <div class="row">
        <div class=" pull-left">
          <label class="label label-info"><?php echo $Lan['Notes']; ?></label><br><br>


                  <?php echo $inv['note']; ?>
        </div>


</div>
</div>
</div>
</div>
    <div class="row">
    <div class="col-sm-12">
    <div class="block-flat profile-info">
    <div class="row">
<div class=" pull-right">
    <?php
    if($status!='Paid'){
        ?>
        <button type="button" class="btn btn-success btn-flat md-trigger" data-modal="form-unpaid"><i class="fa fa-check"></i><?php echo $Lan['Mark']; ?> <?php echo $Lan['Paid']; ?> </button>

        <?php
    }elseif($status!='Unpaid'){
        ?>
        <button type="button" class="btn btn-info btn-flat md-trigger" data-modal="form-paid"><i class="fa fa-check"></i><?php echo $Lan['Mark']; ?> <?php echo $Lan['Unpaid']; ?> </button>

    <?php
    }else{

    }

    if($status!='Cancelled'){
        ?>
        <button type="button" class="btn btn-warning btn-large md-trigger" data-modal="form-cancel"><i class="fa fa-times"></i><?php echo $Lan['Mark']; ?> <?php echo $Lan['Cancel']; ?> </button>

    <?php
    }
    ?>
        <button type="button" class="btn btn-info btn-large md-trigger" data-modal="form-edit"><i class="fa fa-edit"></i><?php echo $Lan['Edit']; ?></button>
        <button type="button" class="btn btn-primary btn-large md-trigger" data-modal="form-print" onclick="javascript:window.print();"><i class="fa fa-print"></i><?php echo $Lan['Print']; ?></button>
        <button class="btn btn-danger btn-flat md-trigger" data-modal="colored-danger"><i class="fa fa-trash-o"></i><?php echo $Lan['Delete']; ?></button>
</div>
</div>
</div>
</div>
</div>

    </div>

    <div class="md-modal colored-header success md-effect-10"  id="form-unpaid">
        <div class="md-content">
            <div class="modal-header">
                <h3><?php echo $Lan['Invoice_Manage']; ?></h3>
                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle success"><i class="fa fa-check"></i></div>
                    <h4><?php echo $Lan['Hi']; ?>!</h4>
                    <p><?php echo $Lan['want_to_Paid_This_Invoice']; ?>?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['No']; ?></button>
                <a href="manage.invoice.php?_status=<?php echo 'Paid'; ?>&amp;_id=<?php echo $inid; ?>" type="button" class="btn btn-success btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Yes']; ?></a>
            </div>
        </div>
    </div>
    <div class="md-overlay"></div>

    <div class="md-modal colored-header info md-effect-10"  id="form-paid">
        <div class="md-content">
            <div class="modal-header">
                <h3><?php echo $Lan['Invoice_Manage']; ?></h3>
                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle info"><i class="fa fa-check"></i></div>
                    <h4><?php echo $Lan['Hi']; ?>!</h4>
                    <p><?php echo $Lan['want_to_UnPaid_This_Invoice']; ?>?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['No']; ?></button>
                <a href="manage.invoice.php?_status=<?php echo 'Unpaid'; ?>&amp;_id=<?php echo $inid; ?>" type="button" class="btn btn-info btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Yes']; ?></a>
            </div>
        </div>
    </div>
    <div class="md-overlay"></div>


    <div class="md-modal colored-header warning md-effect-10"  id="form-cancel">
        <div class="md-content">
            <div class="modal-header">
                <h3><?php echo $Lan['Invoice_Manage']; ?></h3>
                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle warning"><i class="fa fa-check"></i></div>
                    <h4><?php echo $Lan['Hi']; ?>!</h4>
                    <p><?php echo $Lan['want_to_Cancel_This_Invoice']; ?>?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['No']; ?></button>
                <a href="manage.invoice.php?_status=<?php echo 'Cancelled'; ?>&amp;_id=<?php echo $inid; ?>" type="button" class="btn btn-warning btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Yes']; ?></a>
            </div>
        </div>
    </div>
    <div class="md-overlay"></div>



    <div class="md-modal colored-header custom-width md-effect-9" id="form-edit">
        <form method="post" action="update-invoice.php?_iid=<?php echo $inid; ?>"  />
        <div class="md-content">
            <div class="modal-header">
                <h3><?php echo $Lan['Update_Invoice']; ?></h3>
                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body form">
                <div class="form-group">
                    <label><?php echo $Lan['Invoice_For_Client']; ?></label>
                    <select id="client" name="client" class="select2" data-placeholder="Click to Choose...">
                        <?php
                        $clquery=ORM::for_table('accounts')->find_many();
                        $select='Selected';
                        foreach ($clquery as  $value) {
                            $client_id=$value['id'];

                            ?>
                            <option value="<?php echo $client_id; ?>"  <?php if ($client_id==$clid) {echo $select;} ?> ><?php echo $value['name'].' '.$value['lname']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>







                <table class="table no-border hover">
                    <thead class="no-border">
                    <tr>
                        <th width="5%"></th>
                        <th width="30%"><?php echo $Lan['Item_Name']; ?></th>
                        <th><?php echo $Lan['Qty']; ?></th>
                        <th><?php echo $Lan['Price']; ?> </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="no-border-y">

                        <?php
                        $ipr=ORM::for_table('invoiceitems')->where('invoiceid',$inid)->find_many();

                        foreach($ipr as $ifnd){

                        ?>
                        <tr>
                        <td></td>
                        <td><input type="text" autocomplete="off" required name="description[]"    class="form-control" value="<?php echo $ifnd['item']; ?>"></td>
                        <td><input type="text" autocomplete="off" required name="qty[]"  class="form-control" value="<?php echo $ifnd['qty']; ?>"> </td>
                        <td><input type="text" autocomplete="off" required name="price[]"  class="form-control" value="<?php echo $ifnd['price']; ?>"></td>
                        </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>

                <div class="form-group">
                    <label><?php echo $Lan['Tax']; ?></label>
                    <input type="text" required  class="form-control" id="tax" placeholder="<?php echo $Lan['Tax']; ?>" name="tax" value="<?php echo $inv['tax']; ?>">
                </div>
                <div class="form-group">
                    <label><?php echo $Lan['Discount']; ?></label>
                    <input type="text" required  class="form-control" id="discount" placeholder="<?php echo $Lan['Discount']; ?>" name="discount" value="<?php echo $inv['discount']; ?>">
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Cancel']; ?></button>
                <button type="submit" name="submit" class="btn btn-primary btn-flat md-close"><?php echo $Lan['Update']; ?></button>
            </div>
        </div>
        </form>
    </div>
    <div class="md-overlay"></div>



    <div class="md-modal colored-header danger md-effect-10" id="colored-danger">
        <div class="md-content">
            <div class="modal-header">
                <h3><?php echo $Lan['Delete_Invoice']; ?></h3>
                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle danger"><i class="fa fa-check"></i></div>
                    <h4><?php echo $Lan['Hi']; ?>!</h4>
                    <p><?php echo $Lan['want_to_Delete_This_Invoice']; ?>?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal"><?php echo $Lan['No']; ?></button>
                <a href="manage.invoice.php?_status=<?php echo 'Delete'; ?>&amp;_id=<?php echo $inid; ?>" type="button" class="btn btn-danger btn-flat md-close" data-dismiss="modal"><?php echo $Lan['Yes']; ?></a>
            </div>
        </div>
    </div>

    <div class="md-overlay"></div>

<?php

require ('theme/footer.tpl.php');

?>