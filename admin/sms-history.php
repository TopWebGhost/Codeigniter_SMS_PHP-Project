<?php
require 'initapp.php';
$self='sms-history.php';
permission::permitted($self);
require ("views/$theme/sms-history.tpl.php");
?>