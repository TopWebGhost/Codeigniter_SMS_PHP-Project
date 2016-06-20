<?php
require 'initapp.php';
$pid = _get('_pid');
$d = ORM::for_table('sms_price_plan')->find_one($pid);


$gateway= _post('gateway');

if (!$gateway==''){
    $item = $d['plan_name'];
    $amount = $d['price'];
    $item_id = 'Buy SMS Plan';
    $invoiceid = $pid;
    $date= date('Y-m-d');
    $emailnotify='Yes';

    $item=$item_id.' '.$item;


    $inq = ORM::for_table('invoices')->create();
    $inq->userid=$cid;
    $inq->created=$date;
    $inq->datepaid=$date;
    $inq->subtotal=$amount;
    $inq->total=$amount;
    $inq->discount='0';
    $inq->status='Unpaid';
    $inq->paymentmethod=$gateway;
    $inq->tax='0';
    $inq->note='';
    $inq->save();
    $did = $inq->id();

    $cl = ORM::for_table('accounts')->find_one($cid);

        $d = ORM::for_table('invoiceitems')->create();
        $d->invoiceid = $did;
        $d->cname =  $cl['name'];
        $d->item = $item;
        $d->price = $amount;
        $d->qty = '1';
        $d->tamount =$amount;
        $d->save();

    if ($emailnotify=='Yes'){
        $sysEmail=appconfig('Email');
        $sysCompany=appconfig('CompanyName');
        $sysUrl= appconfig('sysUrl');
        $d= ORM::for_table('email_templates')->where('tplname', 'Customer Invoice Created')->find_one();

        $name = $cl['name'];
        $email = $cl['email'];

        $template = $d['message'];
        $subject = $d['subject'];
        $send = $d['send'];
        $data = array('name' => $name,
            'business_name'=> $sysCompany,
            'invoice_id'=> $did,
            'invoice_amount'=> $amount,
            'sys_url' => $sysUrl
        );
        $message = _render($template,$data);

        $mail_subject = _render($subject,$data);
        $body = $message;



        if ($send=='1'){
            require ('../lib/pnp/email/class.phpmailer.php') ;
            $mail = new PHPMailer();
            $mail->SetFrom($sysEmail, $sysCompany);
            $mail->AddReplyTo($sysEmail, $sysCompany);
            $mail->AddAddress($email, $name);
            $mail->Subject    = $mail_subject;
            $mail->MsgHTML($body);
            $mail->Send();
        }

    }



    $processFile = "../lib/payment_gateway/$gateway/processor.php";

    if (file_exists($processFile)) {
        require($processFile);
        return;
    } else {
        conf('view-price-plan-feature.php?_pid'.$pid,'e','The Payment Gateway Not Found');
    }
}

?>