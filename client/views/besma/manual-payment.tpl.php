<?php
require ('theme/header.tpl.php');
?>

<div class="container-fluid" id="pcont">

    <div class="page-head">
        <h2>Pay Invoice</h2>
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="all-invoices.php">All Invoices</a></li>
            <li class="active">Pay with Bank</li>
        </ol>
    </div>

    <div class="cl-mcont">
<?php notify(); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="block-flat profile-info">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="personal">
                            <h3 class="name">Bank Information</h3>
                            <hr>
                            <p class="description">
                                <?php
                                $bp=ORM::for_table('payment_gateways')->where('settings','manualpayment')->find_one();
                                $bank_details=$bp['value'];
                               echo html_entity_decode($bank_details);
                                ?>

                            </p>

                            <a href="all-invoices.php" class="btn btn-success">Back To All Invoices</a>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>





<?php

require ('theme/footer.tpl.php');

?>