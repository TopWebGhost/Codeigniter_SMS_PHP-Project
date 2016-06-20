<?php
require 'initapp.php';
$self='sms-gateway-manage.php';
permission::permitted($self);


$cmd=_get('_sgid');

$d=ORM::for_table('sms_gateway')->find_one($cmd);


require ("views/$theme/sms-gateway-manage.tpl.php");
?>