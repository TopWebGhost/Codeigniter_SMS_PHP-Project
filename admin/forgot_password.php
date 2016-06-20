<?php
ob_start();
session_start();
define("_APP_RUN", true);
require "../AppINIT.php";
require ('../lib/pnp/email/class.phpmailer.php') ;


if ($xstage=='Demo'){
    conf('login.php','e','Password Reset Option is Disabled in Demo Mode');
}
$self = 'login.php';
if (isset($_POST['submit'])){
    $email = _post('email');
    $emailfound = ORM::for_table('admins')->where('email', $email)->count();


    if ($emailfound=='1'){
        $fprand = _raid('16');
        $fptime = time()+3600;
        $ef = ORM::for_table('admins')->where('email', $email)->find_one();
        $name = $ef['fname'].' '.$ef['lname'];
        $cid = $ef['id'];
        $ef->pwresetkey = $fprand;
        $ef->pwresetexpiry = $fptime;
        $ef->save();


        //send email



        $ip=$_SERVER['REMOTE_ADDR'];
        $sysEmail=appconfig('Email');



        $sysCompany=appconfig('CompanyName');
        $sysUrl= appconfig('sysUrl');
        $d= ORM::for_table('email_templates')->where('tplname', 'Forgot Admin Password')->find_one();


        $template = $d['message'];
        $subject = $d['subject'];
        $send = $d['send'];

        $fpw_link = "$sysUrl/admin/forgot_password.php?_token=$fprand";
        $data = array('name' => $name,
            'logo'=> '<img width="61" height="76" border="0" src="'.$sysUrl.'/assets/uploads/logo.jpg">',
            'footer_img'=> '<img src="'.$sysUrl.'/assets/uploads/footer-bar.jpg" width="598" height="7" style="display:block" border="0" alt=""/>',
            'header_img'=> '<img src="'.$sysUrl.'/assets/uploads/line-bar.jpg" width="393" height="30" border="0" />',
            'business_name'=> $sysCompany,
            'username'=> $email,
            'ip_address'=> $ip,
            'forgotpw_link' => $fpw_link
        );
        $message = _render($template,$data);

        $mail_subject = _render($subject,$data);


        $body = $message;


        if ($send=='1'){

            $mail = new PHPMailer();
            $mail->SetFrom($sysEmail, $sysCompany);
            $mail->AddReplyTo($sysEmail, $sysCompany);
            $mail->AddAddress($email, $name);
            $mail->Subject    = $mail_subject;
            $mail->MsgHTML($body);
            $mail->Send();
        }
        //
        conf('login.php','s','Your Password Already Reset. Please Check your email.');


    }
    else {
        conf($self,'e','Sorry There is no registered user with this email address');
    }

}

if (isset($_GET['_token'])){

    $token = _get('_token');


    $tfnd = ORM::for_table('admins')->where('pwresetkey', $token)->count();


    if ($tfnd=='1'){

        $d = ORM::for_table('admins')->where('pwresetkey', $token)->find_one();
        $cid = $d['id'];
        $name = $d['fname'].' '.$d['lname'];
        $email = $d['email'];
        $username=$d['username'];
        $rawpass = _raid(16);
        $password = md5($secret . $rawpass);

        $d = ORM::for_table('admins')->find_one($cid);

        $d->password = $password;
        $d->pwresetkey = '';
        $d->save();

        $ip=$_SERVER['REMOTE_ADDR'];
        $sysEmail=appconfig('Email');
        $sysCompany=appconfig('CompanyName');
        $sysUrl= appconfig('sysUrl');
        $fpw_link = "$sysUrl/admin/";
        $d= ORM::for_table('email_templates')->where('tplname', 'Admin Password Reset')->find_one();
        $template = $d['message'];
        $subject = $d['subject'];
        $send = $d['send'];
        $data = array('name' => $name,
            'logo'=> '<img width="61" height="76" border="0" src="'.$sysUrl.'/assets/uploads/logo.jpg">',
            'footer_img'=> '<img src="'.$sysUrl.'/assets/uploads/footer-bar.jpg" width="598" height="7" style="display:block" border="0" alt=""/>',
            'header_img'=> '<img src="'.$sysUrl.'/assets/uploads/line-bar.jpg" width="393" height="30" border="0" />',
            'business_name'=> $sysCompany,
            'username'=> $username,
            'password'=> $rawpass,
            'sys_url' => $fpw_link
        );
        $message = _render($template,$data);

        $mail_subject = _render($subject,$data);


        $body = $message;
        if ($send=='1'){
            $mail = new PHPMailer();
            $mail->SetFrom($sysEmail, $sysCompany);
            $mail->AddReplyTo($sysEmail, $sysCompany);
            $mail->AddAddress($email, $name);
            $mail->Subject    = $mail_subject;
            $mail->MsgHTML($body);
            $mail->Send();

            conf('login.php','s','A New Password Generated. Please Check your email.');
        }
        //
    }
    else {
       conf($self,'e','Sorry Password reset Token expired or not exist, Please try again');
    }

}

?>