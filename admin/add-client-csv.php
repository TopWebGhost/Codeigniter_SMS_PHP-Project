
<?php
require 'initapp.php';
$self='export-n-import.php';

if(appconfig('appStage')=='Demo'){
    conf($self,'e','Sorry Import Client Is Disable In Demo Mode');
    exit;
}

if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {

    $handle = fopen($_FILES['uploaded_file']['tmp_name'], "r");

    fgetcsv($handle, 1000, ","); // skip first row
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
        $data13= md5($secret . $data[13]);
        $datecreated=date('Y-m-d');
        $email=$data['5'];
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
'0'
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