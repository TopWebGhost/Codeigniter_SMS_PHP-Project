<?php
require 'initapp.php';
$self='send-email-from-file.php';


if (isset($_POST['submit'])){
    $subject=_post('subject');
    $message=$_POST['message'];
    if($subject==''){
        conf($self,'e','Please Insert Email Subject');
    }
    if($message==''){
        conf($self,'e','Please Insert Email Message');
    }

    $email_provider=_post('email_provider');


    if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
        $filename = basename($_FILES['uploaded_file']['name']);
        $ext = substr($filename, strrpos($filename, '.') + 1);
        if (($ext == "txt") &&  ($_FILES["uploaded_file"]["size"] < 1000000)) {
            $newname=_raid('10')."-".$filename;
            $newname = BASEPATH .DIRECTORY_SEPARATOR."assets/email_file/".$newname;

            if (!file_exists($newname)) {

                if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {

                    $emails = file_get_contents($newname);

                    $file_email = str_replace(" ", "", $emails); #Remove any whitespace
                    $email_result= trim($file_email, "\r\n") ;
                    unlink($newname);
                } else {
                    exit ("An Error Occured");
                }
            } else {
                unlink($newname);
                exit ("File already exist with the same name");
            }

        }
        else { exit ("Invalid file type, Please go back and try again");}

    }

    $list = preg_split('/\r\n|\n|\r/', $email_result);
    $listscount= count ($list) ;


    for($i = 0; $i < $listscount; $i++){
        $client_email = $list[$i] ;
        $imail=ORM::for_table('email_logs')->create();
        $imail->userid='0';
        $imail->email=$client_email;
        $imail->subject=$subject;
        $imail->message=$message;
        $imail->send_by='0';
        $imail->save();
    }



        if ($listscount> 0) {
            $sysEmail=appconfig('Email');
            $sysCompany=appconfig('CompanyName');
            $sysUrl= appconfig('sysUrl');

            $d= ORM::for_table('email_templates')->where('tplname', 'Bulk Email Send')->find_one();
            $template = $d['message'];
            $send = $d['send'];
            $data = array(
                'business_name'=> $sysCompany,
                'message_body'=> $message
            );

            $message = _render($template,$data);
            $mail_subject = _render($subject,$data);
            $body = $message;

            if ($send=='1'){
                if($email_provider=='default'){

                require ('../lib/pnp/email/class.phpmailer.php') ;
                $mail = new PHPMailer();
                $mail->SetFrom($sysEmail, $sysCompany);
                $mail->AddReplyTo($sysEmail, $sysCompany);

            for($i = 0; $i < $listscount; $i++){
                $client_email = $list[$i] ;
                $name=$sysCompany.' '.'Client';
                $mail->AddAddress($client_email, $name);
            }
            $mail->Subject    = $subject;
            $mail->MsgHTML($message);
            $mail->Send();
            }




                elseif($email_provider=='PHPMailer'){

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

                for($i = 0; $i < $listscount; $i++){
                    $client_email = $list[$i] ;
                    $name=$sysCompany.' '.'Client';
                    $mail->AddAddress($client_email, $name);
                }

                $mail->Subject    = $mail_subject;
                $mail->MsgHTML($body);
                $mail->Send();

                }
                else{
                    conf($self,'e','Selected Email Provider is Not Active');
                }

            }
                elseif($email_provider=='MailGun'){

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
                $mail->From = "$sysEmail";
                $mail->FromName = "$sysCompany";

                for($i = 0; $i < $listscount; $i++){
                    $client_email = $list[$i] ;
                    $name=$sysCompany.' '.'Client';
                    $mail->AddAddress($client_email, $name);
                }

                $mail->Subject    = $mail_subject;
                $mail->MsgHTML($body);
                $mail->Send();

                }
                else{
                    conf($self,'e','Selected Email Provider is Not Active');
                }

            }



                elseif($email_provider=='SendGrid'){
                require ('../lib/email_provider/sendgrid-php/sendgrid-php.php');

                $pmq=ORM::for_table('email_providers')->where('name',$email_provider)->find_one();
                $status_check=ORM::for_table('email_providers')->where('name',$email_provider)->where('status','1')->count();

                if($status_check=='1'){
                $host_name=$pmq['host_name'];
                $username=$pmq['username'];
                $password=$pmq['password'];
                $port=$pmq['port'];

                for($i = 0; $i < $listscount; $i++){
                    $client_email = $list[$i] ;
                    $name=$sysCompany.' '.'Client';
                    $multiUsers=@$multiUsers. "'"."$client_email"."'".",";
                }

                    $user_email = substr($multiUsers,0,strlen($multiUsers)-1);
                    $user_email=str_replace("'","",$user_email);
                    $user_email=explode(",",$user_email);

                    $options = array(
                        'turn_off_ssl_verification' => true,
                        'protocol' => 'https',
                        'host' => 'api.sendgrid.com',
                        'endpoint' => '/api/mail.send.json',
                        'url' => null
                    );
                    $sendgrid = new SendGrid($username, $password, $options);

                    $email   = new SendGrid\Email();
                    $email->setFrom($sysEmail);
                    $email->setFromName($sysCompany);
                    $email->setTos($user_email);
                    $email->setSubject($mail_subject);
                    $email->setHtml($body);
                    $sendgrid->send($email);


                }
                else{
                    conf($self,'e','Selected Email Provider is Not Active');
                }
                }
               
                else{
                conf($self,'e','Please Select a Provider');
                }
            conf('email-history.php','s','Email Send Successfully');
            }

        }
        else{
            conf($self,'e','There Have No Email In this File');
        }
        }
        else{
          conf($self,'e','Please Enter Information Again');
        }


?>