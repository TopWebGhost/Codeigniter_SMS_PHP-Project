<?php
require 'initapp.php';
$self='create-new-invoice.php';

if (isset($_POST['submit'])){

    $cname=_post('client');
    $discount=_post('discount');
    $tax=_post('tax');
    $date= date('Y-m-d');
    $emailnotify='Yes';

    $notes=$_POST['message'];


    $qtys = $_POST['qty'];
    $qty[0] = '1';
    $i = '0';
    $totalqty = '0';
    foreach ($qtys as $cqty){
        $qty[$i]= $cqty;
        $totalqty+=$cqty;
        $i++;
    }

    $prices= $_POST['price'];
    $i = '0';
    $total = '0.00';
    foreach ($prices as $cprice){
        $nq = $qty[$i];
        $xprice = ($nq*$cprice);
        $price[$i]= $xprice;
        $total += $xprice;
        $i++;
    }




    if($discount!=''){
        $disc_calculate=($discount*$total/100);
    }else{
        $disc_calculate='0';
    }

    if($tax!=''){
        $tval = ($total*$tax)/100;
        $intotal = $total+$tval;
    }else{
        $intotal=$total;
    }


    $intotal=$intotal-$disc_calculate;


    $inq = ORM::for_table('invoices')->create();
    $inq->userid=$cname;
    $inq->created=$date;
    $inq->datepaid=$date;
    $inq->subtotal=$total;
    $inq->total=$intotal;
    $inq->discount=$disc_calculate;
    $inq->status='Unpaid';
    $inq->paymentmethod='paypal';
    $inq->tax=$tval;
    $inq->note=$notes;
    $inq->save();
    $did = $inq->id();

    $cl = ORM::for_table('accounts')->find_one($cname);

    $description = $_POST['description'];
    $i='0';
    foreach ($description as $item){

        $tqty=$qtys[$i];
        $tprice=$prices[$i];
        $tamount=$tqty*$tprice;

        $d = ORM::for_table('invoiceitems')->create();
        $d->invoiceid = $did;
        $d->cname =  $cl['name'];
        $d->item = $item;
        $d->price = $prices[$i];
        $d->qty = $qtys[$i];
        $d->tamount =$tamount;
        $d->save();
        $i++;
    }


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
             'invoice_amount'=> $intotal,
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
        conf("invoice-manage.php?_inid=$did",'s','Invoice Create Successfully');
}

else{
          conf($self,'e','Invoice does not Create Successfully');

}


?>