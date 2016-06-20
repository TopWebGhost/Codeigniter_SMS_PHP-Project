<?php
require 'initapp.php';
$self='create-new-ticket.php';

if (isset($_POST['submit'])){

    $cid = _post('client');
    if ($cid=='' OR $cid=='0'){
        conf($self,'e','Client Name is Required.');
    }
    
    $date=date("Y-m-d");

    $tsubject = _post('subject');
    if ($tsubject==''){
        conf($self,'e','Ticket Subject is Required.');
    }
    
    $department = _post('department');
    if ($department==''){
        conf($self,'e','Ticket Department is Required.');
    }

    $message =$_POST['message'];

 $cl=ORM::for_table('accounts')->find_one($cid);
 $userid=$cl['id'];
 $name=$cl['name'].' '.$cl['lname'];
 $email=$cl['email'];

$ad=ORM::for_table('admins')->find_one($aid);
$admin=$ad['username'];
$emailnotify='Yes';

    $d = ORM::for_table('tickets')->create();
            $d->did = $department;
	$d->userid = $userid;
	$d->name = $name;
             $d->email = $email;
            $d->date=$date;
	$d->subject=$tsubject;
	$d->message = $message;
            $d->status = 'Pending';
	$d->admin= $admin;
	$d->replyby= '';
	$d->save();
	$tid= $d->id();

    if ($emailnotify=='Yes'){
        $sysEmail=appconfig('Email');
        $sysCompany=appconfig('CompanyName');
        $sysUrl= appconfig('sysUrl');
        $d= ORM::for_table('email_templates')->where('tplname', 'Ticket For Customer')->find_one();
        $cl = ORM::for_table('accounts')->find_one($userid);
        $name = $cl['name'];
        $email = $cl['email'];

        $template = $d['message'];
        $subject = $d['subject'];
        $send = $d['send'];
        $data = array('name' => $name,
            'logo'=> '<img width="61" height="76" border="0" src="'.$sysUrl.'/assets/uploads/logo.jpg">',
            'footer_img'=> '<img src="'.$sysUrl.'/assets/uploads/footer-bar.jpg" width="598" height="7" style="display:block" border="0" alt=""/>',
            'header_img'=> '<img src="'.$sysUrl.'/assets/uploads/line-bar.jpg" width="393" height="30" border="0" />',
            'business_name'=> $sysCompany,
            'ticket_id'=> $tid,
            'ticket_subject'=> $tsubject,
            'message'=> $message,
            'create_by'=> $admin,
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

        conf("support-ticket-manage.php?_stid=$tid",'s','Support Ticket Create Successfully');  
}
 conf($self,'e','Support Ticket Not Create. Please try again');

 ?>

