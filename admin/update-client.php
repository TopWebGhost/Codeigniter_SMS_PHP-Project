<?php
require 'initapp.php';
$self='client-manage.php';
$cmd=_get('_id');

if ($xstage=='Demo'){
     conf("client-manage.php?_clid=$cmd",'e','Editing Profile is disabled in the demo mode');
}

if (isset($_POST['update'])){

    $name=_post('fname');
    $lname=_post('lname');
    $company=_post('company');
    $address1=_post('address');
    $address2=_post('address2');
    $website=_post('website');
    $city=_post('city');
    $zip=_post('zipcode');
    $phone=_post('phone');
    $email=_post('email');
    $country=_post('country');
    $group=_post('group');
    $emailcheck=ORM::for_table('accounts')->find_one($cmd);
    $cemail=$emailcheck['email'];
    $initpassword=_post('password');
    $rpassword=_post('rpassword');
    $email_access=_post('email_access');
    $sms_access=_post('sms_access');



    if ($initpassword=='') {
      $password=$emailcheck['password'];
    }elseif($initpassword!='' AND $initpassword!=$rpassword ){
        conf($self.'?_clid='.$cmd,'e',"Both Password Doesn't Match");
    }
    else{
          $password = md5($secret . $initpassword);
    }



//check if a client already exist with the same email id
if ($email!='' AND $email!=$cemail){
 $cnt = ORM::for_table('accounts')->where('email', $email)->count('id');
 if ($cnt!='0'){
    conf($self.'?_clid='.$cmd,'e',"This Email id already registered with a Client");
  }
}



$aclient=ORM::for_table('accounts')->find_one($cmd);
    $aclient->name=$name;
    $aclient->lname=$lname;
    $aclient->company=$company;
    $aclient->website=$website;
    $aclient->address1=$address1;
    $aclient->address2=$address2;
    $aclient->city=$city;
    $aclient->postcode=$zip;
    $aclient->country=$country;
    $aclient->phone=$phone;
    $aclient->email=$email;
    $aclient->password=$password;
    $aclient->groupid=$group;
    $aclient->email_perm=$email_access;
    $aclient->sms_perm=$sms_access;
    $aclient->save();
    $did = $aclient->id();
   conf("client-manage.php?_clid=$did",'s','Client Update Successfully');
}
else{
     conf("client-manage.php?_clid=$did",'e','Please Submit your Information Again');
}

?>