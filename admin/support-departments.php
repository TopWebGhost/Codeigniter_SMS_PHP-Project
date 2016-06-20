<?php
require 'initapp.php';
$self='support-departments.php';
permission::permitted($self);
require ("views/$theme/support-departments.tpl.php");

?>