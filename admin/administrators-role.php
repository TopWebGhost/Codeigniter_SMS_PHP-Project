<?php
require 'initapp.php';
$self='administrators-role.php';
permission::permitted($self);
require ("views/$theme/administrators-role.tpl.php");
?>