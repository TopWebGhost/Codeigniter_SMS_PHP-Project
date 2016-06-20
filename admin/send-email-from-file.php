<?php
require 'initapp.php';
$self='send-email-from-file.php';
permission::permitted($self);

require ("views/$theme/send-email-from-file.tpl.php");
?>