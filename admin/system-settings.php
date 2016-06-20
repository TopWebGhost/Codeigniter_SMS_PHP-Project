<?php
require 'initapp.php';
$self='system-settings.php';
permission::permitted($self);
require ("views/$theme/system-settings.tpl.php");

?>