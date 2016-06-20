<?php
require 'initapp.php';
$self='create-new-ticket.php';

if (isset($_POST['submit'])){

    $cid = _post('client');
    if ($cid=='' OR $cid=='0'){
        conf($self,'e','Your Name is Required.');
    }
    
    $date=date("Y-m-d");

    $tic_subject = _post('subject');
    if ($tic_subject==''){
        conf($self,'e','Ticket Subject is Required.');
    }
    
    $department = _post('department');
    if ($department==''){
        conf($self,'e','Ticket Department is Required.');
    }

    $message = $_POST['message'];

    $dpment=ORM::for_table('supportdepartments')->find_one($department);
    $deprtemail=$dpment['email'];
    $deprtname=$dpment['name'];

 $cl=ORM::for_table('accounts')->find_one($cid);
 $userid=$cl['id'];
 $name=$cl['name'].' '.$cl['lname'];
 $email=$cl['email'];

$emailnotify='Yes';

    $d = ORM::for_table('tickets')->create();
    $d->did = $department;
	$d->userid = $userid;
	$d->name = $name;
    $d->email = $email;
    $d->date=$date;
	$d->subject=$tic_subject;
	$d->message = $message;
    $d->status = 'Pending';
	$d->admin= 'client';
	$d->replyby= '';
	$d->save();
	$tid= $d->id();

    if ($emailnotify=='Yes'){
        $sysEmail=appconfig('Email');
        $sysCompany=appconfig('CompanyName');
        $sysUrl= appconfig('sysUrl');
        $d= ORM::for_table('email_templates')->where('tplname', 'Ticket For Admin')->find_one();

        $template = $d['message'];
        $subject = $d['subject'];
        $send = $d['send'];
        $data = array('name' => $name,
            'business_name'=> $sysCompany,
            'ticket_id'=> $tid,
            'ticket_subject'=> $tic_subject,
            'message'=> $message,
            'create_by'=> $name,
            'department_name'=> $deprtname,
            'sys_url' => $sysUrl
        );
        $message = _render($template,$data);

        $mail_subject = _render($subject,$data);

        $client_ticket="Ticket From".' '.$name;

        $body = $message;
        if ($send=='1'){
            require ('../lib/pnp/email/class.phpmailer.php') ;
            $mail = new PHPMailer();
            $mail->SetFrom($email, $client_ticket);
            $mail->AddReplyTo($email, $name);
            $mail->AddAddress($deprtemail, $deprtname);
            $mail->Subject    = $mail_subject;
            $mail->MsgHTML($body);
            $mail->Send();
        }

    }



        conf("support-ticket-manage.php?_stid=$tid",'s','Support Ticket Create Successfully');  
}
 conf($self,'e','Support Ticket Not Create. Please try again');
 ?>

