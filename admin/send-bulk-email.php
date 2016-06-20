<?php
require 'initapp.php';
$self='send-bulk-email.php';
permission::permitted($self);

require ("views/$theme/send-bulk-email.tpl.php");
?>