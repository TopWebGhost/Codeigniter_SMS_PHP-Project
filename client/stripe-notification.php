<?php
require 'initapp.php';
require("../lib/payment_gateway/stripe/lib/Stripe.php");

$d= ORM::for_table('payment_gateways')->where('name', 'Stripe')->find_one();
$pk_key = $d['value'];
$secret_key = $d['extra_value'];

$amount=_post('amount');
$currency=_post('currency');
$amount=round($amount);

$stripe = array(
    "secret_key"      =>$secret_key,
    "publishable_key" =>$pk_key
);


Stripe::setApiKey($stripe['secret_key']);
$token  = $_POST['stripeToken'];


try {


    $customer = Stripe_Customer::create(array(
        "card" => $token));

    $charge = Stripe_Charge::create(array(
        'customer' =>'Customer',
        'amount' => $amount, // Amount in cents!
        'currency' => $currency,
        'card' => $token
    ));

conf('stripe-message.php','s','Your Transaction Successfully Done.');

} catch (Stripe_ApiConnectionError $e) {
    $e_json = $e->getJsonBody();
    $error = $e_json['error'];
    $message= $error['message'];
    conf("stripe-message.php","e",$message);

} catch (Stripe_InvalidRequestError $e) {
    $e_json = $e->getJsonBody();
    $error = $e_json['error'];
    $message=$error['message'];
    conf("stripe-message.php","e",$message);
} catch (Stripe_ApiError $e) {
    $e_json = $e->getJsonBody();
    $error = $e_json['error'];
    $message=$error['message'];
    conf("stripe-message.php","e",$message);

} catch (Stripe_CardError $e) {
    $e_json = $e->getJsonBody();
    $error = $e_json['error'];
    $message=$error['message'];
    conf("stripe-message.php","e",$message);
}

?>