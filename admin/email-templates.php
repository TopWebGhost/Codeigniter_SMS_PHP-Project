<?php
require 'initapp.php';
$self='email-templates.php';
permission::permitted($self);

require ("views/$theme/email-templates.tpl.php");
?>