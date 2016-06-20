<?php
require 'initapp.php';
$self='email-providers-manage.php';
permission::permitted($self);


$cmd=_get('_epid');

$d=ORM::for_table('email_providers')->find_one($cmd);


require ("views/$theme/email-providers-manage.tpl.php");
?>