<?php
require("autoload.php");

$d= ORM::for_table('payment_gateways')->where('name', 'Authorize.net')->find_one();

if($xstage=='Demo' OR $xstage=='Production'){
    $url='https://test.authorize.net/gateway/transact.dll';
    $testMode = "true";
}else{
    $url = 'https://secure.authorize.net/gateway/transact.dll';
    $testMode = "false";
}

$api_login_id=$d['value'];
$transaction_key=$d['extra_value'];

$description = "Invoice Payment - $invoiceid";
$sequence = rand(1, 1000);
$timeStamp = time();
$sysUrl= appconfig('sysUrl');
$redirect_url=$sysUrl.'/client/all-invoices.php';


define("AUTHORIZENET_API_LOGIN_ID", $api_login_id);
define("AUTHORIZENET_TRANSACTION_KEY", $transaction_key);

$sale           = new AuthorizeNetAIM;
$sale->amount   = $amount;
$response = $sale->authorizeAndCapture();

if ($response->approved) {

if (phpversion() >= '5.1.2') {
    $fingerprint = hash_hmac("md5", $api_login_id . "^" . $sequence . "^" . $timeStamp . "^" . $amount . "^", $transaction_key);
} else {
    $fingerprint = bin2hex(mhash(MHASH_MD5, $api_login_id . "^" . $sequence . "^" . $timeStamp . "^" . $amount . "^", $transaction_key));
}

$params = array(
    array('name' => "x_login",
        'value' => $api_login_id
    ),
    array('name' => "x_amount",
        'value' => $amount
    ),
    array('name' => "x_description",
        'value' => $description
    ),
    array('name' => "x_invoice_num",
        'value' => $invoiceid
    ),
    array('name' => "x_fp_sequence",
        'value' => $sequence
    ),
    array('name' => "x_fp_timestamp",
        'value' => $timeStamp
    ),
    array('name' => "x_fp_hash",
        'value' => $fingerprint
    ),
    array('name' => "x_test_request",
        'value' => $testMode
    ),
    array('name' => "x_receipt_link_text",
        'value' => "Click Here To Return your System"
    ),
    array('name' => "x_receipt_link_URL",
        'value' => $redirect_url
    ),
    array('name' => "x_show_form",
        'value' => "PAYMENT_FORM"
    )
);

$append = '';

foreach ($params as $param) {
    $append .= '<input type="hidden" name="' . $param['name'] . '" value="' . $param['value'] . '">';
}

$x = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Please wait while you\'re redirected</title>
<style type="text/css">

          .heading{height:15px}
          #sysfrm-container{background:#f1f1f1;font-family:Helvetica,Arial,sans-serif}
          #sysfrm-container-container{width:411px;margin:130px auto 0;background:#fff;border:1px solid #b5b5b5;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;text-align:center}
          #sysfrm-container-container h1{font-size:22px;color:#5f5f5f;font-weight:normal;margin:22px 0 26px 0;padding:0}#sysfrm-container-container p{font-size:13px;color:#454545;margin:0 0 12px 0;padding:0}
          #sysfrm-container-container img{margin:0 0 35px 0;padding:0}.ajaxLoader{margin:80px 153px}.stick-footer .system-footer{position:absolute;bottom:0;width:100%}.login-container .error-msg{margin:0 0 15px 0}
            </style ><script type = "text/javascript" >

function timedText()
{
    setTimeout(\'msg1()\', 2000);
    setTimeout(\'msg2()\', 4000);
  //  setTimeout(\'document.MetaRefreshForm.submit()\',4000);
}

function msg1() {
    document.getElementById(\'msgbox\').firstChild.nodeValue = "Submitting...";
}

function msg2() {
    document.getElementById(\'msgbox\').firstChild.nodeValue = "Redirecting...";
}

</script></head>

<body id="sysfrm-container"  onLoad="document.forms[\'gw\'].submit();">

	<div id="sysfrm-container-container">

		<h1>Please wait while you are redirected</h1>
		<p id="msgbox">Validating...</p>
<script type="text/javascript">timedText()</script>		<img src="../assets/uploads/loader.gif" alt="...">
	</div>
        <form name="gw" action="' . $url . '" method="POST">
        ' . $append . '
        </form>
        </body>
        </HTML>';


echo $x;


} else {
   $message=$response->response_reason_text;
    conf('authorize-net-confirmation-message.php','e',$message);
}

?>