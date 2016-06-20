<?php
require 'initapp.php';
$self='send-sms-from-file.php';
permission::permitted($self);

require ("views/$theme/send-sms-from-file.tpl.php");
?>