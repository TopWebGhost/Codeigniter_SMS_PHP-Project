<?php
require 'initapp.php';
$self='send-bulk-sms.php';
permission::permitted($self);

require ("views/$theme/send-bulk-sms.tpl.php");
?>