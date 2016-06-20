<?php
require 'initapp.php';
$self='email-providers.php';
permission::permitted($self);

require ("views/$theme/email-providers.tpl.php");
?>