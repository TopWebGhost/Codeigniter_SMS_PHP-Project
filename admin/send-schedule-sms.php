<?php
require 'initapp.php';
$self='send-schedule-sms.php';
permission::permitted($self);

require ("views/$theme/send-schedule-sms.tpl.php");
?>