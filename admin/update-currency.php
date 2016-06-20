<?php
require ('initapp.php');
$self = 'system-settings.php#currency';
if ($xstage=='Demo'){
conf($self,'e','Changing Settings is disabled in the Demo Mode');
}

 $country = _post('country');
  if($country!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'defaultcountry')->find_one();
    $conf->set('value', $country);
    $conf->save();  
}
$currency = _post('currency');
if($currency!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'defaultcurrency')->find_one();
    $conf->set('value', $currency);
    $conf->save();  
}
$currencycode = _post('currencycode');
if($currencycode!=''){
    $conf = ORM::for_table('appconfig')->where('setting', 'defaultcurrencysymbol')->find_one();
    $conf->set('value', $currencycode);
    $conf->save();  
}

 conf($self,'s','Currency Information update successfully');  

 ?>