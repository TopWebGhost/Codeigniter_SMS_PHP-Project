<?php
require 'initapp.php';
$self='sms-api-setup.php';
permission::permitted($self);

require ("views/$theme/sms-api-setup.tpl.php");
?>