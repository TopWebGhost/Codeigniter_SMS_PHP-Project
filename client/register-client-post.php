<?php
ob_start();
session_start();
define("_APP_RUN", true);
require '../AppINIT.php';

$self='register.php';

//Adding New Contact
if (isset($_POST['register'])){

    $clname=_post('fname');

    if ($clname=='') {
        conf($self,'e',"Please Enter Your First Name.");
    }


    $lname=_post('lname');
    $company=_post('company');
    $address1=_post('address');
    $address2=_post('address2');
    $city=_post('city');
    $state=_post('state');
    $zip=_post('zipcode');
    $country=_post('country');

    if ($country=='0' OR $country=='') {
        conf($self,'e',"Please Select Your Country.");
    }


    $phone=_post('phone');
    $email=_post('email');

    if ($email=='') {
        conf($self,'e',"Please Enter Your Email.");
    }

    //check if a client already exist with the same email id
    if ($email!=''){
        $cnt = ORM::for_table('accounts')->where('email', $email)->count('id');
        if ($cnt!='0'){
            conf($self,'e',"This Email id already registered with a Client");
        }
    }

    $website=_post('website');
    $initpassword=_post('password');
    $reinitpassword=_post('rpassword');

    if ($initpassword=='') {
        conf($self,'e',"Please Enter Your Password.");
    }


    if ($initpassword!=$reinitpassword) {
        conf($self,'e',"Password Doesn't Match Each Other.");
    }


    $captcha=_post('captcha');
    $captcha = strtolower($captcha);
    $scaptcha= $_SESSION['captcha'];


    if( $captcha !=$scaptcha  ) {
        conf($self,'e','Invalid Captcha Code. Please Try Again');
    }



    $emailnotify='Yes';
    $password = md5($secret . $initpassword);

    $pathname="../assets/profile/profile.jpg";

    $date= date('Y-m-d');
    $aclient = ORM::for_table('accounts')->create();
    $aclient->name=$clname;
    $aclient->lname=$lname;
    $aclient->company=$company;
    $aclient->website=$website;
    $aclient->address1=$address1;
    $aclient->address2=$address2;
    $aclient->city=$city;
    $aclient->postcode=$zip;
    $aclient->state=$state;
    $aclient->country=$country;
    $aclient->phone=$phone;
    $aclient->image=$pathname;
    $aclient->datecreated=$date;
    $aclient->email=$email;
    $aclient->password=$password;
    $aclient->groupid='0';
    $aclient->email_gateway='PHPMailer';
    $aclient->sms_gateway='Twilio';
    $aclient->email_perm='0';
    $aclient->sms_perm='0';
    $aclient->parent='0';

    $aclient->save();
    $did = $aclient->id();


    if ($emailnotify=='Yes' && $email!=''){
        $sysEmail=appconfig('Email');
        $sysCompany=appconfig('CompanyName');
        $sysUrl= appconfig('sysUrl');
        $d= ORM::for_table('email_templates')->where('tplname', 'Customer SignUp')->find_one();

        $template = $d['message'];
        $subject = $d['subject'];
        $send = $d['send'];
        $data = array('name' => $clname,
            'logo'=> '<img width="61" height="76" border="0" src="'.$sysUrl.'/assets/uploads/logo.jpg">',
            'footer_img'=> '<img src="'.$sysUrl.'/assets/uploads/footer-bar.jpg" width="598" height="7" style="display:block" border="0" alt=""/>',
            'header_img'=> '<img src="'.$sysUrl.'/assets/uploads/line-bar.jpg" width="393" height="30" border="0" />',
            'business_name'=> $sysCompany,
            'username'=> $email,
            'password'=> $initpassword,
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
            $mail->AddAddress($email, $clname);
            $mail->Subject= $mail_subject;
            $mail->MsgHTML($body);
            $mail->Send();
        }

    }
    conf('login.php','s','You Registered Successfully. Now you can Login');
}


else{
    conf($self,'e','Please Enter Correct Information Again');

}


?>