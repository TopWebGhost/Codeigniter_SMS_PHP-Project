<?php
require 'initapp.php';
$self='client-manage.php';


$cmd=_get('_clid');

if (isset($_POST['submit'])){

    $subject=_post('subject');
    $message=$_POST['message'];

    if($subject==''){
        conf($self.'?_clid='.$cmd,'e','Please Insert Email Subject');
    }
    if($message==''){
        conf($self.'?_clid='.$cmd,'e','Please Insert Email Message');
    }

    $email_provider=_post('email_provider');



    $query = "SELECT id,name, email FROM accounts WHERE id='$cmd'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $clresult = $stmt->fetch();

    if ($stmt->rowCount() > 0) {
        $sysEmail=appconfig('Email');
        $sysCompany=appconfig('CompanyName');

        if($email_provider=='default'){
        require ('../lib/pnp/email/class.phpmailer.php') ;
        $mail = new PHPMailer();
        $mail->SetFrom($sysEmail, $sysCompany);
        $mail->AddReplyTo($sysEmail, $sysCompany);
        $email = $clresult['email'];
        $name = $clresult['name'];
        $mail->AddAddress($email, $name);
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
        }elseif($email_provider=='PHPMailer'){

            require ('../lib/email_provider/PHPMailer/PHPMailerAutoload.php');

            $pmq=ORM::for_table('email_providers')->where('name',$email_provider)->find_one();
            $status_check=ORM::for_table('email_providers')->where('name',$email_provider)->where('status','1')->count();

            if($status_check=='1'){

                $host_name=$pmq['host_name'];
                $username=$pmq['username'];
                $password=$pmq['password'];
                $port=$pmq['port'];

                $mail = new PHPMailer;
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = "$host_name";  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = "$username";                 // SMTP username
                $mail->Password ="$password";                           // SMTP password
                if($port=='465'){
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `tls` also accepted
                }else{
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                }
                $mail->Port = "$port";                                    // TCP port to connect to

                $mail->SetFrom($sysEmail, $sysCompany);
                $mail->AddReplyTo($sysEmail, $sysCompany);
                $email = $clresult['email'];
                $name = $clresult['name'];
                $mail->AddAddress($email, $name);
                $mail->Subject    = $subject;
                $mail->MsgHTML($message);
                $mail->Send();

            }else{
                conf($self.'?_clid='.$cmd,'e','Selected Email Provider is Not Active');
            }
        }elseif($email_provider=='MailGun'){

            require ('../lib/email_provider/PHPMailer/PHPMailerAutoload.php');

            $pmq=ORM::for_table('email_providers')->where('name',$email_provider)->find_one();
            $status_check=ORM::for_table('email_providers')->where('name',$email_provider)->where('status','1')->count();

            if($status_check=='1'){

                $host_name=$pmq['host_name'];
                $username=$pmq['username'];
                $password=$pmq['password'];
                $port=$pmq['port'];

                $mail = new PHPMailer;
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = "$host_name";  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = "$username";                 // SMTP username
                $mail->Password ="$password";                           // SMTP password
                if($port=='465'){
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `tls` also accepted
                }else{
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                }
                $mail->Port = "$port";
                $mail->From = "$sysEmail";
                $mail->FromName = "$sysCompany";
                $email = $clresult['email'];
                $name = $clresult['name'];
                $mail->AddAddress($email);
                $mail->Subject    = $mail_subject;
                $mail->MsgHTML($message);
                $mail->Send();
            }else{
                conf($self.'?_clid='.$cmd,'e','Selected Email Provider is Not Active');
            }
        }elseif($email_provider=='SendGrid'){
            require ('../lib/email_provider/sendgrid-php/sendgrid-php.php');

            $pmq=ORM::for_table('email_providers')->where('name',$email_provider)->find_one();
            $status_check=ORM::for_table('email_providers')->where('name',$email_provider)->where('status','1')->count();

            if($status_check=='1'){
                $host_name=$pmq['host_name'];
                $username=$pmq['username'];
                $password=$pmq['password'];
                $port=$pmq['port'];

                $email = $clresult['email'];
                $name = $clresult['name'];

                $options = array(
                    'turn_off_ssl_verification' => true,
                    'protocol' => 'https',
                    'host' => 'api.sendgrid.com',
                    'endpoint' => '/api/mail.send.json',
                    'url' => null
                );
                $sendgrid = new SendGrid($username, $password, $options);

                $cl_email   = new SendGrid\Email();
                $cl_email->setFrom($sysEmail);
                $cl_email->setFromName($sysCompany);
                $cl_email->addTo($email);
                $cl_email->setSubject($subject);
                $cl_email->setHtml($message);
                $sendgrid->send($cl_email);

            }else{
                conf($self.'?_clid='.$cmd,'e','Selected Email Provider is Not Active');
            }

        }
        
   

        else{
            conf($self.'?_clid='.$cmd,'e','Please Select a Provider');
        }


    $imail=ORM::for_table('email_logs')->create();
    $imail->userid=$cmd;
    $imail->email=$email;
    $imail->subject=$subject;
    $imail->message=$message;
    $imail->send_by='0';
    $imail->save();


    }
    conf($self.'?_clid='.$cmd,'s','Email Send Successfully');

    }


else{
    conf($self.'?_clid='.$cmd,'e','Please Enter Information Again');

}


?>