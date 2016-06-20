<?php
require 'initapp.php';
$self='profile-setting.php';
$cmd=_get('_id');

if ($xstage=='Demo'){
     conf($self,'e','Editing Profile is disabled in the demo mode');
}

if (isset($_POST['update'])){

    $name=_post('fname');
    $lname=_post('lname');
    $company=_post('company');
    $address1=_post('address');
    $address2=_post('address2');
    $city=_post('city');
    $zip=_post('zipcode');
    $phone=_post('phone');
    $email=_post('email');
    $country=_post('country');
    $website=_post('website');
    $emailcheck=ORM::for_table('accounts')->find_one($cmd);
    $cemail=$emailcheck['email'];

//check if a client already exist with the same email id
if ($email!='' AND $email!=$cemail){
 $cnt = ORM::for_table('accounts')->where('email', $email)->count('id');
 if ($cnt!='0'){
    conf($self,'e',"This Email id already registered with a Client");
  }
}
 
$aclient=ORM::for_table('accounts')->find_one($cmd);
$aclient->name=$name;
$aclient->lname=$lname;
$aclient->company=$company;
$aclient->address1=$address1;
$aclient->address2=$address2;
$aclient->city=$city;
$aclient->postcode=$zip;
$aclient->country=$country;
$aclient->phone=$phone;
$aclient->email=$email;
$aclient->website=$website;
$aclient->save();
$did = $aclient->id();
   conf($self,'s','Profile Update Successfully');
}
else{
     conf($self,'e','Please Submit your Information Again');
}

?>