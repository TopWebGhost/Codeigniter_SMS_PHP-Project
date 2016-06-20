<?php
require ('lib/Stripe.php');
Stripe::setApiKey('pk_test_czwzkTp2tactuLOEOqbMTRzG');
$myCard = array('number' => '4242424242424242', 'exp_month' => 5, 'exp_year' => 2015);
$charge = Stripe_Charge::create(array('card' => $myCard, 'amount' => 2000, 'currency' => 'usd'));
echo $charge;