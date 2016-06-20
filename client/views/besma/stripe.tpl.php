<?php
require ('theme/header.tpl.php');
?>

    <div class="container-fluid" id="pcont">

    <div class="page-head">
        <h2>Pay Invoice</h2>
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="all-invoices.php">All Invoices</a></li>
            <li class="active">Pay with Credit Card</li>
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
                            <h3 class="name">Pay With Credit Card</h3>
                            <hr>
                            <p class="description">

                            <form action="stripe-notification.php" method="POST">

                                    <h5>Item Name: <?php echo $item; ?></h5>
                                    <h5>Invoice ID: <?php echo $invoiceid; ?></h5>
                                    <h5>Amount: <?php echo appconfig('defaultcurrencysymbol'). ' '. $amount; ?></h5>
                                    <script
                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                        data-key="<?php echo $pkey; ?>"
                                        data-amount="<?php echo $stripeamount; ?>"
                                        data-currency="<?php echo appconfig('defaultcurrency'); ?>"
                                        data-name="<?php echo $item; ?>"
                                        data-description="Invoice: <?php echo $invoiceid; ?>"
                                        data-image="../assets/uploads/logo.png">
                                    </script>
                                <input type="hidden" value="<?php echo $amount; ?>" name="amount">
                                <input type="hidden" value="<?php echo  appconfig('defaultcurrency'); ?>" name="currency">
                            </form>
                            </p>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>





<?php

require ('theme/footer.tpl.php');

?>