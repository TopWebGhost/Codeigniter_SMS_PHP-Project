<?php
require ('initapp.php');
$self = 'system-settings.php#companyinfo';
if ($xstage=='Demo'){
conf($self,'e','Changing Settings is disabled in the Demo Mode');
}

    
$company = _post('company');

if ($company==''){
conf($self,'e','Please insert Company Name');
}

if($company!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'CompanyName')->find_one();
    $conf->set('value', $company);
    $conf->save();  
}
    
$email = _post('email'); 

if ($email=='') {
conf($self,'e','Please insert Email address');
}

if($email!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'Email')->find_one();
    $conf->set('value', $email);
    $conf->save();  
} 


$caddress = $_POST['caddress'];

if ($caddress=='') {
  conf($self,'e','Please insert Company Address');
}

 if($caddress!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'caddress')->find_one();
    $conf->set('value', $caddress);
    $conf->save();  
} 

$appurl = _post('appurl');
if($appurl!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'sysUrl')->find_one();
    $conf->set('value', $appurl);
    $conf->save();  
} 

conf($self,'s','Settings Saved Successfully');
?>