<?php
require 'initapp.php';
$self='add-new-client.php';

if (isset($_POST['submit'])){

    $clname=_post('fname');
    $lname=_post('lname');
    $company=_post('company');
    $website=_post('website');
    $address1=_post('address1');
    $address2=_post('address2');
    $city=_post('city');
    $state=_post('state');
    $zip=_post('zip');
    $country=_post('country');
    $phone=_post('phone');
    $email=_post('email');
    $group=_post('group');
    $email_gateway=_post('email_gateway');
    $sms_gateway=_post('sms_gateway');
    $initpassword=_post('password');
    $emailnotify='Yes';
    $password = md5($secret . $initpassword);

    $email_access=_post('email_access');
    $sms_access=_post('sms_access');

//check if a client already exist with the same email id
if ($email!=''){
 $cnt = ORM::for_table('accounts')->where('email', $email)->count('id');
 if ($cnt!='0'){
    conf($self,'e','This Email id already registered with a Client');
  }
}

  $pathname='../assets/profile/profile.jpg';


 $date= date('Y-m-d');
 $aclient = ORM::for_table('accounts')->create();
$aclient->name=$clname;
$aclient->lname=$lname;
$aclient->company=$company;
$aclient->website=$website;
$aclient->address1=$address1;
$aclient->address2=$address2;
$aclient->city=$city;
$aclient->state=$state;
$aclient->postcode=$zip;
$aclient->country=$country;
$aclient->phone=$phone;
$aclient->image=$pathname;
$aclient->datecreated=$date;
$aclient->email=$email;
$aclient->password=$password;
$aclient->groupid=$group;
$aclient->email_gateway=$email_gateway;
$aclient->sms_gateway=$sms_gateway;
$aclient->email_perm=$email_access;
$aclient->sms_perm=$sms_access;
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
            'logo'=> ' src="'.$sysUrl.'/assets/uploads/logo.png"',
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
        conf("client-manage.php?_clid=$did",'s','Client Add Successfully');
    }


else{
          conf($self,'e','Please Enter Client Information Again');

}


?>