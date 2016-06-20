<?php
require 'initapp.php';
$self='sms-gateway.php';
permission::permitted($self);

require ("views/$theme/sms-gateway.tpl.php");

?>