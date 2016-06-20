<?php
require ('initapp.php');
$self = 'system-settings.php#appconfig';
if ($xstage=='Demo'){
conf($self,'e','Changing Settings is disabled in the Demo Mode');
}

$websitetitle = _post('websitetitle');
  if($websitetitle!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'WebsiteTitle')->find_one();
    $conf->set('value', $websitetitle);
    $conf->save();  
}


$brandname = _post('brandname');
if($brandname!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'BrandName')->find_one();
    $conf->set('value', $brandname);
    $conf->save();  
}


$email_access = _post('email_access');
if($email_access!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'email_perm')->find_one();
    $conf->set('value', $email_access);
    $conf->save();
}


$sms_access = _post('sms_access');
if($sms_access!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'sms_perm')->find_one();
    $conf->set('value', $sms_access);
    $conf->save();
}


$cl_reg = _post('cl_reg');
if($sms_access!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'Client_Registration')->find_one();
    $conf->set('value', $cl_reg);
    $conf->save();
}


$country = _post('country');
if($country!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'defaultcountry')->find_one();
    $conf->set('value', $country);
    $conf->save();  
}


$currency= _post('currency');
if($currency!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'defaultcurrency')->find_one();
    $conf->set('value', $currency);
    $conf->save();
}


$symbol= _post('symbol');
if($symbol!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'defaultcurrencysymbol')->find_one();
    $conf->set('value', $symbol);
    $conf->save();
}


$language= _post('language');
if($language!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'adminlanguage')->find_one();
    $conf->set('value', $language);
    $conf->save();
}


$footerTxt = _post('footertxt');
if($footerTxt!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'footerTxt')->find_one();
    $conf->set('value', $footerTxt);
    $conf->save();
}



 conf($self,'s','Settings saved successfully');  

 ?>