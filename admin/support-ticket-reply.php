<?php
require 'initapp.php';
$cmd=_get('_stid');

$self='support-ticket-manage.php?_stid='.$cmd;

$stm=ORM::for_table('tickets')->find_one($cmd);
$tic_id=$stm['id'];
$user_id=$stm['userid'];
$clname=$stm['name'];
$tic_subject=$stm['subject'];

$stadmin=ORM::for_table('admins')->find_one($aid);
$admin=$stadmin['username'];
$adimage=$stadmin['image'];



if (isset($_POST['submit'])){

        $tic_message=_post('message');

        if ($tic_message=='') {
        	    conf($self,'e',"Please Enter your message");
        }
         $emailnotify='Yes';
         $date= date('Y-m-d');
         $stmreply = ORM::for_table('ticketreplies')->create();
         $stmreply->userid=$user_id;
         $stmreply->tid=$tic_id;
         $stmreply->name=$clname;
         $stmreply->message=$tic_message;
         $stmreply->admin=$admin;
         $stmreply->date=$date;
         $stmreply->image=$adimage;
         $stmreply->save(); 
         $stmid = $stmreply->id();


    if ($emailnotify=='Yes'){
        $sysEmail=appconfig('Email');
        $sysCompany=appconfig('CompanyName');
        $sysUrl= appconfig('sysUrl');
        $d= ORM::for_table('email_templates')->where('tplname', 'Ticket Reply')->find_one();
        $cl = ORM::for_table('accounts')->find_one($user_id);
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
            'ticket_id'=> $tic_id,
            'ticket_subject'=> $tic_subject,
            'message'=> $tic_message,
            'reply_by'=> $admin,
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





        conf($self,'s','Reply Message Successfully');
    }


else{
          conf($self,'e','Please Reply Message Again');

}


?>