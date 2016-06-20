<?php
require 'initapp.php';
$self='add-new-administrator.php';
permission::permitted($self);

if (isset($_POST['submit'])){

    $fname= _post('fname');
    if ($fname=='' OR $fname=='0'){
        conf($self,'e','First name is Required');
    }
    
    $lname=_post('lname');  
    $email = _post('email');

    if ($email==''){
        conf($self,'e','Email is Required');
    }else{
      $exist= ORM::for_table('admins')->where('email', $email)->count('id');
     if ($exist!='0'){
    conf($self,'e','Email already exist');
   }
  }    

    $username = _post('username');

    if ($username==''){
        conf($self,'e','User Name Required');
    }else{
      $exist= ORM::for_table('admins')->where('username', $username)->count('id');
     if ($exist!='0'){
    conf($self,'e','User name Already exist');
   }
  }
    $role=_post('role');
    $initpassword = _post('password');
    $rpassword = _post('rpassword');
    $emailnotify='Yes';


    if ($initpassword==''){
        conf($self,'e','Password is Required');

    }
    if ($initpassword!=$rpassword){
        conf($self,'e','Password does not match');
    }

    $password = md5($secret . $initpassword);

  $pathname='../assets/admin/profile.jpg';

    $adminq= ORM::for_table('admins')->create();

    $adminq->fname = $fname;
    $adminq->lname = $lname;
    $adminq->username = $username;
    $adminq->email = $email;
    $adminq->password=$password;
    $adminq->image=$pathname;
    $adminq->roleid=$role;
    $adminq->status='Active';
    $adminq->save();

     if ($emailnotify=='Yes' && $email!=''){
         $sysEmail=appconfig('Email');
         $sysCompany=appconfig('CompanyName');
         $sysUrl= appconfig('sysUrl');
         $d= ORM::for_table('email_templates')->where('tplname', 'Add New Administration')->find_one();

         $template = $d['message'];
         $subject = $d['subject'];
         $send = $d['send'];
         $data = array('name' => $fname,
             'logo'=> '<img width="61" height="76" border="0" src="'.$sysUrl.'/assets/uploads/logo.jpg">',
             'footer_img'=> '<img src="'.$sysUrl.'/assets/uploads/footer-bar.jpg" width="598" height="7" style="display:block" border="0" alt=""/>',
             'header_img'=> '<img src="'.$sysUrl.'/assets/uploads/line-bar.jpg" width="393" height="30" border="0" />',
             'business_name'=> $sysCompany,
             'username'=> $username,
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


      conf("administrators.php",'s','Administrator Add Successfully');
}

 conf($self,'e','There have some problems. Please try again');

?>