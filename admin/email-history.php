<?php
require 'initapp.php';
$self='email-history.php';
permission::permitted($self);
require ("views/$theme/email-history.tpl.php");
?>