<?php
require 'initapp.php';
$self='send-schedule-sms-from-file.php';
permission::permitted($self);

require ("views/$theme/send-schedule-sms-from-file.tpl.php");
?>