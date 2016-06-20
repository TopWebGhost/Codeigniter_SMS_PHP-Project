<?php
require 'initapp.php';
$self='export-n-import.php';

if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {

    $handle = fopen($_FILES['uploaded_file']['tmp_name'], "r");

    fgetcsv($handle, 1000, ","); // skip first row
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
        $data13= md5($secret . $data[13]);
        $datecreated=date('Y-m-d');
        $email=$data['5'];

        $email_limit=$data['14'];
        $sms_limit=$data['15'];
        $email_perm=$data['16'];
        $sms_perm=$data['17'];

        $cl=ORM::for_table('accounts')->find_one($cid);

        $cl_e_limit=$cl['email_limit'];
        $cl_s_limit=$cl['sms_limit'];
        $cl_e_perm=$cl['email_perm'];
        $cl_s_perm=$cl['sms_perm'];

        if($email_limit!=''){
            if($email_limit>$cl_e_limit){
                conf($self,'e','You do not have enough email balance');
            }
        }

        if($sms_limit!=''){
            if($sms_limit>$p_s_limit){
                conf('client-manage.php?_clid='.$id,'e','You do not have enough sms balance');
            }
        }



//check if a client already exist with the same email id
        if ($email!=''){
            $cnt = ORM::for_table('accounts')->where('email', $email)->count('id');
            if ($cnt!='0'){
                conf($self,'e','An Email id already registered with a Client');
            }
        }



        $pathname='../assets/profile/profile.jpg';


        $import="INSERT into accounts(
groupid,
name,
lname,
company,
website,
email,
address1,
address2,
state,
city,
postcode,
country,
phone,
password,
image,
datecreated,
email_limit,
sms_limit,
email_perm,
sms_perm,
status,
email_gateway,
sms_gateway,
parent) values(
'$data[0]',
'$data[1]',
'$data[2]',
'$data[3]',
'$data[4]',
'$data[5]',
'$data[6]',
'$data[7]',
'$data[8]',
'$data[9]',
'$data[10]',
'$data[11]',
'$data[12]',
'$data13',
'$pathname',
'$datecreated',
'$data[14]',
'$data[15]',
'$data[16]',
'$data[17]',
'$data[18]',
'$data[19]',
'$data[20]',
'$cid'
)";

        $stmt = $dbh->prepare($import);
        $stmt->execute();
    }
    fclose($handle);


    conf('all-clients.php','s','Client Added Successfully');

    }


else{
          conf($self,'e','Please Try Again');

}


?>