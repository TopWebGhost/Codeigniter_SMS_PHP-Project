<?php
require 'initapp.php';
$self='administrators.php';
permission::permitted($self);
require ("views/$theme/administrators.tpl.php");
?>